<?php

class SiteController extends Controller
{

	public function actionIndex()
	{
		// echo 'here'; die();
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

}