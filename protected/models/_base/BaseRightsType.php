<?php

/**
 * This is the model base class for the table "access_type".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "AccessType".
 *
 * Columns in table "access_type" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property string $item_name
 * @property string $item_description
 *
 */
abstract class BaseRightsType extends MyAR {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'rights_type';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'AccessType|AccessTypes', $n);
	}

	public static function representingColumn() {
		return 'item_name';
	}

	public function rules() {
		return array(
			array('item_name', 'required'),
			array('item_name', 'length', 'max'=>50),
			array('item_description', 'safe'),
			array('item_description', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, item_name, item_description', 'safe', 'on'=>'search'),
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
			'item_name' => Yii::t('app', 'Item Name'),
			'item_description' => Yii::t('app', 'Item Description'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('item_name', $this->item_name, true);
		$criteria->compare('item_description', $this->item_description, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}