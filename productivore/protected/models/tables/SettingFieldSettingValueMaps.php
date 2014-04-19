<?php

/**
 * This is the model class for table "setting_field_setting_value_maps".
 *
 * The followings are the available columns in table 'setting_field_setting_value_maps':
 * @property integer $setting_field_setting_value_map_id
 * @property integer $appling_id
 * @property integer $setting_field_id
 * @property integer $setting_value_id
 *
 * The followings are the available model relations:
 * @property Applings $appling
 * @property SettingFields $settingField
 * @property SettingValues $settingValue
 * @property Settings[] $settings
 */
class SettingFieldSettingValueMaps extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'setting_field_setting_value_maps';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('appling_id, setting_field_id, setting_value_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('setting_field_setting_value_map_id, appling_id, setting_field_id, setting_value_id', 'safe', 'on'=>'search'),
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
			'appling' => array(self::BELONGS_TO, 'Applings', 'appling_id'),
			'settingField' => array(self::BELONGS_TO, 'SettingFields', 'setting_field_id'),
			'settingValue' => array(self::BELONGS_TO, 'SettingValues', 'setting_value_id'),
			'settings' => array(self::HAS_MANY, 'Settings', 'setting_field_setting_value_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'setting_field_setting_value_map_id' => 'Setting Field Setting Value Map',
			'appling_id' => 'Appling',
			'setting_field_id' => 'Setting Field',
			'setting_value_id' => 'Setting Value',
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

		$criteria->compare('setting_field_setting_value_map_id',$this->setting_field_setting_value_map_id);
		$criteria->compare('appling_id',$this->appling_id);
		$criteria->compare('setting_field_id',$this->setting_field_id);
		$criteria->compare('setting_value_id',$this->setting_value_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SettingFieldSettingValueMaps the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
