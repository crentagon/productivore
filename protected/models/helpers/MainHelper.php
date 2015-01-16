<?

/**
 * MainHelper class.
 *
 * MainHelper is a the mother of all
 * helper files. A helper file communicates
 * to the database with multi-table operations.
 *
 * The operations contained here are used by
 * multiple areas in Productivore. 
 */
class MainHelper
{
	//SQL Query and SQL Execute, both are SQL Injection-proof
	public function sql_query($query, $params = array()){
		return Yii::app()->db->createCommand($query)->bindValues($params)->queryAll();
	}
	
	public function sql_execute($query, $params = array()){
		return Yii::app()->db->createCommand($query)->bindValues($params)->execute();
	}
	
	/**
	* Retrieves the possible values of a setting field.
	*
	* For example, an "Order By" field would return
	* "Alphabetical", "Most Used", and "Least Used".
	*
	* Currently called by:
	*	populateApplings from Controller.php via SidebarHelper
	*
	* @param integer the id of the setting field
	* @return array the list of possible values of a setting field:
	* setting_value_id, setting_value_name
	*
	*/
	public function get_settingValues_byFieldId($fieldId = 1){
		$query = 'SELECT * FROM f_settingvalues_byfieldid(:fieldId)';
		$params = array('fieldId'=>$fieldId);
		return $this->sql_query($query, $params);
	}
	
	/**
	* Updates a user's settings.
	*
	* For example, if a user sets "Order By" to
	* "Alphabetical", this function updates the
	* database with that information.
	*
	* Currently called by:
	*	actionUpdate_sidebarFieldsAjax from SiteController.php
	*
	* @param integer the id of the user
	* @param integer the id of the appling
	* @param integer the id of the setting field
	* @param integer the id of the setting value
	*
	*/
	public function update_settingValues_byUserId($userId = 1, $applingId = 1, $fieldId, $valueId){
		$query = 'SELECT * FROM p_updatesettingvalues(:userId, :applingId, :fieldId, :valueId)';
		$params = array('userId'=>$userId, 'applingId'=>$applingId, 'fieldId'=>$fieldId, 'valueId'=>$valueId);
		$this->sql_execute($query, $params);
	}
	
	/**
	* Retrieves the appling information given its id.
	*
	* Currently called by:
	*	The constructor of Controller.php
	*
	* @param integer the id of the appling
	* @return array the appling information:
	* appling_url, appling_name
	*
	*/
	public function get_applingInfo_byApplingId($applingId = 0){
		$query = 'SELECT * FROM f_applinginfo_byapplingid(:applingId)';
		$params = array('applingId'=>$applingId);
		return $this->sql_query($query, $params);
	}
	
	/**
	* Retrieves the menu information given its 
	* corresponding appling id.
	*
	* Currently called by:
	*	The constructor of Controller.php
	*
	* @param integer the id of the appling
	* @return array the menu information:
	* menu_id, menu_name, menu_url, parent_menu_id
	*
	*/
	public function get_menuByApplingId($applingId = 0){
		$query = 'SELECT * FROM f_menuitems_byapplingid(:applingId)';
		$params = array('applingId'=>$applingId);
		return $this->sql_query($query, $params);
	}
	
	public function debugPrint($params = array()){
		echo '<pre>';
		print_r($params);
		die();
	}
	
}