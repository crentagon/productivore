<?php

class YouController extends Controller
{	
	
	public function __construct(){
		parent::__construct('you');
		$this->populateApplings();
	}
	
	public function actionIndex()
	{
		$this->render('index');
	}

}