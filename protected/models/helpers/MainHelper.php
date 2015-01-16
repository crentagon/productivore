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
		$query = 'SELECT * FROM f_settingvalues_byfieldid(:fieldId)';
		$params = array('fieldId'=>$fieldId);
		return $this->sql_query($query, $params);
	}
	
	public function update_settingValues_byUserId($userId = 1, $applingId = 1, $fieldId, $valueId){
		$query = 'SELECT * FROM p_updatesettingvalues(:userId, :applingId, :fieldId, :valueId)';
		$params = array('userId'=>$userId, 'applingId'=>$applingId, 'fieldId'=>$fieldId, 'valueId'=>$valueId);
		$this->sql_execute($query, $params);
	}
	
	public function get_applingInfo_byApplingId($applingId = 0){
		$query = 'SELECT * FROM f_applinginfo_byapplingid(:applingId)';
		$params = array('applingId'=>$applingId);
		return $this->sql_query($query, $params);
	}
	
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