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
		$error_message = '';
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
			
			$error_message = 'The following fields need to be filled: '.$temp;
			
		}
		
		$fields = array();
		if(strlen($this->achievement_condition) > 256){
			$fields[] = 'Achievement Condition (256 characters maximum)';
		}
		if(strlen($this->achievement_name) > 64){
			$fields[] = 'Achievement Name (64 characters maximum)';
		}
		
		if(count($fields) > 0){
			$temp = '<ul>';
			foreach($fields as $field){
				$temp.='<li>'.$field.'</li>';
			}
			$temp.= '</ul>';
			
			$error_message .= 'The character counts of the following fields exceeded their limits: '.$temp;
		}
		
		if($error_message != '')
			Yii::app()->user->setFlash('error',$error_message);
	}
	
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
