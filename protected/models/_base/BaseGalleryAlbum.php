<?php

/**
 * This is the model base class for the table "gallery_album".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "GalleryAlbum".
 *
 * Columns in table "gallery_album" available as properties of the model,
 * followed by relations of table "gallery_album" available as properties of the model.
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $description
 * @property integer $is_comment
 * @property integer $is_activated
 * @property integer $is_deleted
 * @property string $create_datetime
 * @property string $update_datetime
 * @property integer $view_role
 * @property string $user_deleted_datetime
 *
 * @property User $user
 * @property GalleryImage[] $galleryImages
 *
 * @package application.gallery.models
 */
abstract class BaseGalleryAlbum extends MyAR
{
    /**
     * @param string $className
     * @return BaseGalleryAlbum
     */
    public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    /**
     * @return string
     */
    public function tableName() {
		return 'gallery_album';
	}

    /**
     * @param int $n
     * @return string
     */
    public static function label($n = 1) {
		return Yii::t('app', 'GalleryAlbum|GalleryAlbums', $n);
	}

    /**
     * @return array|string
     */
    public static function representingColumn() {
		return 'title';
	}

    /**
     * @return array
     */
    public function rules() {
		return array(
			array('user_id, title, create_datetime, update_datetime', 'required'),
			array('user_id, is_comment, is_activated, is_deleted, view_role', 'numerical', 'integerOnly'=>true),
			array('title, description', 'length', 'max'=>255),
			array('user_deleted_datetime', 'length', 'max'=>45),
			array('description, is_comment, is_activated, is_deleted, view_role, user_deleted_datetime', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, user_id, title, description, is_comment, is_activated, is_deleted, create_datetime, update_datetime, view_role, user_deleted_datetime', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array
     */
    public function relations() {
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'galleryImages' => array(self::HAS_MANY, 'GalleryImage', 'album_id'),
		);
	}

    /**
     * @return array
     */
    public function pivotModels() {
		return array(
		);
	}

    /**
     * @return array
     */
    public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'user_id' => null,
			'title' => Yii::t('app', 'Title'),
			'description' => Yii::t('app', 'Description'),
			'is_comment' => Yii::t('app', 'Is Comment'),
			'is_activated' => Yii::t('app', 'Is Activated'),
			'is_deleted' => Yii::t('app', 'Is Deleted'),
			'create_datetime' => Yii::t('app', 'Create Datetime'),
			'update_datetime' => Yii::t('app', 'Update Datetime'),
			'view_role' => Yii::t('app', 'View Role'),
			'user_deleted_datetime' => Yii::t('app', 'User Deleted Datetime'),
			'user' => null,
			'galleryImages' => null,
		);
	}

    /**
     * @return CActiveDataProvider
     */
    public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('is_comment', $this->is_comment);
		$criteria->compare('is_activated', $this->is_activated);
		$criteria->compare('is_deleted', $this->is_deleted);
		$criteria->compare('create_datetime', $this->create_datetime, true);
		$criteria->compare('update_datetime', $this->update_datetime, true);
		$criteria->compare('view_role', $this->view_role);
		$criteria->compare('user_deleted_datetime', $this->user_deleted_datetime, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}