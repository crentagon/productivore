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
}