<?php

class YouController extends Controller
{	
	
	public function __construct(){
		$this->applingId = 4;
		parent::__construct();
	}
	
	public function actionIndex()
	{
		$this->setupPage('You - Productivore', array(
			'You' => BASE_URL.'/you'
		));
		$this->render('index');
	}
	
	public function actionAchievements($mode = 'index'){
		// $params = 'complete';
		// echo Yii::app()->request->getParam('params'); die();
		$model = new AchievementsForm;
		$this->render('achievements', compact('mode', 'model'));
	}

}