<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nnick
 * Date: 11.08.13
 * Time: 22:36
 * To change this template use File | Settings | File Templates.
 */

namespace application\modules\comment\actions\image;


class Reset extends \CAction
{
    public function run()
    {
        $id = \Yii::app()->request->getParam('id');
        $criteria = new \CDbCriteria();
        $criteria->addCondition('`t`.id = :id');
        //$criteria->addCondition('`t`.user_deleted_id = :user_id');
        $criteria->scopes = array(
            'truncatedStatus',
            'deletedStatus',
            'moderDeletedStatus',
        );
        $criteria->params = array(
            ':id' => $id,
            ':truncatedStatus' => 0,
            ':deletedStatus' => 1,
            ':moderDeletedStatus' => 0,
            //':user_id' => \Yii::app()->user->id,
        );
        $criteria->with = array('image', 'info');

        /** @var \CommentItemImage $Comment */
        $Comment = \CommentItemImage::model()->find($criteria);
        if(!$Comment) {
            \Yii::app()->message->setErrors('danger', 'Подходящий комментарий не найден');
            \Yii::app()->message->showMessage();
        } elseif($Comment->image->is_deleted || $Comment->image->is_moder_deleted || $Comment->image->deleted_trunc) {
            \Yii::app()->message->setErrors('danger', 'Фотография этого комментария удалена, невозможно восстановить комментарий');
            \Yii::app()->message->showMessage();
        } elseif($Comment->info->is_community && !\Yii::app()->community->isModer()) {
            \Yii::app()->message->setErrors('danger', 'Вы не можете восстановить комментарии в этом сообществе');
            \Yii::app()->message->showMessage();
        } elseif(!$Comment->info->is_community && $Comment->user_id != \Yii::app()->user->id) {
            \Yii::app()->message->setErrors('danger', 'Вы не можете восстановить этот комментарий');
            \Yii::app()->message->showMessage();
        }

        $error = false;
        $t = \Yii::app()->db->beginTransaction();
        try {
            $Image = $Comment->image;
            $Image->comment_count += 1;
            if(!$Image->mUpdate())
                $error = true;

            if(!$Comment->restore())
                $error = true;

            if(!$error) {
                $t->commit();
                \Yii::app()->message->setText('success', 'Комментарий восстановлен');
            } else
                $t->rollback();

        } catch (\Exception $ex) {
            $t->rollback();
            \MyException::log($ex);
        }

        \Yii::app()->message->showMessage();
    }
}