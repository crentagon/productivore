<?php

/**
 * SiteController is a controller class for Productivore's backbone pages.
 *
 * SiteController is a class which allows the users to access the index,
 * login, signup, and logout pages. Once the user has logged in, they can
 * access the applings and settings pages. The applings page show the user the 
 * applings that they can access, while the settings page allows the user
 * to change their login information such as username and password.
 *
 * @author 	Kiefer Yap <kiefer.yap@gmail.com> 
 *
 */

class SiteController extends Controller
{

	/**
	* The constructor, which loads the CSS and the JavaScript.
	* It also sets the applingId of the controller.
	* In this case, 0.
	*/
	public function __construct() {
		$this->loadStyles('home.css');
		$this->loadScripts('home.js');
		$this->applingId = 0;
		parent::__construct();
	}

	/**
	 * The default 'index' action that is invoked
	 * when an action is not explicitly requested.
	 */	
	public function actionIndex() {
		if(Yii::app()->user->isGuest){
			$this->setupPage('Preview - Productivore');	
			$this->render('preview');
		}
		else{
			$helper = new HomeHelper;
			$allApplings = $helper->get_applings_byUserId(Yii::app()->user->getId());
			$this->setupPage('Productivore');
			$this->render('index', compact('allApplings'));
		}
	}	
	
	/**
	 * The update sidebar action.
	 *
	 * This method is invoked via AJAX when the
	 * user updates a sidebar field. The parameters
	 * are passed using POST. To access this function,
	 * /productivore/site/update_sidebarfieldsajax
	 *
	 * @param integer the fields View, Sorting 
	 * @param integer the value of the fields List/Grid View, By Favorites/Alphabetical
	 *
	 */
	public function actionUpdate_sidebarFieldsAjax() {
		if(!Yii::app()->user->isGuest){
			$fieldid = $_POST['fieldid']; //setting_field_id
			$valueid = $_POST['valueid']; //field_value_map_id

			if($fieldid == null || $valueid == null){
				Yii::app()->user->setFlash('error','Something\'s definitely not right here.');		
				$this->render('preview');
			}
			$userId = Yii::app()->user->getId(); 
			$applingId = 0;
			
			$userApplings = new SidebarHelper;
			$userApplings->update_settingValues_byUserId($userId, $applingId, $fieldid, $valueid);
			Yii::app()->end();
		}
		else{
			throw new CHttpException(404,'The page could not be found.');
			$this->render('index');
		}
	}
	
	/**
	 * The update favorites action.
	 *
	 * This method is invoked via AJAX when the
	 * user marks (or unmarks) an appling as a favorite.
	 * The parameters are passed using POST.
	 * To access this function,
	 * /productivore/site/update_favoritesajax
	 *
	 * @param integer the id of the appling to mark/unmark as a favorite
	 * @param boolean true if the user wants to mark as favorite,
	 * false if otherwise
	 *
	 */
	public function actionUpdate_favoritesAjax() {
		if(!Yii::app()->user->isGuest){
			$applingId = $_POST['applingid'];
			$isfavorite = $_POST['isfavorite'];

			if($applingId == null || $isfavorite == null){
				Yii::app()->user->setFlash('error','Something\'s definitely not right here. You\'re not trying to hack the system, are you?');		
				$this->render('preview');
			}
			// $update = array($applingId=>$isfavorite); //setting_field_id, field_value_map_id
			$userId = Yii::app()->user->getId(); 
			
			$userFavorites = new HomeHelper;
			$userFavorites->update_favoriteApplings_byUserId($userId, $applingId, $isfavorite);
			Yii::app()->end();
		}
		else{
			throw new CHttpException(404,'The page could not be found.');
			$this->render('index');
		}
	}
	
	/**
	 * The login action.
	 *
	 * This method allows users to login.
	 */
	public function actionLogin() {

		// In order to login, the user must not have logged in already
		if(Yii::app()->user->isGuest){

			// Setting the page up for the breadcrumbs
			$this->setupPage('Login - Productivore', array(
				'Login' => BASE_URL.'/site/login'
			));
		
			// Set up the model for the form
			$model=new LoginForm;

			// Check if it is ajax validation request
			if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
			{
				echo CActiveForm::validate($model);
				Yii::app()->end();
			}

			// Check user input data
			if(isset($_POST['LoginForm']))
			{
				$model->attributes=$_POST['LoginForm'];
				// validate user input and redirect to the previous page if valid
				if($model->validate() && $model->login()){
					Yii::app()->user->setFlash('success','You have successfully logged in. <br/> Welcome back, '.Yii::app()->user->getName().'!');
					$this->redirect(Yii::app()->user->returnUrl);
				}
			}

			// Display the login form
			$this->render('login', array('model'=>$model));
		}
		
		// If the user is already logged in
		else{
			Yii::app()->user->setFlash('warning','You are already logged in, '.Yii::app()->user->getName().'.');	
			$helper = new HomeHelper;			
			$allApplings = $helper->get_applings_byUserId(Yii::app()->user->getId());
			$this->render('index', compact('allApplings'));
		}
	}
	
	/**
	 * The logout action.
	 *
	 * This method allows users to logout.
	 */
	public function actionLogout() {

		// Is the user logged in?
		if(!Yii::app()->user->isGuest){
			$this->setupPage('Productivore');
			Yii::app()->user->logout();
			$this->isLoggingOut = true;
		}

		else{
			Yii::app()->user->setFlash('warning','You are not logged in.');
		}

		$this->actionIndex();
	}

	/**
	 * The signup action.
	 *
	 * Allows users to signup.
	 */
	public function actionSignup() {

		// Breadcrumbs
		$this->setupPage('Signup - Productivore', array(
			'Signup' => BASE_URL.'/site/signup'
		));

		// Is the user already logged in?
		if (!Yii::app()->user->isGuest) {
			Yii::app()->user->setFlash('warning','You are already logged in, '.Yii::app()->user->getName().'.');
			$this->redirect(Yii::app()->user->returnUrl);
		}
		
		// Set up the sign up form
		$model = new SignupForm;

		// Validate user input
		if(isset($_POST['ajax']) && $_POST['ajax']==='signup-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// Sign up
		if(isset($_POST['SignupForm']))
		{
			$model->attributes=$_POST['SignupForm'];
			if($model->validate() && $model->signup()){
				Yii::app()->user->setFlash('success','Sign up successful.<br/>You may now login with your credentials.');
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}

		$this->render('signup', array('model'=>$model));	
	}
	
	/**
	 * The test action.
	 *
	 * This method is only for testing purposes.
	 */
	public function actionTest() {
		$this->setupPage('Test Page');
		// echo Yii::app()->user->getId();
		// echo '>>>';
		// echo Yii::app()->user->getName();
		// echo '<pre>'; print_r(Yii::app()->user); echo '</pre>';
		// Yii::app()->user->setFlash('success','much success');
		// Yii::app()->user->setFlash('error','another error');
		
		// $kiefer = array();
				
		//Dreams and aspirations, languages you can speak, hobbies and interests
		
		// $kiefer['ThingsKieferEnjoys']['activity'] = 'Coding for fun';
		// $kiefer['ThingsKieferEnjoys']['creativity'] = 'Drawing and doodling around';
		// $kiefer['ThingsKieferEnjoys']['social'] = 'Hanging out with friends';
		// $kiefer['ThingsKieferEnjoys']['recreational'] = 'Games (board games, video games, etc.)';
		// $kiefer['ThingsKieferEnjoys']['physical'] = 'A good jog';
		// $kiefer['ThingsKieferEnjoys']['dreams'] = 'Exploring and travelling around the world';
		
		// $kiefer['Personality']['much'] = 'introvert';
		// $kiefer['Personality']['such'] = 'calm';
		// $kiefer['Personality']['very'] = 'chill';
		// $kiefer['Personality']['wow'] = 'WOW';
		
		// $kiefer['ExtraCurriculars']['partTimeJob'] = 'CRS Programmer';
		// $kiefer['ExtraCurriculars']['exchangeStudent'] = 'Tokyo, Japan (April 2011 to Jan 2012)';
		
		// $kiefer['InternetPresence']['tumblr'] = 'http://crentagon.tumblr.com';
		// $kiefer['InternetPresence']['deviantArt'] = 'http://crentagon.deviantart.com';
		// $kiefer['InternetPresence']['askBlog'] = 'http://askawesomenitedragonite.tumblr.com';
		// $kiefer['InternetPresence']['aboutMe'] = 'http://about.me/kiefer.yap';
		
		// $this->debugPrint($kiefer);
		// die();
		
		
		Yii::app()->user->setFlash('success','so much success');
		Yii::app()->user->setFlash('warning','such warning<br/>must kiotsukete');
		Yii::app()->user->setFlash('error','very error<br/>ohnoesdame<br/>nununununu');
		Yii::app()->user->setFlash('info','info<br/>larningisfun<br/>learn<br/>fyeah');
		$this->render('preview');
	}
	
	/**
	 * The error action.
	 *
	 * This is for website error messages.
	 */
	public function actionError() {
		$this->loadStyles('error.css');
		$this->setupPage('Error - Productivore');
		
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
	
	/**
	 * The appling action.
	 *
	 * Lists all the applings of the current user.
	 */
	public function actionApplings() {
		if(Yii::app()->user->isGuest){
			throw new CHttpException(404,'The page could not be found.');
		}
		else{
			$helper = new HomeHelper;
			$allApplings = $helper->get_applings_byUserId(Yii::app()->user->getId(), true);
			$this->setupPage('Productivore');
			$this->render('applings', compact('allApplings'));
		}
	}
	
	/**
	 * The appling action.
	 *
	 * Allows the user to change their login information,
	 * such as username and password.
	 */
	public function actionSettings() {
		$this->setupPage('Settings - Productivore', array(
			'Settings' => BASE_URL.'/site/settings'
		));
		$this->loadStyles('guest.css');
		$this->loadStyles('home.css');
		
		if (Yii::app()->user->isGuest) {
			throw new CHttpException(404,'The page could not be found.');
		}
		
		$model = new SignupxForm;

		if(isset($_POST['ajax']) && $_POST['ajax']==='signup-x-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if(isset($_POST['SignupxForm']))
		{
			$model->attributes=$_POST['SignupxForm'];
			if($model->validate() && $model->update()){
				// $this->appendFlashMessage('success', 'Sign up successful.<br/>You may now login with your credentials.');
				Yii::app()->user->setFlash('success','You have successfully edited your credentials.');
				$this->redirect(Yii::app()->user->returnUrl);
			}
			// Yii::app()->user->setFlash('error','Sign up failed.<br/>Please check the input fields and try again.');
		}
		
		//Get the e-mail and the username of the current user
		$userCredentials = Users::model()->find('user_id =:user_id', array(':user_id'=>Yii::app()->user->getId()));
		$model->username = $userCredentials->user_name;
		$model->currentEmail = $userCredentials->user_email;
		
		// echo '<pre>';
		// print_r($userCredentials);
		// die();

		$this->render('settings', array('model'=>$model));	
	}
}