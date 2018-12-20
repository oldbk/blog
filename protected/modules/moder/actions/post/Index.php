<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nnick
 * Date: 12.08.13
 * Time: 0:12
 * To change this template use File | Settings | File Templates.
 */

namespace application\modules\moder\actions\post;


class Index extends \CAction
{
    public function run()
    {
        $Report = new \ReportPost('search');
        $Report->unsetAttributes();

        if(isset($_REQUEST['Report']))
            $Report->setAttributes($_REQUEST['Report']);

        $Report->status = \Report::STATUS_PENDING;
        $this->controller->render('index', array(
            'model' => $Report
        ));
    }
}