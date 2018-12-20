<?php

/**
 * This is the model base class for the table "pool".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Pool".
 *
 * Columns in table "pool" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property integer $post_id
 * @property integer $user_owner_id
 * @property string $question
 * @property string $date_start
 * @property string $date_end
 * @property string $update_datetime
 * @property string $create_datetime
 *
 */
abstract class BasePoll extends MyAR {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'poll';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Pool|Pools', $n);
	}

	public static function representingColumn() {
		return 'question';
	}

	public function rules() {
		return array(
			array('post_id, user_owner_id, question, update_datetime, create_datetime', 'required'),
			array('post_id, user_owner_id', 'numerical', 'integerOnly'=>true),
			array('question', 'length', 'max'=>255),
			array('date_start, date_end', 'safe'),
			array('date_start, date_end', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, post_id, user_owner_id, question, date_start, date_end, update_datetime, create_datetime', 'safe', 'on'=>'search'),
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
			'post_id' => Yii::t('app', 'Post'),
			'user_owner_id' => Yii::t('app', 'User Owner'),
			'question' => Yii::t('app', 'Question'),
			'date_start' => Yii::t('app', 'Date Start'),
			'date_end' => Yii::t('app', 'Date End'),
			'update_datetime' => Yii::t('app', 'Update Datetime'),
			'create_datetime' => Yii::t('app', 'Create Datetime'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('post_id', $this->post_id);
		$criteria->compare('user_owner_id', $this->user_owner_id);
		$criteria->compare('question', $this->question, true);
		$criteria->compare('date_start', $this->date_start, true);
		$criteria->compare('date_end', $this->date_end, true);
		$criteria->compare('update_datetime', $this->update_datetime, true);
		$criteria->compare('create_datetime', $this->create_datetime, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}