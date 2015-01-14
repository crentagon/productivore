<?php

/**
 * ThoughtsForm class.
 *
 * ThoughtsForm is the data structure for keeping
 * thought bubble information. It is used by the
 * 'thoughts' action of 'ProtagonalController'.
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
			array('thought_body, list_id, thought_title', 'required'),
			array('thought_title', 'length', 'max'=>128),
			// array('thought_title', 'safe'),
			// array('thought_title, thought_body, list_id', 'validateForm'),
		);
	}
	
	/**
	 * Adds a new thought bubble given the model fields.
	 * @return boolean whether adding is successful.
	 */
	public function addThoughtEntry(){
		$thoughtBubbles = new ThoughtBubbles;
		
		$thoughtBubbles->title = $this->thought_title;
		$thoughtBubbles->body = $this->thought_body;
		$thoughtBubbles->inserted_on = date('Y-m-d H:i:s');		
		$thoughtBubbles->parent_list_id = $this->list_id;
		$thoughtBubbles->user_id = Yii::app()->user->getId();		
		
		if($thoughtBubbles->save()){
			return true;
		}
		return false;
	}
	 
}
