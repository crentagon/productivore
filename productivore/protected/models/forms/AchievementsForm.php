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
	public $reward_points;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('achievement_condition, reward_points', 'required'),
			array('achievement_name', 'safe'),
			array('reward_points', 'numerical', 'min'=>100, 'max'=>1000),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
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
