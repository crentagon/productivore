<?
class MainHelper
{
	//SQL-Injection-proof.
	public function sql_query($query, $params = array()){
		return Yii::app()->db->createCommand($query)->bindValues($params)->queryAll();
	}
	
	public function sql_execute($query, $params = array()){
		return Yii::app()->db->createCommand($query)->bindValues($params)->execute();
	}
	
	public function get_settingValues_byFieldId($fieldId = 1){
		$query =
			'SELECT 
				setting_value_id,
				setting_value_name
			FROM setting_field_setting_value_maps
				JOIN setting_values USING (setting_value_id)
				WHERE setting_field_id = :fieldId;';

		$params = array('fieldId'=>$fieldId);
		return $this->sql_query($query, $params);
	}
	
	
	public function update_settingValues_byUserId($userId = 1, $applingId = 1, $valueArray = array()){
		//Get the user_appling_id given userId and applingId
		$query = '
			SELECT user_appling_map_id
			FROM user_appling_maps
			WHERE user_id = :userId
			AND appling_id = :applingId';
				
		$params = array('userId'=>$userId, 'applingId'=>$applingId);
		
		$userApplingId = $this->sql_query($query, $params);
		if(isset($userApplingId[0]['user_appling_map_id']))
			$userApplingId = $userApplingId[0]['user_appling_map_id'];
		else{
			throw new CHttpException(404,'The page could not be found.');
			return false;
		}
		
		foreach($valueArray as $key=>$value){
			//Get the map_id that corresponds to the field and valueid
			$query = '
				SELECT setting_field_setting_value_map_id
				FROM setting_field_setting_value_maps
				WHERE setting_field_id = :settingFieldId
				AND setting_value_id = :settingValueId';
				
			$params = array('settingFieldId'=>$key, 'settingValueId'=>$value);
			$settingFieldSettingValueMapId = $this->sql_query($query, $params);
			if(isset($settingFieldSettingValueMapId[0]['setting_field_setting_value_map_id']))
				$settingFieldSettingValueMapId = $settingFieldSettingValueMapId[0]['setting_field_setting_value_map_id'];	
			else{
				throw new CHttpException(404,'The page could not be found.');
				return false;
			}
			//Use the userid, applingid and the fieldid to set the mapid to the retrieved mapid
			$query = '
				UPDATE settings
				SET setting_field_setting_value_map_id = :settingFieldSettingValueMapId
				WHERE settings.setting_field_id = :settingFieldId
				AND user_appling_map_id = :userApplingId
			';
			
			$params = array(
				'settingFieldSettingValueMapId' => $settingFieldSettingValueMapId,
				'settingFieldId' => $key,
				'userApplingId' => $userApplingId
			);
			
			$this->sql_execute($query, $params);
		}
	}
	
	public function get_applingInfo_byApplingId($applingId = 0){
		
		
		// Applings::model()->findByAttributes(array('appling_id'=>$applingId));
		
		 // Yii::app()->db->createCommand()
				// ->select('appling_url')
				// ->from('applings')
				// ->where('appling_id=:appling_id', array(':appling_id'=>$applingId))
				// ->queryAll();
				
		$query = '
			SELECT appling_url, appling_name
			FROM applings
			WHERE appling_id = :applingId';
			
		$params = array('applingId'=>$applingId);
		return $this->sql_query($query, $params);
		// echo 'here'; die();
		
		// return 1;
	}
	
	public function get_menuByApplingId($applingId = 0){
		$query = '
			SELECT menu_id, menu_name, menu_url, parent_menu_id
			FROM menus
			WHERE appling_id = :applingId';
			
		$params = array('applingId'=>$applingId);
		
		return $this->sql_query($query, $params);
	}
	
	public function debugPrint($params = array()){
		echo '<pre>';
		print_r($params);
		die();
	}
	
}