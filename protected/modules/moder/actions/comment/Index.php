<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nnick
 * Date: 12.08.13
 * Time: 0:09
 * To change this template use File | Settings | File Templates.
 */

namespace application\modules\moder\actions\comment;


class Index extends \CAction
{
    public function run()
    {
        $Report = new \ReportComment('search');
        $Report->unsetAttributes();

        if(isset($_REQUEST['Report']))
            $Report->setAttributes($_REQUEST['Report']);

        $Report->status = \Report::STATUS_PENDING;
        $this->controller->render('index', array(
            'model' => $Report
        ));
    }
}