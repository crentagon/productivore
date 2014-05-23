<?php

/**
 * This is the model class for table "applings".
 *
 * The followings are the available columns in table 'applings':
 * @property integer $appling_id
 * @property string $appling_name
 * @property string $appling_url
 * @property string $appling_message
 * @property string $appling_image
 * @property string $description
 * @property string $createdon
 *
 * The followings are the available model relations:
 * @property Menus[] $menuses
 * @property SettingFieldSettingValueMaps[] $settingFieldSettingValueMaps
 * @property UserApplingMaps[] $userApplingMaps
 */
class Applings extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'applings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('appling_name, appling_url, createdon', 'required'),
			array('appling_name', 'length', 'max'=>32),
			array('appling_url, appling_image', 'length', 'max'=>16),
			array('appling_message, description', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('appling_id, appling_name, appling_url, appling_message, appling_image, description, createdon', 'safe', 'on'=>'search'),
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
			'menuses' => array(self::HAS_MANY, 'Menus', 'appling_id'),
			'settingFieldSettingValueMaps' => array(self::HAS_MANY, 'SettingFieldSettingValueMaps', 'appling_id'),
			'userApplingMaps' => array(self::HAS_MANY, 'UserApplingMaps', 'appling_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'appling_id' => 'Appling',
			'appling_name' => 'Appling Name',
			'appling_url' => 'Appling Url',
			'appling_message' => 'Appling Message',
			'appling_image' => 'Appling Image',
			'description' => 'Description',
			'createdon' => 'Createdon',
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

		$criteria->compare('appling_id',$this->appling_id);
		$criteria->compare('appling_name',$this->appling_name,true);
		$criteria->compare('appling_url',$this->appling_url,true);
		$criteria->compare('appling_message',$this->appling_message,true);
		$criteria->compare('appling_image',$this->appling_image,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('createdon',$this->createdon,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Applings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
