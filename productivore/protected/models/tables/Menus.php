<?php

/**
 * This is the model class for table "menus".
 *
 * The followings are the available columns in table 'menus':
 * @property integer $menu_id
 * @property string $menu_name
 * @property string $menu_url
 * @property integer $appling_id
 * @property integer $parent_menu_id
 *
 * The followings are the available model relations:
 * @property Applings $appling
 * @property Menus $parentMenu
 * @property Menus[] $menuses
 */
class Menus extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'menus';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('menu_name, menu_url', 'required'),
			array('appling_id, parent_menu_id', 'numerical', 'integerOnly'=>true),
			array('menu_name', 'length', 'max'=>64),
			array('menu_url', 'length', 'max'=>32),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('menu_id, menu_name, menu_url, appling_id, parent_menu_id', 'safe', 'on'=>'search'),
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
			'parentMenu' => array(self::BELONGS_TO, 'Menus', 'parent_menu_id'),
			'menuses' => array(self::HAS_MANY, 'Menus', 'parent_menu_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'menu_id' => 'Menu',
			'menu_name' => 'Menu Name',
			'menu_url' => 'Menu Url',
			'appling_id' => 'Appling',
			'parent_menu_id' => 'Parent Menu',
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

		$criteria->compare('menu_id',$this->menu_id);
		$criteria->compare('menu_name',$this->menu_name,true);
		$criteria->compare('menu_url',$this->menu_url,true);
		$criteria->compare('appling_id',$this->appling_id);
		$criteria->compare('parent_menu_id',$this->parent_menu_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Menus the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
