<?php
namespace application\modules\gallery\actions\album\video;
use application\modules\gallery\components\GalleryAction;

/**
 * Created by JetBrains PhpStorm.
 * User: Николай
 * Date: 13.06.13
 * Time: 13:13
 * To change this template use File | Settings | File Templates.
 *
 * @package application.gallery.actions.album
 */
class Index extends GalleryAction
{
    public $viewName = 'video/index';

    public function run()
    {
        $criteriaType = new \CDbCriteria();
        if($this->isCommunity) {
            $criteriaType->addCondition('`t`.community_id = :community_id');
            $criteriaType->params = array(':community_id' => \Yii::app()->community->id);
        } else {
            $criteriaType->addCondition('`t`.user_id = :user_id');
            $criteriaType->scopes = array('notCommunity');
            $criteriaType->params = array(':user_id' => $this->userId);
        }

        $criteria = new \CDbCriteria();
        $criteria->scopes = array(
            'deletedStatus',
            'activatedStatus',
            'moderDeletedStatus',
            'truncatedStatus',
        );

        $criteria->with = array(
            'user',
            'audioCount',
        );
        $criteria->params = array(
            ':deletedStatus' => 0,
            ':activatedStatus' => 1,
            ':truncatedStatus' => 0,
            ':moderDeletedStatus' => 0
        );
        $criteria->mergeWith($criteriaType);
        $criteria->mergeWith(\Yii::app()->access->GetCriteriaAccess());

        $pages = new \CPagination(\GalleryAlbumVideo::model()->count($criteria));
        $pages->pageSize = \Yii::app()->paramsWrap->pageSize->album;
        $pages->applyLimit($criteria);

        \Yii::app()->clientScript->registerPackage('video');

        $this->controller->render($this->viewName, array(
            'models' => \GalleryAlbumVideo::model()->findAll($criteria),
            'pages' => $pages
        ));
    }
}