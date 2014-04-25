<?php

class TasksController extends Controller
{	
	
	public function __construct(){
		$this->applingurl = 'tasks';
		parent::__construct($this->applingurl);
		$this->populateApplings();
	}
	
	public function actionIndex()
	{
		$this->breadcrumbs = array(
			'Task List' => BASE_URL.'/tasks'
		);
		$this->render('index');
	}

}