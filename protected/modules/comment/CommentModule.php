<?php

Yii::import('application.modules.comment.controllers.*');
/**
 * Class CommentModule
 *
 * @package application.comment
 */
class CommentModule extends CWebModule
{
    public $controllerNamespace = '\application\modules\comment\controllers';

    /**
     *
     */
    public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		/*$this->setImport(array(
			'comment.models.*',
			'comment.components.*',
		));*/
	}

    /**
     * @param CController $controller
     * @param CAction $action
     * @return bool
     */
    public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}