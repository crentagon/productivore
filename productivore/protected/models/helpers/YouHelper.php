<?
class YouHelper extends MainHelper
{

	public function get_achievements_byUserIdMode($userId, $mode = 'index'){
		$isCompleted = 1;
		if($mode == 'index')
			$isCompleted = 0;
	
		$query =
			'SELECT
				achievement_name,
				achievement_condition,
				achievement_rewards,
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
}