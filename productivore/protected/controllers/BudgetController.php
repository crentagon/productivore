<?php

class BudgetController extends Controller
{	
	
	public function __construct(){
		$this->applingurl = 'budget';
		parent::__construct($this->applingurl);
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