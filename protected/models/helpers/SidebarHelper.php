<?
class SidebarHelper extends MainHelper
{

	public function get_applings_byUserId($userid = 1){
		$query =
			'SELECT
				appling_id,
				appling_name as name,
				description,
				appling_url as url,
				appling_image as image,
				notification_count as notif_count,
				access_count as accesscount,
				is_favorite as isfavorite
			FROM
				applings
				JOIN user_appling_maps
				USING (appling_id)
			WHERE
				user_id = :userid
			AND appling_id > 0
			ORDER BY accesscount ASC';
		$params = array('userid'=>$userid);
		$applings = $this->sql_query($query, $params);
		
		foreach($applings as &$appling){
			$query = 'SELECT menu_name, menu_url FROM menus WHERE appling_id = :applingId';
			$params = array('applingId'=>$appling['appling_id']);
			$appling['menu_items'] = $this->sql_query($query, $params);
		}
		
		return $applings;
	}
	
	public function get_sidebarSettings_byUserId($userId = 1){
		$query =
			'SELECT
				setting_fields.setting_field_id,
				setting_field_name,
				setting_value_id,
				setting_value_name
			FROM settings
				JOIN setting_field_setting_value_maps USING (setting_field_setting_value_map_id)
				JOIN setting_fields ON setting_field_setting_value_maps.setting_field_id = setting_fields.setting_field_id
				JOIN setting_values USING (setting_value_id)
				JOIN user_appling_maps USING (user_appling_map_id)
			WHERE user_id = :userId
				AND user_appling_maps.appling_id = 0';

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
	
	public function update_settingValues_byUserId($userId = 1, $applingId = 1, $valueArray = array()){
		return parent::update_settingValues_byUserId($userId, $applingId, $valueArray);
	}
}