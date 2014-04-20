<?php

class EventsController extends Controller
{	
	
	public function __construct(){
		parent::__construct('events');
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