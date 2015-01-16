<?

/**
 * HomeHelper class.
 *
 * HomeHelper is a helper file which
 * assists with the operations pertaining
 * to Productivore's homepage. 
 */
class HomeHelper extends MainHelper
{

	/**
	* Retrieves the applings accessible by the user.
	*
	* Called by: actionIndex, actionLogin and actionApplings
	*
	* @param integer the id of the user
	* @param boolean the alphabetical flag, if set to
	* true, the information will be sorted alphabetivally,
	* else, by notification count.
	*
	* @return array the appling information:
	* appling_id, name, description, url, image
	* notifcount, accesscounr, isfavorite, message
	*
	*/
	public function get_applings_byUserId($userid = 1, $isAlphabetical = false){
		$query = 'SELECT * FROM f_applings_byuserid_notifcount(:userid)';		
		if($isAlphabetical)
			$query = 'SELECT * FROM f_applings_byuserid_alphabetical(:userid)';
			
		$params = array('userid'=>$userid);
		return $this->sql_query($query, $params);
	}
	
	/**
	* Sets (or unsets) an appling as a favorite.
	*
	* Called by: actionUpdate_favoritesAjax
	*
	* @param integer the id of the user
	* @param boolean the id of the appling to be marked/unmarked
	* @param integer 1 if it's a favorite, 0 otherwise
	*
	*/
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