<?php

/**
 * This is the model class for table "user_appling_maps".
 *
 * The followings are the available columns in table 'user_appling_maps':
 * @property integer $user_appling_map_id
 * @property integer $user_id
 * @property integer $appling_id
 * @property string $notification_count
 * @property string $access_count
 * @property integer $is_favorite
 *
 * The followings are the available model relations:
 * @property Settings[] $settings
 * @property Applings $appling
 * @property Users $user
 */
class UserApplingMaps extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_appling_maps';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, appling_id, is_favorite', 'numerical', 'integerOnly'=>true),
			array('notification_count, access_count', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_appling_map_id, user_id, appling_id, notification_count, access_count, is_favorite', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'settings' => array(self::HAS_MANY, 'Settings', 'user_appling_map_id'),
			'appling' => array(self::BELONGS_TO, 'Applings', 'appling_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_appling_map_id' => 'User Appling Map',
			'user_id' => 'User',
			'appling_id' => 'Appling',
			'notification_count' => 'Notification Count',
			'access_count' => 'Access Count',
			'is_favorite' => 'Is Favorite',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('user_appling_map_id',$this->user_appling_map_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('appling_id',$this->appling_id);
		$criteria->compare('notification_count',$this->notification_count,true);
		$criteria->compare('access_count',$this->access_count,true);
		$criteria->compare('is_favorite',$this->is_favorite);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserApplingMaps the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
