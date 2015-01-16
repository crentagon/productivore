<?
class ProtagonalHelper extends MainHelper
{

	public function get_achievements_byUserIdMode($userId, $mode = 'index'){
		$isCompleted = 1;
		if($mode == 'index')
			$isCompleted = 0;
	
		$query = 'SELECT * FROM f_achievementinfo_byuserid(:userId, :isCompleted)';
		$params = array('userId'=>$userId, 'isCompleted'=>$isCompleted);		
		return $this->sql_query($query, $params);
	}
	
	public function get_thoughtlist_byUserId($userId){
		$query = 'SELECT * FROM f_thoughtlists_byuserid(:userId)';
		$params = array('userId'=>$userId);		
		return $this->sql_query($query, $params);
	}
	
	public function get_thoughtbubbles_byUserIdListIdThoughtBubbleId($userId, $listId, $thoughtBubbleId = null){
		$query = 'SELECT * FROM f_thoughtbubbles_byuseridlistid(:userId, :listId)';
		$params = array('userId'=>$userId, 'listId'=>$listId);

		if($thoughtBubbleId != null){
			$query = 'SELECT * FROM f_thoughtbubbles_byuseridlistidthoughtbubbleid(:userId, :listId, :thoughtBubbleId)';
			$params['thoughtBubbleId'] = $thoughtBubbleId;
		}
		
		return $this->sql_query($query, $params);
	}
	
	public function setActiveThoughtList($userId, $listId){
		$query = 'SELECT * FROM p_setactivethoughtlist(:userId, :listId)';
		$params = array('userId'=>$userId, 'listId'=>$listId);
		return $this->sql_execute($query, $params);
	}
	
}