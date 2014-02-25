<?php

//change the following paths if necessary
$yii=dirname(__FILE__).'/../Yii-1_1_14/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// error_reporting(E_ALL);

//specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

//Date settings
date_default_timezone_set("Asia/Tokyo");
require_once($yii);

//Constants
// define('MY_CONST', 'POP');
// echo $yii; die();
var_dump(Yii::app()->request); die();
// print_r(Yii::app()->request->baseUrl); die();
define('MY_CONST', Yii::app()->request);

Yii::createWebApplication($config)->run();
