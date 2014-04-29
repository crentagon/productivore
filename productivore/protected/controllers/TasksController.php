<?php

class TasksController extends Controller
{	
	
	public function __construct(){
		$this->applingId = 1;
		parent::__construct();
	}
	
	public function actionIndex()
	{
		$this->setupPage('Task List - Productivore', array(
			'Task List' => BASE_URL.'/tasks'
		));
		$this->render('index');
	}

}