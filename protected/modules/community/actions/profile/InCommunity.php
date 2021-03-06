<?php
namespace application\modules\community\actions\profile;
/**
 * Created by JetBrains PhpStorm.
 * User: Николай
 * Date: 13.06.13
 * Time: 13:13
 * To change this template use File | Settings | File Templates.
 *
 * @package application.gallery.actions.image
 */
class InCommunity extends \CAction
{
    public function run()
    {
        $this->controller->community = false;

        $criteria = new \CDbCriteria();
        $criteria->scopes = array('deletedStatus', 'moderDeletedStatus', 'truncatedStatus', 'notMe');
        $criteria->params = array(
            ':deletedStatus' => 0,
            ':moderDeletedStatus' => 0,
            ':truncatedStatus' => 0
        );
        $criteria->with = array('user', 'inCommunity', 'inRequest', 'postCount', 'imageCount', 'videoCount', 'audioCount');
        $criteria->order = '`t`.create_datetime desc';

        $dependency = new \CDbCacheDependency('select max(update_datetime) from {{community_user}} where user_id = :user_id');
        $dependency->params = array(':user_id' => \Yii::app()->user->id);
        $dependency->reuseDependentData = true;

        $pages = new \CPagination(\Community::model()->cache(\Yii::app()->paramsWrap->cache->community, $dependency)->count($criteria));
        $pages->pageSize = \Yii::app()->paramsWrap->pageSize->community_index;
        $pages->applyLimit($criteria);

        $models = \Community::model()->cache(\Yii::app()->paramsWrap->cache->community, $dependency)->findAll($criteria);
        $this->controller->render('incommunity', array(
            'models' => $models,
            'pages' => $pages
        ));
    }
}