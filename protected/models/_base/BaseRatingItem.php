<?php

/**
 * This is the model base class for the table "rating_item".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "RatingItem".
 *
 * Columns in table "rating_item" available as properties of the model,
 * followed by relations of table "rating_item" available as properties of the model.
 *
 * @property integer $item_id
 * @property integer $user_id
 * @property integer $item_type
 * @property string $create_datetime
 *
 * @property User $user
 *
 * @package application.rating.models
 */
abstract class BaseRatingItem extends MyAR
{
    /**
     * @param string $className
     * @return BaseRatingItem
     */
    public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    /**
     * @return string
     */
    public function tableName() {
		return 'rating_item';
	}

    /**
     * @param int $n
     * @return string
     */
    public static function label($n = 1) {
		return Yii::t('app', 'RatingItem|RatingItems', $n);
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
			array('item_id, user_id, item_type', 'numerical', 'integerOnly'=>true),
			array('item_id, user_id, item_type, create_datetime', 'safe', 'on'=>'search'),
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
			'item_id' => Yii::t('app', 'Item'),
			'user_id' => null,
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

		$criteria->compare('item_id', $this->item_id);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('item_type', $this->item_type);
		$criteria->compare('create_datetime', $this->create_datetime, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}