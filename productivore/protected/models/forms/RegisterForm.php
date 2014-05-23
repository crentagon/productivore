<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class SignupForm extends CFormModel
{
	public $user_email;
	public $user_name;
	public $password;
	public $password_repeat;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('user_email, user_name, password', 'required'),
			array('user_name', 'unique', 'className'=>'Users'),
			array('user_email', 'unique', 'className'=>'Users'),
			array('password', 'length', 'min'=>3, 'max'=>12),
			array('password_repeat', 'compare', 'compareAttribute'=>'password'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'user_email'=>'E-Mail Address',
			'user_name'=>'Username',
			'password_repeat'=>'Password Repeat',
		);
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function signup()
	{
		$user = new Users;
		$security = new PasswordSecurity;
		
		$user->user_name = $this->user_name;
		$user->user_password = $security->create_hash($this->user_password);
		$user->user_email = $this->user_email;
		
		if($user->save()){
			return true;
		}
		return false;
	}
}
