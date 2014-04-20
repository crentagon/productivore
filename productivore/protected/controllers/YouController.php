<?php

class YouController extends Controller
{	
	
	public function __construct(){
		parent::__construct('you');
		$this->populateApplings();
	}
	
	public function actionIndex()
	{
		$this->breadcrumbs = array(
			'You' => BASE_URL.'/you'
		);
		$this->render('index');
	}

}