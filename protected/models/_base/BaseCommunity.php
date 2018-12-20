<?php

/**
 * This is the model base class for the table "community".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Community".
 *
 * Columns in table "community" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property integer $user_owner_id
 * @property string $alias
 * @property string $title
 * @property string $description
 * @property string $image
 * @property integer $view_role
 * @property string $update_datetime
 * @property string $create_datetime
 *
 */
abstract class BaseCommunity extends MyAR {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'community';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Community|Communities', $n);
	}

	public static function representingColumn() {
		return 'alias';
	}

	public function rules() {
		return array(
			array('user_owner_id, alias, title, description, update_datetime, create_datetime', 'required'),
			array('user_owner_id, view_role', 'numerical', 'integerOnly'=>true),
			array('alias, title, image', 'length', 'max'=>255),
			array('image, view_role', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, user_owner_id, alias, title, description, image, view_role, update_datetime, create_datetime', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'user_owner_id' => Yii::t('app', 'User Owner'),
			'alias' => Yii::t('app', 'Alias'),
			'title' => Yii::t('app', 'Title'),
			'description' => Yii::t('app', 'Description'),
			'image' => Yii::t('app', 'Image'),
			'view_role' => Yii::t('app', 'View Role'),
			'update_datetime' => Yii::t('app', 'Update Datetime'),
			'create_datetime' => Yii::t('app', 'Create Datetime'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('user_owner_id', $this->user_owner_id);
		$criteria->compare('alias', $this->alias, true);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('image', $this->image, true);
		$criteria->compare('view_role', $this->view_role);
		$criteria->compare('update_datetime', $this->update_datetime, true);
		$criteria->compare('create_datetime', $this->create_datetime, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}