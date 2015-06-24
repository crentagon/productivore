<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	private $_name;

	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$model = new Users;
		$security = new PasswordSecurity;
		$users = $model->fetchUsers();
		
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if(!$security->validate_password($this->password, $users[$this->username]))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else{
			$user = Users::model()->findByAttributes(array('user_name'=>$this->username));
			$this->_id = $user->user_id;
			$this->_name = $user->user_name;
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}
	
	public function getId()
    {
        return $this->_id;
    }
	public function getName()
    {
        return $this->_name;
    }
}