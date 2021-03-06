<?php

/**
 * This is the model base class for the table "log".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Log".
 *
 * Columns in table "log" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property integer $log_type
 * @property integer $log_level
 * @property string $description1
 * @property string $description2
 * @property string $description3
 * @property integer $owner_user_id
 * @property string $create_datetime
 *
 */
abstract class BaseLog extends MyAR {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'log';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Log|Logs', $n);
	}

	public static function representingColumn() {
		return 'description1';
	}

	public function rules() {
		return array(
			array('log_type, log_level, owner_user_id', 'numerical', 'integerOnly'=>true),
			array('description1, description2, description3, create_datetime', 'safe'),
			array('log_type, log_level, description1, description2, description3, owner_user_id, create_datetime', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, log_type, log_level, description1, description2, description3, owner_user_id, create_datetime', 'safe', 'on'=>'search'),
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
			'log_type' => Yii::t('app', 'Log Type'),
			'log_level' => Yii::t('app', 'Log Warning'),
			'description1' => Yii::t('app', 'Description1'),
			'description2' => Yii::t('app', 'Description2'),
			'description3' => Yii::t('app', 'Description3'),
			'owner_user_id' => Yii::t('app', 'Owner User'),
			'create_datetime' => Yii::t('app', 'Create Datetime'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('log_type', $this->log_type);
		$criteria->compare('log_level', $this->log_level);
		$criteria->compare('description1', $this->description1, true);
		$criteria->compare('description2', $this->description2, true);
		$criteria->compare('description3', $this->description3, true);
		$criteria->compare('owner_user_id', $this->owner_user_id);
		$criteria->compare('create_datetime', $this->create_datetime, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}