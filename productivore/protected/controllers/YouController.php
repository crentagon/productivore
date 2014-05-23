<?php

class YouController extends Controller
{	
	
	public function __construct(){
		$this->applingId = 4;
		parent::__construct();
	}
	
	public function actionIndex(){
		// echo 'here'; die();
		$this->setupPage('You - Productivore', array(
			'You' => BASE_URL.'/you'
		));
		$this->render('index');
	}
	
	public function actionAchievements($mode = 'index'){
		$this->loadScripts('you.js');
		$this->loadStyles('you-achievements.css');
		
		$model = new AchievementsForm;
		
		if(isset($_POST['AchievementsForm'])){
			$model->attributes=$_POST['AchievementsForm'];
			
			if($model->validate() && $model->addAchievement()){
				Yii::app()->user->setFlash('success','Congratulations! You have added a new item to your bucket list.');
				$model->achievement_name = '';
				$model->achievement_condition = '';
				$model->achievement_rewards = 550;
			}
		}
		
		$youHelper = new YouHelper;
		$achievements = $youHelper->get_achievements_byUserIdMode(Yii::app()->user->getId(), $mode);	
		
		$this->render('achievements', compact('mode', 'model', 'achievements'));
	}

}