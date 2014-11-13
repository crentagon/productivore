<?
class ProtagonalHelper extends MainHelper
{

	public function get_achievements_byUserIdMode($userId, $mode = 'index'){
		$isCompleted = 1;
		if($mode == 'index')
			$isCompleted = 0;
	
		$query =
			'SELECT
				achievement_id,
				achievement_name,
				achievement_condition,
				achievement_rewards,
				completion_notes,
				inserted_on,
				completed_on
			FROM
				achievements
			WHERE
				user_id = :userId
			AND
				is_completed = :isCompleted
			ORDER BY achievement_rewards';
		$params = array('userId'=>$userId, 'isCompleted'=>$isCompleted);		
		return $this->sql_query($query, $params);
	}
	
	public function get_thoughtlist_byUserId($userId){
		$query =
			'SELECT
				thought_list_id,
				name,
				is_last_accessed
			FROM
				thought_lists
			WHERE
				user_id = :userId
			ORDER BY is_last_accessed DESC';
		$params = array('userId'=>$userId);		
		return $this->sql_query($query, $params);
	}
	
	public function get_thoughtbubbles_byUserIdListIdThoughtBubbleId($userId, $listId, $thoughtBubbleId = null){
		$query =
			'SELECT
				thought_bubble_id,
				title,
				body,
				inserted_on				
			FROM
				thought_bubbles
			WHERE
				user_id = :userId
				AND is_latest_version = TRUE
				AND parent_list_id = :listId';
		$params = array('userId'=>$userId, 'listId'=>$listId);

		if($thoughtBubbleId != null){
			$query.=' AND thought_bubble_id < :thoughtBubbleId';
			$params['thoughtBubbleId'] = $thoughtBubbleId;
		}
		
		$query.=' ORDER BY inserted_on DESC
			LIMIT 10';
		
		return $this->sql_query($query, $params);
	}
	
	public function setActiveThoughtList($userId, $listId){
		$query = '
			UPDATE thought_lists
			SET is_last_accessed = FALSE
			WHERE user_id = :userId
		';
		$params = array('userId'=>$userId);
		$this->sql_execute($query, $params);
		
		$query = '
			UPDATE thought_lists
			SET is_last_accessed = TRUE
			AND thought_list_id = :listId
		';
		$params = array('listId'=>$listId);
		return $this->sql_execute($query, $params);
	}
	
}