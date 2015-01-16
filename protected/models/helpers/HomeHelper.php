<?
class HomeHelper extends MainHelper
{

	public function get_applings_byUserId($userid = 1, $isAlphabetical = false){
		$query = 'SELECT * FROM f_applings_byuserid_notifcount(:userid)';		
		if($isAlphabetical)
			$query = 'SELECT * FROM f_applings_byuserid_alphabetical(:userid)';
			
		$params = array('userid'=>$userid);
		return $this->sql_query($query, $params);
	}
	
	public function update_favoriteApplings_byUserId($userId, $applingId, $isFavorite){
			
		$query = 'SELECT * FROM p_setfavorite(:isFavorite, :userId, :applingId)';
		
		$params = array(
			'userId'=>$userId,
			'applingId'=>$applingId,
			'isFavorite'=>$isFavorite
		);
		
		echo $this->sql_execute($query, $params);
	}
	
}