<?php

/**
 * This is the model base class for the table "smiles".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Smiles".
 *
 * Columns in table "smiles" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property integer $owner_id
 * @property string $smile
 * @property integer $access
 *
 */
abstract class BaseSmiles extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'smiles';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Smiles|Smiles', $n);
	}

	public static function representingColumn() {
		return 'smile';
	}

	public function rules() {
		return array(
			array('smile', 'required'),
			array('owner_id, access', 'numerical', 'integerOnly'=>true),
			array('smile', 'length', 'max'=>255),
			array('owner_id, access', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, owner_id, smile, access', 'safe', 'on'=>'search'),
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
			'owner_id' => Yii::t('app', 'Owner'),
			'smile' => Yii::t('app', 'Smile'),
			'access' => Yii::t('app', 'Access'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('owner_id', $this->owner_id);
		$criteria->compare('smile', $this->smile, true);
		$criteria->compare('access', $this->access);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}