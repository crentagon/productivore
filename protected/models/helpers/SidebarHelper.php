<?
class SidebarHelper extends MainHelper
{

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