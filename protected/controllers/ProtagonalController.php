<?php

/**
 * ProtagonalController is a controller class for Productivore's Protagonal appling.
 *
 * ProtagonalController is a class which contains the Achievements, Whoops and
 * Thought Bubble sub-applings.
 *
 * @author 	Kiefer Yap <kiefer.yap@gmail.com> 
 *
 */

class ProtagonalController extends Controller
{	
	/**
	* The constructor, which sets the applingId of the controller.
	* In this case, 4.
	*/
	public function __construct() {
		$this->applingId = 4;
		parent::__construct();
	}
	
	/**
	 * The default 'index' action that is invoked
	 * when an action is not explicitly requested.
	 */	
	public function actionIndex() {
		$this->setupPage('Protagonal - Productivore', array(
			'Protagonal' => BASE_URL.'/protagonal'
		));
		$this->render('index');
	}
	
	/**
	 * The Achievements action.
	 *
	 * This method allows users to view/add/delete their achievments.
	 * @param string the tab to load: index or complete
	 */
	public function actionAchievements($mode = 'index') {
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
				$model->achievement_rewards = 100;
			}
		}
		
		$protagonalHelper = new ProtagonalHelper;
		$achievements = $protagonalHelper->get_achievements_byUserIdMode(Yii::app()->user->getId(), $mode);	
		
		$this->render('achievements', compact('mode', 'model', 'achievements'));
	}
	
	/**
	 * The Thoughts action.
	 *
	 * This method allows users to view/add/delete their thought bubbles.
	 */
	public function actionThoughts() {
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
	
	/**
	 * The Whoops action.
	 *
	 * This method allows users to view/add/delete their, erm, regrets.
	 */
	public function actionWhoops() {
		echo 'whoops';
		die();
	}
	
	/**
	 * The Settings action.
	 *
	 * This method allows users to change settings like date of birth.
	 */
	public function actionSettings() {
		echo 'protagonalSettings';
		die();
	}
	
	/**
	 * The get next thought bubbles action.
	 *
	 * This method is invoked via AJAX when the
	 * user wants to see their next thought bubbles
	 * upon scrolling down to the end.
	 * The parameters are passed using POST.
	 * To access this function,
	 * /productivore/productivore/protagonal/getNextThoughtBubblesAjax
	 *
	 * @param integer the starting thought bubble id to be loaded
	 * @param integer the id of the list to be loaded
	 *
	 */
	public function actionGetNextThoughtBubblesAjax() {
		$startingThoughtBubbleId = $_POST['startingThoughtBubbleId'];
		$isScroll = $_POST['isScroll'];
		$listId = $_POST['listid'];

		$userId = Yii::app()->user->getId();
		$protagonalHelper = new ProtagonalHelper;
		$thoughtBubbleList = $protagonalHelper->get_thoughtbubbles_byUserIdListIdThoughtBubbleId($userId, $listId, $startingThoughtBubbleId);
		
		if(!$isScroll)
			$protagonalHelper->setActiveThoughtList($userId, $listId);

		echo json_encode($thoughtBubbleList);
	}
	
	/**
	 * The edit achievement field action.
	 *
	 * This method is invoked via AJAX when the
	 * user wants to edit a field in their achievements.
	 * The parameters are passed using POST.
	 * To access this function,
	 * /productivore/productivore/protagonal/editachievementfieldajax
	 *
	 * @param string the field to be updated: achievement_name,
	 * achievement_condition, achivement_rewards, completion_notes
	 * @param integer the id of the achievement to be edited
	 * @param the new value of the field to be updated
	 *
	 */
	public function actionEditAchievementFieldAjax() {
		$requiredFields = array('achievement_condition', 'achievement_rewards');

		$achievementId = $_POST['id'];
		$field = $_POST['field'];
		$value = $_POST['value'];
	
		if(in_array($field, $requiredFields)){
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
		
		echo json_encode(array('success'=>'Update successful.'));	
	}
	
	/**
	 * The delete achievement action.
	 *
	 * This method is invoked via AJAX when the
	 * user wants to delete an achievement.
	 * The parameters are passed using POST.
	 * To access this function,
	 * /productivore/productivore/protagonal/deleteachievementajax
	 *
	 * @param integer the id of the achievement to be deleted
	 *
	 */
	public function actionDeleteAchievementAjax() {
		$achievementId = $_POST['achievementId'];
		if($achievementId != null){
			$achievements = Achievements::model()->deleteByPk($achievementId);
		}
	}
	
	/**
	 * The mark achievement as complete action.
	 *
	 * This method is invoked via AJAX when the
	 * user wants to mark an achievement as complete
	 * The parameters are passed using POST.
	 * To access this function,
	 * /productivore/productivore/protagonal/markascompleteajax
	 *
	 * @param integer the id of the achievement to be marked.
	 *
	 */
	public function actionMarkAsCompleteAjax(){
		$achievementId = $_POST['achievementId'];
		if($achievementId != null){
			$achievements = Achievements::model()->findByPk($achievementId);
			$achievements->is_completed = 1;
			$achievements->save();
		}
	}
	
}