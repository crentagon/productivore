<?php

// echo 'here'; die();

//Change the following paths if necessary.
$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

//Debug mode.
defined('YII_DEBUG') or define('YII_DEBUG',true);
// error_reporting(E_ALL);

//specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

//Date settings
date_default_timezone_set("Asia/Tokyo");
require_once($yii);

//Yii stuff
$yii_app = Yii::createWebApplication($config);

//Define constants here.
require_once('constants.php');
// define('BASE_URL', Yii::app()->request->baseUrl); 

$yii_app->run();
