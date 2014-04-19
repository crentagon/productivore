<?php

class TasksController extends Controller
{	
	
	public function __construct(){
		parent::__construct('tasks');
		$this->populateApplings();
	}
	
	public function actionIndex()
	{
		$this->render('index');
	}

}