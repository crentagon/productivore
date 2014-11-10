<?php

class ProtagonalController extends Controller
{	
	
	public function __construct(){
		$this->applingId = 4;
		parent::__construct();
	}
	
	public function actionIndex(){
		// echo 'here'; die();
		$this->setupPage('Protagonal - Productivore', array(
			'Protagonal' => BASE_URL.'/protagonal'
		));
		$this->render('index');
	}
	
	public function actionAchievements($mode = 'index'){
		$this->setupPage('Protagonal - Productivore', array(
			'Protagonal' => BASE_URL.'/protagonal',
			'Achievements' => BASE_URL.'/protagonal/achievements'
		));
		
		$this->loadScripts('protagonal.js');
		$this->loadStyles('protagonal-achievements.css');
		
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
		
		$protagonalHelper = new ProtagonalHelper;
		$achievements = $protagonalHelper->get_achievements_byUserIdMode(Yii::app()->user->getId(), $mode);	
		
		$this->render('achievements', compact('mode', 'model', 'achievements'));
	}
	
	public function actionThoughts(){
		$this->loadScripts('protagonal-thoughts.js');
		$this->loadStyles('protagonal-thoughts.css');
	
		$model = new ThoughtsForm;
		
		if(isset($_POST['ThoughtsForm'])){
			$model->attributes=$_POST['ThoughtsForm'];
			
			if($model->validate() && $model->addThoughtEntry()){
				Yii::app()->user->setFlash('success','A new thought bubble has been added to your sea of reflections.');
				$model->thought_title = '';
				$model->thought_body = '';
			}
		}
		
		$userId = Yii::app()->user->getId();
		
		$protagonalHelper = new ProtagonalHelper;
		$thoughtList = $protagonalHelper->get_thoughtlist_byUserId($userId);
		
		$listId = $thoughtList[0]['thought_list_id'];
		$thoughtBubbleList = $protagonalHelper->get_thoughtbubbles_byUserIdListIdThoughtBubbleId($userId, $listId);
	
		// $this->debugPrint($listId);
		$this->render('thoughts', compact('model', 'thoughtList', 'thoughtBubbleList'));
	}
	
	public function actionWhoops(){
		echo 'whoops';
		die();
	}
	
	public function actionReflection(){
		echo 'reflection';
		die();
	}
	
	public function actionSettings(){
		echo 'protagonalSettings';
		die();
	}
	
	//http://localhost/productivore/protagonal/getNextThoughtBubblesAjax/startingThoughtBubbleId/9/listId/1/
	public function actionGetNextThoughtBubblesAjax($startingThoughtBubbleId, $listId){
		$userId = Yii::app()->user->getId();
		$protagonalHelper = new ProtagonalHelper;
		$thoughtBubbleList = $protagonalHelper->get_thoughtbubbles_byUserIdListIdThoughtBubbleId($userId, $listId, $startingThoughtBubbleId);
		$this->debugPrint($thoughtBubbleList);
	}
	
	//http://localhost/productivore/productivore/protagonal/editachievementfieldajax/field/achievement_name/achievementId/7/value/asdfgh
	public function actionEditAchievementFieldAjax($field, $achievementId, $value = null){
		$requiredFields = array('achievement_condition', 'achievement_rewards');
	
		if(in_array($field, $requiredFields)){
			// echo json_encode(array('error'=>'The field '.$value.' must not be left blank.'));
			// exit;
			if($value == null || $value == ''){
				echo json_encode(array('error'=>'The field '.$field.' must not be left blank.'));
				exit;
			}
		}
			
		if($field != null && $achievementId != null){
			$achievements = Achievements::model()->findByPk($achievementId);
			$achievements->$field = $value;
			$achievements->save();
		}
		
		echo json_encode(array('success'=>'The field '.$field.' has successfully been updated.'));
		
	}
	
	//http://localhost/productivore/productivore/protagonal/deleteachievementajax/achievementId/8
	public function actionDeleteAchievementAjax($achievementId){
		if($achievementId != null){
			$achievements = Achievements::model()->deleteByPk($achievementId);
		}
	}
	
	//http://localhost/productivore/productivore/protagonal/markascompleteajax/achievementId/9
	public function actionMarkAsCompleteAjax($achievementId){
		if($achievementId != null){
			$achievements = Achievements::model()->findByPk($achievementId);
			$achievements->is_completed = 1;
			$achievements->save();
		}
	}
	
	//http://localhost/productivore/productivore/protagonal/updateachievementsettings/valueId/7
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