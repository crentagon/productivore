<?php

class BudgetController extends Controller
{	
	
	public function __construct(){
		$this->applingId = 3;
		parent::__construct();
	}
	
	public function actionIndex()
	{
		$this->setupPage('Budget Tracker - Productivore', array(
			'Budget Tracker' => BASE_URL.'/budget'
		));
		$this->render('index');
	}
	
}