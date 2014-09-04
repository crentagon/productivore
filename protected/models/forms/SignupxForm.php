<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class SignupxForm extends CFormModel
{
	public $username;	
	public $currentEmail;
	public $newEmail;
	public $currentPassword;
	public $newPassword;
	public $newPasswordRepeat;
	
	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('username, currentEmail, newEmail, newPassword, newPasswordRepeat', 'safe'),
			array('newEmail', 'email'),
			array('currentPassword', 'required'),
			array('newPasswordRepeat', 'compare', 'compareAttribute'=>'newPassword'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'newPasswordRepeat'=>'New Password (Repeat)',
		);
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function update()
	{
		//Password is incorrect: throw a flash error, return false.
		$security = new PasswordSecurity;
		$userId = Yii::app()->user->getId();
		$user = Users::model()->findByPk($userId);
		
		if(!$security->validate_password($this->currentPassword, $user->user_password)){
			Yii::app()->user->setFlash('error','Incorrect password.');
			return false;
		}
		
		//Password is correct: update all fields, return true.
		
		if(!empty($this->newEmail))
			$user->user_email = $this->newEmail;
		
		if(!empty($this->newPassword))
			$user->user_password = $security->create_hash($this->newPassword);
		
		if($user->save())
			return true;
		
		if(empty($this->newEmail) && empty($this->newPassword)){
			Yii::app()->user->setFlash('warning','No changes detected.');
			return false;
		}
		/*
		$user = new Users;
		$security = new PasswordSecurity;
		
		$user->user_name = $this->user_name;
		$user->user_password = $security->create_hash($this->password);
		$user->user_email = $this->user_email;
		
		if($user->save()){
			return true;
		}
		return false;
		*/
	}
}
