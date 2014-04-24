<?
class SidebarHelper extends MainHelper
{

	public function readApplings_byUserId($userid = 1){
		$query =
			'SELECT
				appling_name as name,
				description,
				appling_url as url,
				appling_image as image,
				notification_count as notifCount,
				access_count as accessCount
			FROM
				applings
				JOIN user_appling_maps
				USING (appling_id)
			WHERE
				user_id = :userid
			AND appling_id > 0
			ORDER BY accessCount ASC';
		$params = array('userid'=>$userid);
		return $this->sql_query($query, $params);
	}
	
	public function readSidebarSettings_byUserId($userId = 1){
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
				AND user_appling_maps.appling_id = 1';

		$params = array('userId'=>$userId);
		$rawArray = $this->sql_query($query, $params);
		$newArray = array();
		
		foreach($rawArray as $value){
			$newArray[$value['setting_field_id']] = $value['setting_value_id'];
		}
		
		return $newArray;
	}
	
	public function read_settingValues_byFieldId($fieldId = 1){
		return parent::read_settingValues_byFieldId($fieldId);
	}
	
	public function update_settingValues_byUserId($userId = 1, $applingId = 1, $valueArray = array()){
		return parent::update_settingValues_byUserId($userId, $applingId, $valueArray);
	}
}