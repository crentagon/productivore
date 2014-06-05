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
				Yii::app()->user->setFlash('success','Congratulations! You have added a new item to your achievement list.');
				$model->achievement_name = '';
				$model->achievement_condition = '';
				$model->achievement_rewards = 550;
			}
		}
		
		$youHelper = new YouHelper;
		$achievements = $youHelper->get_achievements_byUserIdMode(Yii::app()->user->getId(), $mode);	
		
		$this->render('achievements', compact('mode', 'model', 'achievements'));
	}
	
	//http://localhost/productivore/productivore/you/editachievementfieldajax/field/achievement_name/achievementId/7/value/asdfgh
	public function actionEditAchievementFieldAjax($field, $achievementId, $value){
		if($field != null && $achievementId != null && $value != null){
			$achievements = Achievements::model()->findByPk($achievementId);
			$achievements->$field = $value;
			$achievements->save();
		}
	}
	
	//http://localhost/productivore/productivore/you/deleteachievementajax/achievementId/8
	public function actionDeleteAchievementAjax($achievementId){
		if($achievementId != null){
			$achievements = Achievements::model()->deleteByPk($achievementId);
		}
	}
	
	//http://localhost/productivore/productivore/you/markascompleteajax/achievementId/9
	public function actionMarkAsCompleteAjax($achievementId){
		if($achievementId != null){
			$achievements = Achievements::model()->findByPk($achievementId);
			$achievements->is_completed = 1;
			$achievements->save();
		}
	}
	
	//http://localhost/productivore/productivore/you/updateachievementsettings/valueId/7
	public function actionUpdateAchievementSettings($valueId = null){
		if(!Yii::app()->user->isGuest){
			if($valueId == null){
				Yii::app()->user->setFlash('error','Something\'s definitely not right here. You\'re not trying to hack the system, are you?');		
				$this->render('preview');
			}
			$fieldId = 3;
			$update = array($fieldId=>$valueId); //setting_field_id, field_value_map_id
			$userId = Yii::app()->user->getId(); 
			
			$userApplings = new SidebarHelper;
			$userApplings->update_settingValues_byUserId($userId, $this->applingId, $update);
			Yii::app()->end();
		}
		else{
			throw new CHttpException(404,'The page could not be found.');
			$this->render('index');
		}
	}
	
	
	

}