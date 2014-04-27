<?php

class SiteController extends Controller
{
	public function __construct(){
		$this->applingId = 0;
		parent::__construct();
	}

	public function actionIndex()
	{
		$this->render('index');
	}
	
	
	//Accessing: http://localhost/productivore/productivore/site/update_sidebarfields
	public function actionUpdate_sidebarFields($fieldid = 1, $valueid = 1){
		// echo $fieldid.'>>>'.$valueid; die();
		$update = array($fieldid=>$valueid); //setting_field_id, field_value_map_id
		$userId = 1;
		$applingId = 0;
		
		$userApplings = new SidebarHelper;
		$userApplings->update_settingValues_byUserId($userId, $applingId, $update);
		die();
	}
	
	public function actionItema(){ echo 'Entered Item A'; die(); }
	public function actionItemb(){ echo 'Entered Item B'; die(); }
	public function actionItemc(){ echo 'Entered Item C'; die(); }
	public function actionItemd(){ echo 'Entered Item D'; die(); }
	public function actionIteme(){ echo 'Entered Item E'; die(); }
	public function actionItemw(){ echo 'Entered Item W'; die(); }
	public function actionItemx(){ echo 'Entered Item X'; die(); }
	public function actionItemy(){ echo 'Entered Item Y'; die(); }
	public function actionItemz(){ echo 'Entered Item Z'; die(); }
	
}