<?php
/**
 * Created by PhpStorm.
 * User: Николай
 * Date: 30.01.14
 * Time: 18:24
 *
 * @var Poll[] $models
 * @var CPagination $pages
 */ ?>

    <ul class="top">
        <?php foreach($models as $model): ?>
            <li>
                <?php $this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.modules.poll.common.short',
                    array(
                        'model' => $model
                    )); ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php if(empty($models)): ?>
    <div class="event_empty">Список пуст</div>
<?php endif; ?>
<? $this->widget('ext.pagination.Pager', array(
    //'cssFile' => '',
    'internalPageCssClass' => 'btn',
    'pages' => $pages,
    'header' => '',
    'selectedPageCssClass' => 'active',
    'htmlOptions' => array(
        'class' => 'btn-group pagination',
    )
)); ?>