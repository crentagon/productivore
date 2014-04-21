<?php

class BudgetController extends Controller
{	
	
	public function __construct(){
		parent::__construct('budget');
		$this->populateApplings();
	}
	
	public function actionIndex()
	{
		$this->breadcrumbs = array(
			'Budget Tracker' => BASE_URL.'/budget'
		);
		$this->render('index');
	}
	
}