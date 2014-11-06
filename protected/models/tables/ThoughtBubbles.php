<?php

/**
 * This is the model class for table "thought_bubbles".
 *
 * The followings are the available columns in table 'thought_bubbles':
 * @property integer $thought_bubble_id
 * @property string $title
 * @property string $body
 * @property string $inserted_on
 * @property boolean $is_latest_version
 * @property integer $parent_post_id
 * @property integer $parent_list_id
 * @property integer $user_id
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property ThoughtLists $parentList
 * @property ThoughtBubbles $parentPost
 * @property ThoughtBubbles[] $thoughtBubbles
 */
class ThoughtBubbles extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'thought_bubbles';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent_post_id, parent_list_id, user_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>128),
			array('body, inserted_on, is_latest_version', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('thought_bubble_id, title, body, inserted_on, is_latest_version, parent_post_id, parent_list_id, user_id', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'parentList' => array(self::BELONGS_TO, 'ThoughtLists', 'parent_list_id'),
			'parentPost' => array(self::BELONGS_TO, 'ThoughtBubbles', 'parent_post_id'),
			'thoughtBubbles' => array(self::HAS_MANY, 'ThoughtBubbles', 'parent_post_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'thought_bubble_id' => 'Journal Post',
			'title' => 'Title',
			'body' => 'Body',
			'inserted_on' => 'Inserted On',
			'is_latest_version' => 'Is Latest Version',
			'parent_post_id' => 'Parent Post',
			'parent_list_id' => 'Parent List',
			'user_id' => 'User',
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

		$criteria->compare('thought_bubble_id',$this->thought_bubble_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('inserted_on',$this->inserted_on,true);
		$criteria->compare('is_latest_version',$this->is_latest_version);
		$criteria->compare('parent_post_id',$this->parent_post_id);
		$criteria->compare('parent_list_id',$this->parent_list_id);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ThoughtBubbles the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
