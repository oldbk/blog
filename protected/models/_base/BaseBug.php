<?php

/**
 * This is the model base class for the table "bug".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Bug".
 *
 * Columns in table "bug" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $description
 *
 */
abstract class BaseBug extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'bug';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Bug|Bugs', $n);
	}

	public static function representingColumn() {
		return 'description';
	}

	public function rules() {
		return array(
			array('description', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('user_id', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, user_id, description', 'safe', 'on'=>'search'),
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
			'user_id' => Yii::t('app', 'User'),
			'description' => Yii::t('app', 'Description'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('description', $this->description, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}