<?php

/**
 * AchievementsForm class.
 *
 * AchievementsForm is the data structure for keeping
 * the achievements information. It is used by the
 * 'achievements' action of 'ProtagonalController'.
 */
class AchievementsForm extends CFormModel
{
	public $achievement_name;
	public $achievement_condition;
	public $achievement_rewards;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that:
	 * 		achievement_condition, achievement_rewards, achievement_name are required,
	 *		achievement_rewards must be numerical, ranging from 100 to 1000,
	 *		and all fields need to pass through the validateForm() method.
	 */
	public function rules()
	{
		return array(
			array('achievement_condition, achievement_rewards, achievement_name', 'required'),
			array('achievement_rewards', 'numerical', 'min'=>100, 'max'=>1000),
			array('achievement_name', 'length', 'max'=>64),
			array('achievement_name', 'length', 'max'=>256),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'achievement_name'=>'Achievement Title',
			'achievement_rewards'=>'Reward Points',
		);
	}
	
	/**
	 * Adds an achievement target to the database using the model fields.
	 * @return boolean whether addition is successful
	 */
	public function addAchievement(){
		$achievements = new Achievements;
		
		$achievements->achievement_name = $this->achievement_name;
		$achievements->achievement_condition = nl2br($this->achievement_condition);
		$achievements->achievement_rewards = $this->achievement_rewards;
		$achievements->user_id = Yii::app()->user->getId();		
		$achievements->inserted_on = date('Y-m-d H:i:s');		
		
		if($achievements->save()){
			return true;
		}
		return false;
	}
}
