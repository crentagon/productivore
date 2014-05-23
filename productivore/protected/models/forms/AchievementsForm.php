<?php

/**
 * AchievementsForm class.
 * AchievementsForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class AchievementsForm extends CFormModel
{
	public $achievement_name;
	public $achievement_condition;
	public $achievement_rewards;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('achievement_condition, achievement_rewards', 'required'),
			array('achievement_name', 'safe'),
			array('achievement_rewards', 'numerical', 'min'=>100, 'max'=>1000),
			array('achievement_rewards, achievement_condition', 'validateForm'),
		);
	}
	
	public function validateForm()
	{
		$fields = array();
		if(trim($this->achievement_condition) == ''){
			$fields[] = 'Achievement Condition';
		}
		if(trim($this->achievement_rewards) == ''){
			$fields[] = 'Achievement Rewards';
		}
		
		if(count($fields) > 0){
			$temp = '<ul>';
			foreach($fields as $field){
				$temp.='<li>'.$field.'</li>';
			}
			$temp.= '</ul>';
			
			Yii::app()->user->setFlash('error','The following fields need to be filled: '.$temp);
		}
		
	}
	
	public function addAchievement(){
		$achievements = new Achievements;
		
		$achievements->achievement_name = $this->achievement_name;
		$achievements->achievement_condition = $this->achievement_condition;
		$achievements->achievement_rewards = $this->achievement_rewards;
		$achievements->user_id = Yii::app()->user->getId();		
		$achievements->inserted_on = date('Y-m-d H:i:s');		
		
		if($achievements->save()){
			return true;
		}
		return false;
	
		// echo $this->achievement_name.'>>>'.$this->achievement_condition.'>>>'.$this->achievement_rewards; die();
	}
	 
	 
	// public function signup()
	// {
		// $user = new Users;
		// $security = new PasswordSecurity;
		
		// $user->user_name = $this->user_name;
		// $user->user_password = $security->create_hash($this->password);
		// $user->user_email = $this->user_email;
		
		// if($user->save()){
			// return true;
		// }
		// return false;
	// }
}
