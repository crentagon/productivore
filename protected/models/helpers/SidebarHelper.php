<?

/**
 * SidebarHelper class.
 *
 * SidebarHelper is a helper file which
 * assists with the operations pertaining
 * to Productivore's sidebar. 
 */
class SidebarHelper extends MainHelper
{

	/**
	* Retrieves the applings accessible by the user, sorted by access count.
	* It also retrieves the applings' menu items.
	*
	* Called by: actionLogin, actionApplings, and actionIndex
	*
	* @param integer the id of the user
	*
	* @return array the appling information:
	* appling_id, name, description, url, image
	* notifcount, accesscounr, isfavorite, message,
	* menu_items:
	*	menu_id, menu_name, menu_url, parent_menu_id
	*/
	public function get_applings_byUserId($userId = 1){
		$query = 'SELECT * FROM f_applings_byuserid_accesscount(:userId)';
		$params = array('userId'=>$userId);
		$applings = $this->sql_query($query, $params);
		
		foreach($applings as &$appling){
			$query = 'SELECT * FROM f_menuitems_byapplingid(:applingId)';
			$params = array('applingId'=>$appling['appling_id']);
			$appling['menu_items'] = $this->sql_query($query, $params);
		}
		
		return $applings;
	}
	
	/**
	* Retrieves the settings pertaining to the site's sidebar.
	*
	* Called by: populateApplings from Controller.php
	*
	* @param integer the id of the user
	*
	* @return array the appling information:
	* setting_field_id, setting_field_name, setting_value_id,
	* setting_value_name
	*/
	public function get_sidebarSettings_byUserId($userId = 1){
		$query = 'SELECT * FROM f_settinginfo_byuserid(:userId)';

		$params = array('userId'=>$userId);
		$rawArray = $this->sql_query($query, $params);
		$newArray = array();
		
		foreach($rawArray as $value){
			$newArray[$value['setting_field_id']] = $value['setting_value_id'];
		}
		
		return $newArray;
	}
	
	public function get_settingValues_byFieldId($fieldId = 1){
		return parent::get_settingValues_byFieldId($fieldId);
	}
	
	public function update_settingValues_byUserId($userId = 1, $applingId = 1, $fieldid, $valueid){
		return parent::update_settingValues_byUserId($userId, $applingId, $fieldid, $valueid);
	}
}