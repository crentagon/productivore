<?php

class YouController extends Controller
{	
	
	public function __construct(){
		$this->applingurl = 'you';
		parent::__construct($this->applingurl);
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