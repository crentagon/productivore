<?php

/**
 * This is the model class for table "achievements".
 *
 * The followings are the available columns in table 'achievements':
 * @property integer $achievement_id
 * @property string $achievement_name
 * @property string $achievement_condition
 * @property integer $achievement_rewards
 * @property string $completion_notes
 * @property integer $user_id
 * @property integer $is_completed
 * @property string $completed_on
 * @property string $inserted_on
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Achievements extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'achievements';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('achievement_rewards, user_id, is_completed', 'numerical', 'integerOnly'=>true),
			array('achievement_name, completion_notes', 'length', 'max'=>64),
			array('achievement_condition', 'length', 'max'=>256),
			array('completed_on, inserted_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('achievement_id, achievement_name, achievement_condition, achievement_rewards, completion_notes, user_id, is_completed, completed_on, inserted_on', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'achievement_id' => 'Achievement',
			'achievement_name' => 'Achievement Name',
			'achievement_condition' => 'Achievement Condition',
			'achievement_rewards' => 'Achievement Rewards',
			'completion_notes' => 'Completion Notes',
			'user_id' => 'User',
			'is_completed' => 'Is Completed',
			'completed_on' => 'Completed On',
			'inserted_on' => 'Inserted On',
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

		$criteria->compare('achievement_id',$this->achievement_id);
		$criteria->compare('achievement_name',$this->achievement_name,true);
		$criteria->compare('achievement_condition',$this->achievement_condition,true);
		$criteria->compare('achievement_rewards',$this->achievement_rewards);
		$criteria->compare('completion_notes',$this->completion_notes,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('is_completed',$this->is_completed);
		$criteria->compare('completed_on',$this->completed_on,true);
		$criteria->compare('inserted_on',$this->inserted_on,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Achievements the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
