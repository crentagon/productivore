<?php

class SiteController extends Controller
{
	public function __construct(){
		parent::__construct('events');
		$this->populateApplings();
	}

	public function actionIndex()
	{
		// $test = 'TEST';
		// print_r($applings); die();
		// echo 'here'; die();
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		// $this->render('index', compact('test'));
		$this->render('index');
	}
	
	
	//Accessing: http://localhost/productivore/productivore/site/update_sidebarfields
	public function actionUpdate_sidebarFields($fieldid = 1, $valueid = 1){
		// echo $fieldid.'>>>'.$valueid; die();
		$update = array($fieldid=>$valueid); //setting_field_id, field_value_map_id
		$userId = 1;
		$applingId = 1;
		
		$userApplings = new SidebarHelper;
		$userApplings->update_settingValues_byUserId($userId, $applingId, $update);
		die();
	}
	
}