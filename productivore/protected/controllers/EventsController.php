<?php

class EventsController extends Controller
{	
	
	public function __construct(){
		$this->applingId = 2;
		parent::__construct();
	}
	
	public function actionIndex()
	{
		$this->breadcrumbs = array(
			'Event Planner' => BASE_URL.'/events'
		);
		$this->render('index');
	}

}