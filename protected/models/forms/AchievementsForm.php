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
			// TODO: Length of the textfields
		);
	}
	
	// public function validateForm()
	// {
	// 	$fields = array();
	// 	$error_message = '';
	// 	if(trim($this->achievement_name) == ''){
	// 		$fields[] = 'Achievement Title';
	// 	}
	// 	if(trim($this->achievement_condition) == ''){
	// 		$fields[] = 'Achievement Condition';
	// 	}
	// 	if(trim($this->achievement_rewards) == ''){
	// 		$fields[] = 'Achievement Rewards';
	// 	}
		
	// 	if(count($fields) > 0){
	// 		$temp = '<ul>';
	// 		foreach($fields as $field){
	// 			$temp.='<li>'.$field.'</li>';
	// 		}
	// 		$temp.= '</ul>';
			
	// 		$error_message = 'The following fields need to be filled: '.$temp;
	// 	}
		
	// 	$fields = array();
	// 	if(strlen($this->achievement_condition) > 256){
	// 		$fields[] = 'Achievement Condition (256 characters maximum)';
	// 	}
	// 	if(strlen($this->achievement_name) > 64){
	// 		$fields[] = 'Achievement Name (64 characters maximum)';
	// 	}
		
	// 	if(count($fields) > 0){
	// 		$temp = '<ul>';
	// 		foreach($fields as $field){
	// 			$temp.='<li>'.$field.'</li>';
	// 		}
	// 		$temp.= '</ul>';
			
	// 		$error_message .= 'The character counts of the following fields exceeded their limits: '.$temp;
	// 	}
		
	// 	// echo $error_message.'<<<'; die();
	// 	if($error_message != '')
	// 		Yii::app()->user->setFlash('error',$error_message);
	// }
	
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
}
