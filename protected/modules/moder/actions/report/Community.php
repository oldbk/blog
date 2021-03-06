<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nnick
 * Date: 11.08.13
 * Time: 23:21
 * To change this template use File | Settings | File Templates.
 */

namespace application\modules\moder\actions\report;


class Community extends \CAction
{
    public function run()
    {
        $criteria = new \CDbCriteria();
        $criteria->addCondition('item_id = :id');
        $criteria->params = array(':id' => \Yii::app()->community->id);
        /** @var \ReportCommunity $Report */
        $Report = \ReportCommunity::model()->find($criteria);
        if(null !== $Report) {
            if($Report->status == \ReportPost::STATUS_PENDING)
                \Yii::app()->message->setErrors('danger', 'Кто-то уже пожаловался на эту заметку и она находится в очереди');
            elseif($Report->status == \ReportPost::STATUS_DONE)
                \Yii::app()->message->setErrors('danger', 'Эту жалобу уже обработали');
        } else {
            $error = false;
            $t = \Yii::app()->db->beginTransaction();
            try {
                $Report = new \ReportCommunity();
                $Report->create_datetime = \DateTimeFormat::format();
                $Report->update_datetime = \DateTimeFormat::format();
                $Report->item_id = \Yii::app()->community->id;
                $Report->title = \Yii::app()->community->title;
                $Report->user_owner_id = \Yii::app()->community->user_id;
                $Report->user_id = \Yii::app()->user->id;
                if(!$Report->save()) {
                    $error = true;
                    \Yii::app()->message->setErrors('danger', $Report);
                }

                $Community = \Yii::app()->community->getModel();
                $Community->is_reported = 1;
                if(!$Community->mUpdate()) {
                    $error = true;
                    \Yii::app()->message->setErrors('danger', $Community);
                }

                if(!$error) {
                    $t->commit();
                    \Yii::app()->message->setText('success', 'Ваша жалоба добавлена в очередь');
                } else
                    $t->rollback();

            } catch (\Exception $ex) {
                $t->rollback();
                \MyException::log($ex);
            }
        }
        \Yii::app()->message->url = \Yii::app()->request->getUrlReferrer();
        \Yii::app()->message->showMessage();
    }
}