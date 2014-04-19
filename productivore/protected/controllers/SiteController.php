<?php

class SiteController extends Controller
{

	public function __construct(){
		parent::__construct('site');
		$this->populateApplings();
	}

	public function actionIndex()
	{
		$test = 'TEST';
		// print_r($applings); die();
		// echo 'here'; die();
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index', compact('test'));
	}
	
	
	//Accessing: http://localhost/productivore/productivore/site/update_orderbyfields
	public function actionUpdate_orderByFields(){
		$update = array('1'=>1); //setting_field_id, field_value_map_id
		$userId = 1;
		$applingId = 1;
		
		$userApplings = new SidebarHelper;
		$userApplings->update_settingValues_byUserId($userId, $applingId, $update);
		echo 'Updated!'; die();
	}
	
	
	//Accessing: http://localhost/productivore/productivore/site/update_viewbyfields
	public function actionUpdate_viewByFields(){
		$update = array('2'=>5); //setting_field_id, field_value_map_id
		$userId = 1;
		$applingId = 1;
		
		$userApplings = new SidebarHelper;
		$userApplings->update_settingValues_byUserId($userId, $applingId, $update);
		echo 'Updated!'; die();
	}

}