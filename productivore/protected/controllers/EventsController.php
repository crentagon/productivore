<?php

class EventsController extends Controller
{	
	
	public function __construct(){
		$this->applingurl = 'events';
		parent::__construct($this->applingurl);
		$this->populateApplings();
	}
	
	public function actionIndex()
	{
		$this->breadcrumbs = array(
			'Event Planner' => BASE_URL.'/events'
		);
		$this->render('index');
	}

}