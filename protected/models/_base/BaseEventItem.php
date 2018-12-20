<?php

/**
 * This is the model base class for the table "event_item".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "EventItem".
 *
 * Columns in table "event_item" available as properties of the model,
 * followed by relations of table "event_item" available as properties of the model.
 *
 * @property integer $id
 * @property integer $item_id
 * @property integer $user_id
 * @property integer $album_id
 * @property integer $item_type
 * @property string $create_datetime
 *
 * @property User $user
 *
 * @package application.event.models
 */
abstract class BaseEventItem extends MyAR {
    /**
     * @param string $className
     * @return BaseEventItem
     */
    public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    /**
     * @return string
     */
    public function tableName() {
		return 'event_item';
	}

    /**
     * @param int $n
     * @return string
     */
    public static function label($n = 1) {
		return Yii::t('app', 'EventItem|EventItems', $n);
	}

    /**
     * @return array|string
     */
    public static function representingColumn() {
		return 'create_datetime';
	}

    /**
     * @return array
     */
    public function rules() {
		return array(
			array('item_id, user_id, item_type, create_datetime', 'required'),
			array('item_id, user_id, album_id, item_type', 'numerical', 'integerOnly'=>true),
			array('album_id', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, item_id, user_id, album_id, item_type, create_datetime', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array
     */
    public function relations() {
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
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
			'item_id' => Yii::t('app', 'Item'),
			'user_id' => null,
			'album_id' => Yii::t('app', 'Album'),
			'item_type' => Yii::t('app', 'Item Type'),
			'create_datetime' => Yii::t('app', 'Create Datetime'),
			'user' => null,
		);
	}

    /**
     * @return CActiveDataProvider
     */
    public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('item_id', $this->item_id);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('album_id', $this->album_id);
		$criteria->compare('item_type', $this->item_type);
		$criteria->compare('create_datetime', $this->create_datetime, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}