<?php

/**
 * AchievementsForm class.
 * AchievementsForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ThoughtsForm extends CFormModel
{
	public $thought_title;
	public $thought_body;
	public $list_id;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('thought_body, list_id', 'required'),
			array('thought_title', 'safe'),
			array('thought_title, thought_body, list_id', 'validateForm'),
		);
	}
	
	public function validateForm()
	{
		$fields = array();
		$error_message = '';
		if(trim($this->thought_body) == ''){
			$fields[] = 'Thought Body';
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
		if(strlen($this->thought_title) > 128){
			$fields[] = 'Thought Title (128 characters maximum)';
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
	
	public function addThoughtEntry(){
		$journalPosts = new JournalPosts;
		
		$journalPosts->title = $this->thought_title;
		$journalPosts->body = $this->thought_body;
		$journalPosts->inserted_on = date('Y-m-d H:i:s');		
		$journalPosts->parent_list_id = $this->list_id;
		$journalPosts->user_id = Yii::app()->user->getId();		
		
		if($journalPosts->save()){
			return true;
		}
		return false;
	}
	 
}
