<?php

class EventsController extends Controller
{	
	
	public function __construct(){
		parent::__construct('events');
		$this->populateApplings();
	}
	
	public function actionIndex()
	{
		$this->render('index');
	}

}