<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Николай
 * Date: 05.06.13
 * Time: 14:00
 * To change this template use File | Settings | File Templates.
 *
 * @var GalleryAlbumImage[] $models
 * @var CPagination $pages
 */

$this->breadcrumbs = array('Фотоальбомы');

if(Access::canEdit()): ?>
<div class="buttons">
    <i class="icon" id="album_icon_image"></i>
    <div class="m_button">
        <?php echo CHtml::link('Добавить фотоальбом', Yii::app()->createUrl('/gallery/album/add_image', array('gameId' => Yii::app()->user->getGameId())), array('id' => 'add_album', 'class' => 'fancybox.ajax btn2')); ?>
    </div>
</div>
<?php endif; ?>
<ul class="album">
    <?php foreach($models as $model): ?>
        <li>
            <div class="body">
                <?php $this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.modules.gallery.common.album', array(
                    'model' => $model,
                    'route' => '/gallery/album/show_image',
                    'routeParams' => array('gameId' => $model->user->game_id)
                )); ?>
            </div>
            <div class="title">
                <i class="icon" id="album"></i>
                <?php echo CHtml::link($model->title, Yii::app()->createUrl('/gallery/album/show_image', array('album_id' => $model->id, 'gameId' => $model->user->game_id)))?>
                <div class="hint">В альбоме фотографий: <?php echo $model->imageCount; ?></div>
            </div>
        </li>
    <?php endforeach; ?>
</ul>
<?php if(empty($models)): ?>
    <div class="event_empty">Список пуст</div>
<?php endif; ?>
<? $this->widget('ext.pagination.Pager', array(
    'internalPageCssClass' => 'btn',
    'pages' => $pages,
    'header' => '',
    'selectedPageCssClass' => 'active',
    'htmlOptions' => array(
        'class' => 'btn-group pagination',
    )
)); ?>