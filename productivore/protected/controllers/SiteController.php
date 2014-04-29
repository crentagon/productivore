<?php

class SiteController extends Controller
{
	public function __construct(){
		$this->applingId = 0;
		parent::__construct();
	}

	public function actionIndex()
	{
		$this->render('index');
	}	
	
	//Accessing: http://localhost/productivore/productivore/site/update_sidebarfields
	public function actionUpdate_sidebarFields($fieldid = 1, $valueid = 1){
		// echo $fieldid.'>>>'.$valueid; die();
		$update = array($fieldid=>$valueid); //setting_field_id, field_value_map_id
		$userId = 1;
		$applingId = 0;
		
		$userApplings = new SidebarHelper;
		$userApplings->update_settingValues_byUserId($userId, $applingId, $update);
		die();
	}
	
	public function actionLogin(){
		// Yii::app()->user->setFlash('success','much success');
		// Yii::app()->user->setFlash('success','so much success');
		// Yii::app()->user->setFlash('warning','such warning<br/>must kiotsukete');
		// Yii::app()->user->setFlash('error','very error<br/>ohnoesdame<br/>nununununu');
		// Yii::app()->user->setFlash('error','another error');
		// Yii::app()->user->setFlash('info','info<br/>larningisfun<br/>learn<br/>fyeah');
	
		$this->breadcrumbs = array(
			'Login' => BASE_URL.'/site/login'
		);
	
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
				Yii::app()->user->setFlash('success','You have successfully logged in. <br/> Welcome back, '.Yii::app()->user->id.'!');
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}
		// display the login form
		$this->render('login', array('model'=>$model));
	}
	
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionItema(){ echo 'Entered Item A'; die(); }
	public function actionItemb(){ echo 'Entered Item B'; die(); }
	public function actionItemc(){ echo 'Entered Item C'; die(); }
	public function actionItemd(){ echo 'Entered Item D'; die(); }
	public function actionIteme(){ echo 'Entered Item E'; die(); }
	public function actionItemw(){ echo 'Entered Item W'; die(); }
	public function actionItemx(){ echo 'Entered Item X'; die(); }
	public function actionItemy(){ echo 'Entered Item Y'; die(); }
	public function actionItemz(){ echo 'Entered Item Z'; die(); }
	
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
}