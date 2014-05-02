<?php

class SiteController extends Controller
{
	public function __construct(){
		$this->applingId = 0;
		parent::__construct();
	}

	public function actionIndex()
	{
		$this->setupPage('Productivore');
		$this->render('index');
	}	
	
	//Accessing: http://localhost/productivore/productivore/site/update_sidebarfields
	public function actionUpdate_sidebarFields($fieldid = 1, $valueid = 1){
		// echo $fieldid.'>>>'.$valueid; die();
		if(!Yii::app()->user->isGuest){
			$update = array($fieldid=>$valueid); //setting_field_id, field_value_map_id
			$userId = Yii::app()->user->getId(); 
			// $userId = 1; 
			$applingId = 0;
			
			$userApplings = new SidebarHelper;
			$userApplings->update_settingValues_byUserId($userId, $applingId, $update);
			die();
		}
		else{
			throw new CHttpException(404,'The page could not be found.');
			$this->render('index');
		}
	}
	
	public function actionLogin(){
		if(Yii::app()->user->isGuest){
			$this->setupPage('Login - Productivore', array(
				'Login' => BASE_URL.'/site/login'
			));
		
			$model=new LoginForm;

			// if it is ajax validation request
			if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
			{
				echo CActiveForm::validate($model);
				Yii::app()->end();
			}

			// collect user input data
			if(isset($_POST['LoginForm']))
			{
				$model->attributes=$_POST['LoginForm'];
				// validate user input and redirect to the previous page if valid
				if($model->validate() && $model->login()){
					Yii::app()->user->setFlash('success','You have successfully logged in. <br/> Welcome back, '.Yii::app()->user->getName().'!');
					$this->redirect(Yii::app()->user->returnUrl);
				}
			}
			// display the login form
			$this->render('login', array('model'=>$model));
		}
		else{
			Yii::app()->user->setFlash('warning','You are already logged in, '.Yii::app()->user->getName().'.');		
			$this->render('index');
		}
	}
	
	public function actionLogout()
	{
		if(!Yii::app()->user->isGuest){
			$this->setupPage('Productivore');
			Yii::app()->user->logout();
			$this->isLoggingOut = true;
		}
		else{
			Yii::app()->user->setFlash('warning','You are not logged in.');
		}
		$this->render('index');
		// $this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionTest(){
		$this->setupPage('Test Page');
		// echo Yii::app()->user->getId();
		// echo '>>>';
		// echo Yii::app()->user->getName();
		// echo '<pre>'; print_r(Yii::app()->user); echo '</pre>';
		// Yii::app()->user->setFlash('success','much success');
		// Yii::app()->user->setFlash('error','another error');
		Yii::app()->user->setFlash('success','so much success');
		Yii::app()->user->setFlash('warning','such warning<br/>must kiotsukete');
		Yii::app()->user->setFlash('error','very error<br/>ohnoesdame<br/>nununununu');
		Yii::app()->user->setFlash('info','info<br/>larningisfun<br/>learn<br/>fyeah');
		$this->render('index');
	}
	
	public function actionError()
	{
		$this->loadStyles(array('error.css'));
		$this->setupPage('Error - Productivore');
		
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
	
	public function actionSignup(){
		$this->setupPage('Signup - Productivore', array(
			'Signup' => BASE_URL.'/site/signup'
		));
		
		if (!Yii::app()->user->isGuest) {
			Yii::app()->user->setFlash('warning','You are already logged in, '.Yii::app()->user->id.'.');
			$this->redirect(Yii::app()->user->returnUrl);
		}
		
		$model = new SignupForm;

		if(isset($_POST['ajax']) && $_POST['ajax']==='signup-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if(isset($_POST['SignupForm']))
		{
			$model->attributes=$_POST['SignupForm'];
			if($model->validate() && $model->signup()){
				// $this->appendFlashMessage('success', 'Sign up successful.<br/>You may now login with your credentials.');
				Yii::app()->user->setFlash('success','Sign up successful.<br/>You may now login with your credentials.');
				$this->redirect(Yii::app()->user->returnUrl);
			}
			// Yii::app()->user->setFlash('error','Sign up failed.<br/>Please check the input fields and try again.');
		}

		$this->render('signup', array('model'=>$model));
		
		
	}
}