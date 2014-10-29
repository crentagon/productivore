<?php

/**
 * This is the model class for table "journal_lists".
 *
 * The followings are the available columns in table 'journal_lists':
 * @property integer $journal_list_id
 * @property string $name
 * @property integer $user_id
 * @property boolean $is_last_accessed
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property JournalPosts[] $journalPosts
 */
class JournalLists extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'journal_lists';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>64),
			array('is_last_accessed', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('journal_list_id, name, user_id, is_last_accessed', 'safe', 'on'=>'search'),
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
			'journalPosts' => array(self::HAS_MANY, 'JournalPosts', 'parent_list_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'journal_list_id' => 'Journal List',
			'name' => 'Name',
			'user_id' => 'User',
			'is_last_accessed' => 'Is Last Accessed',
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

		$criteria->compare('journal_list_id',$this->journal_list_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('is_last_accessed',$this->is_last_accessed);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return JournalLists the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
