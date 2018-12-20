<?php
namespace application\modules\rating\controllers;
/**
 * Class RequestController
 *
 * @package application.rating.controllers
 */
class CommentController extends \FrontController
{
    public function filters()
    {
        return array(
            'accessControl',
            'ajaxOnly + add, take',
        );
    }

    public function accessRules()
    {
        return array(
            array('deny',
                'actions'=>array('add', 'take'),
                'users' => array('?'),
            )
        );
    }

    public function actions()
    {
        return array(
            'add'    => '\application\modules\rating\actions\comment\Add',
            'take'    => '\application\modules\rating\actions\comment\Take',
        );
    }
}