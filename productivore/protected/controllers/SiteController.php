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

}