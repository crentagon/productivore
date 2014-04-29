<?php

class YouController extends Controller
{	
	
	public function __construct(){
		$this->applingId = 4;
		parent::__construct();
	}
	
	public function actionIndex()
	{
		$this->setupPage('You - Productivore', array(
			'You' => BASE_URL.'/you'
		));
		$this->render('index');
	}

}