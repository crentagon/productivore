<?

/**
 * ProtagonalHelper class.
 *
 * ProtagonalHelper is a helper file which
 * assists with the operations pertaining
 * to Productivore's Protagonal appling. 
 */
class ProtagonalHelper extends MainHelper
{

	/**
	* Retrieves the user's list of achievements.
	*
	* Called by: actionAchievements
	*
	* @param integer the id of the user
	* @param string the mode: "index" for the outstanding
	* achievements, and "complete" for unlocked achievements.
	*
	* @return array the achievements:
	* achievement_id, achievement_name, achievement_condition,
	* achievement_rewards, completion_notes, inserted_on, completed_on
	*
	*/
	public function get_achievements_byUserIdMode($userId, $mode = 'index'){
		$isCompleted = 1;
		if($mode == 'index')
			$isCompleted = 0;
	
		$query = 'SELECT * FROM f_achievementinfo_byuserid(:userId, :isCompleted)';
		$params = array('userId'=>$userId, 'isCompleted'=>$isCompleted);		
		return $this->sql_query($query, $params);
	}
	
	/**
	* Retrieves the user's thought bubble lists.
	*
	* Called by: actionThoughts
	*
	* @param integer the id of the user
	*
	* @return array the achievements:
	* thought_list_id, name, is_last_accessed
	*
	*/
	public function get_thoughtlist_byUserId($userId){
		$query = 'SELECT * FROM f_thoughtlists_byuserid(:userId)';
		$params = array('userId'=>$userId);		
		return $this->sql_query($query, $params);
	}
	
	/**
	* Retrieves the user's thought bubbles.
	*
	* Called by: actionGetNextThoughtBubblesAjax and actionThoughts
	*
	* @param integer the id of the user
	* @param integer the id of the thought bubble list
	* @param integer the id of the starting thought bubble
	* (if endless scrolling)
	*
	* @return array the achievements:
	* thought_bubble_id, title, body, inserted_on
	*
	*/
	public function get_thoughtbubbles_byUserIdListIdThoughtBubbleId($userId, $listId, $thoughtBubbleId = null){
		$query = 'SELECT * FROM f_thoughtbubbles_byuseridlistid(:userId, :listId)';
		$params = array('userId'=>$userId, 'listId'=>$listId);

		if($thoughtBubbleId != null){
			$query = 'SELECT * FROM f_thoughtbubbles_byuseridlistidthoughtbubbleid(:userId, :listId, :thoughtBubbleId)';
			$params['thoughtBubbleId'] = $thoughtBubbleId;
		}
		
		return $this->sql_query($query, $params);
	}
	
	/**
	* Sets the active thought bubble list.
	*
	* Called by: actionGetNextThoughtBubblesAjax
	*
	* @param integer the id of the user
	* @param integer the id of the thought bubble list
	*
	*/
	public function setActiveThoughtList($userId, $listId){
		$query = 'SELECT * FROM p_setactivethoughtlist(:userId, :listId)';
		$params = array('userId'=>$userId, 'listId'=>$listId);
		return $this->sql_execute($query, $params);
	}
	
}