<?php
/**
 * Class GalleryAlbumImage
 *
 * @package application.gallery.models
 */
class GalleryAlbumImage extends GalleryAlbum
{
    public $oldImage;
    public $oldViewRole;

    /**
     * @param string $className
     * @return GalleryAlbumImage
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function defaultScope()
    {
        $t = $this->getTableAlias(false, false);
        return array(
            'condition' => $t.'.album_type = :'.$t.'_album_type',
            'params' => array(':'.$t.'_album_type' => ItemTypes::ITEM_TYPE_IMAGE)
        );
    }

    public function beforeValidate()
    {
        $this->album_type = ItemTypes::ITEM_TYPE_IMAGE;
        return parent::beforeValidate();
    }

    public function afterFind()
    {
        $this->oldViewRole = $this->view_role;
        parent::afterFind();
    }

    /**
     * Укл в папку альбом пользователя
     * @return string
     */
    public function getBaseUrl()
    {
        return Yii::app()->theme->uploadAlbum.'/image/'.$this->user_id;
    }

    public function getImageUrl($local = false)
    {
        if($local)
            return $this->getBaseUrl().'/'.$this->image_front;
        elseif($this->image_front !== null && $this->image_front != '' && $this->is_croped)
            return Yii::app()->theme->uploadAlbumLink.'/image/'.$this->user_id.'/'.$this->image_front;
        elseif(isset($this->imagePreview))
            return $this->imagePreview->getImageUrl();
        else
            return Yii::app()->theme->baseUrl.'/images/albums/image.jpg';
    }

    public function getImage($local = false)
    {
        if($local)
            return CHtml::image($this->getBaseUrl().'/'.$this->image_front, $this->title);
        elseif($this->image_front !== null && $this->image_front != '' && $this->is_croped)
            return CHtml::image(Yii::app()->theme->uploadAlbumLink.'/image/'.$this->user_id.'/'.$this->image_front, $this->title);
        elseif(isset($this->imagePreview))
            return CHtml::image($this->imagePreview->getImageUrl(), $this->title);
        else
            return CHtml::image(Yii::app()->theme->baseUrl.'/images/albums/image.jpg', $this->title);
    }

    public static function getUserAlbums()
    {
        $returned = array();
        $criteria = new CDbCriteria();
        $criteria->scopes = array(
            'own',
            'activatedStatus',
            'deletedStatus',
            'moderDeletedStatus',
        );
        $criteria->params = array(
            ':activatedStatus' => 1,
            ':deletedStatus' => 0,
            ':moderDeletedStatus' => 0,
        );
        /** @var GalleryAlbumImage[] $albums */
        $albums = self::model()->findAll($criteria);
        foreach($albums as $album)
            $returned[$album->id] = $album->title.' ('.Access::getRoleName($album->view_role).')';

        return $returned;
    }

    public static function getCommunityAlbums($communityId)
    {
        $returned = array();
        $criteria = new CDbCriteria();
        $criteria->addCondition('`t`.community_id = :community_id');
        $criteria->scopes = array(
            'activatedStatus',
            'deletedStatus',
            'moderDeletedStatus',
        );
        $criteria->params = array(
            ':activatedStatus' => 1,
            ':deletedStatus' => 0,
            ':moderDeletedStatus' => 0,
            ':community_id' => $communityId
        );

        /** @var GalleryAlbumImage[] $albums */
        $albums = self::model()->findAll($criteria);
        foreach($albums as $album)
            $returned[$album->id] = $album->title.' ('.Access::getRoleName($album->view_role, true).')';

        return $returned;
    }

    /**
     * Удаляем альбом и все аудиозаписи в нем
     */
    public function mUpdate($validate = true, $attributes = null, $withCache = true)
    {
        /** @var CDbTransaction $t */
        $t = null;
        if(null === Yii::app()->db->getCurrentTransaction())
            $t = Yii::app()->db->beginTransaction();

        $error = false;
        try {

            $this->update_datetime = DateTimeFormat::format();
            if(!$this->save($validate, $attributes)) {
                $error = true;
                Yii::app()->message->setErrors('danger', $this);
            }

            if(!$error && $withCache) {
                /** Обновляем кэш */
                if(false === CacheEventItemImage::updateAllByAlbumId($this->id)) {
                    $error = true;
                    MyException::logTxt('[Update] GalleryAlbumImage -> CacheEventItemImage '.$this->id);
                }
            }

            if(!$error && null !== $this->oldViewRole && $this->oldViewRole != $this->view_role) {
                $attributes = array('view_role' => $this->view_role, 'update_datetime' => DateTimeFormat::format());
                if(false === GalleryImage::updateAllByAlbumId($attributes, 'album_id = :album_id', array(':album_id' => $this->id))) {
                    $error = true;
                    MyException::logTxt('[Update] GalleryAlbumImage -> GalleryImage '.$this->id);
                }
            }

            if(null !== $t) {
                if(!$error)
                    $t->commit();
                else
                    $t->rollback();
            }

            return !$error;

        } catch (Exception $ex) {
            if(null !== $t)
                $t->rollback();
            MyException::log($ex);
            return false;
        }
    }

    public function restore($validate = true, $attributes = null, $withCache = true)
    {
        /** @var CDbTransaction $t */
        $t = null;
        if(null === Yii::app()->db->getCurrentTransaction())
            $t = Yii::app()->db->beginTransaction();

        $error = false;
        try {
            $this->is_deleted = 0;
            $this->is_moder_deleted = 0;
            $this->update_datetime = \DateTimeFormat::format();
            if(!$this->save($validate, $attributes)) {
                $error = true;
                Yii::app()->message->setErrors('danger', $this);
            }

            if(!$error && $withCache) {
                /** Обновляем кэш */
                if(false === CacheEventItemImage::updateAllByAlbumId($this->id)) {
                    $error = true;
                    MyException::logTxt('[Restore] GalleryAlbumImage -> CacheEventItemImage '.$this->id);
                }
            }

            if(null !== $t) {
                if(!$error)
                    $t->commit();
                else
                    $t->rollback();
            }

            return !$error;

        } catch (Exception $ex) {
            if(null !== $t)
                $t->rollback();
            MyException::log($ex);
            return false;
        }
    }

    public function create($validate = true, $attributes = null)
    {
        /** @var CDbTransaction $t */
        $t = null;
        if(null === Yii::app()->db->getCurrentTransaction())
            $t = Yii::app()->db->beginTransaction();

        $error = false;
        try {

            $this->create_datetime = DateTimeFormat::format();
            if(!$this->save($validate, $attributes)) {
                $error = true;
                Yii::app()->message->setErrors('danger', $this);
            }

            if(null !== $t) {
                if(!$error)
                    $t->commit();
                else
                    $t->rollback();
            }

            return !$error;

        } catch (Exception $ex) {
            if(null !== $t)
                $t->rollback();

            MyException::log($ex);
            return false;
        }
    }

    /**
     * Удаляем альбом и все аудиозаписи в нем
     */
    public function delete($validate = true, $attributes = null)
    {
        /** @var CDbTransaction $t */
        $t = null;
        if(null === Yii::app()->db->getCurrentTransaction())
            $t = Yii::app()->db->beginTransaction();

        $error = false;
        try {

            $this->user_deleted_datetime = DateTimeFormat::format();
            $this->update_datetime = DateTimeFormat::format();
            if(!$this->save($validate, $attributes)) {
                $error = true;
                Yii::app()->message->setErrors('danger', $this);
            }

            if(!$error) {
                /** Обновляем кэш при удалении */
                if(false === CacheEventItemImage::updateAllByAlbumId($this->id)) {
                    $error = true;
                    MyException::logTxt('[Delete] GalleryAlbumImage -> CacheEventItemImage '.$this->id);
                }
            }

            if(!$error) {
                $rating = GalleryImage::getRatingByAlbum($this->id);
                if($rating > 0) {
                    /** @var UserProfile $UserProfile */
                    $UserProfile = UserProfile::model()->find('user_id = :user_id', array(':user_id' => $this->user_id));
                    $UserProfile->rating -= $rating;
                    if(!$UserProfile->save()) {
                        $error = true;
                        Yii::app()->message->setErrors('danger', $UserProfile);
                    }

                    if($this->is_community) {
                        /** @var \Community $Community */
                        $Community = \Community::model()->findByPk($this->community_id);
                        $Community->rating -= $rating;
                        if(!$Community->mUpdate()) {
                            $error = true;
                            Yii::app()->message->setErrors('danger', $Community);
                        }
                    }
                }

                $attributes = array(
                    'update_datetime' => DateTimeFormat::format(),
                    'is_moder_deleted' => $this->is_moder_deleted,
                    'is_deleted' => $this->is_deleted,
                    'deleted_trunc' => $this->deleted_trunc,
                    'user_deleted_id' => $this->user_deleted_id
                );
                $condition = 'album_id = :album_id and is_deleted = 0 and is_moder_deleted = 0 and deleted_trunc = 0';
                $params = array(':album_id' => $this->id);

                if(false === GalleryImage::updateAllByAlbumId($attributes, $condition, $params)) {
                    $error = true;
                    MyException::logTxt('[Delete] GalleryAlbumImage -> GalleryImage '.$this->id);
                }

                if(false === ItemInfoImage::updateAllByAlbumId($attributes, $condition, $params)) {
                    $error = true;
                    MyException::logTxt('[Delete] GalleryAlbumImage -> ItemInfoImage '.$this->id);
                }
            }

            if(null !== $t) {
                if(!$error)
                    $t->commit();
                else
                    $t->rollback();
            }

            return !$error;

        } catch (Exception $ex) {
            if(null !== $t)
                $t->rollback();
            MyException::log($ex);
            return false;
        }
    }
}