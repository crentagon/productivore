<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Productivore',
	//TODO: set this later
	//'defaultController'=>'site',
	
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.models.forms.*',
		'application.models.helpers.*',
		'application.models.tables.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		 'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'awesomenite123',
            'generatorPaths'=>array(
                'bootstrap.gii',
            ),
        ),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			 // 'rules'=>array(
                // '<controller:\w+>'=>'<controller>/list',
                // '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                // '<controller:\w+>/<id:\d+>/<title>'=>'<controller>/view',
                // '<controller:\w+>/<id:\d+>'=>'<controller>/view',
            // ),
		),
		
		// 'db'=>array(
			// 'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		// ),
		// uncomment the following to use a MySQL database
		
		//MySQL
		// 'db'=>array(
			// 'connectionString' => 'mysql:host=localhost;dbname=productivore_db',
			// 'emulatePrepare' => true,
			// 'username' => 'crentaroot',
			// 'password' => 'awesomenite123',
			// 'charset' => 'utf8',
		// ),
		
		//PostgreSQL
		'db'=>array(
			'connectionString' => 'pgsql:host=localhost;port=5435;dbname=productivore_db',
			'emulatePrepare' => true,
			'username' => 'postgres',
			'password' => '12345',
			'charset' => 'utf8',
		),
		
		//PostgreSQL -- Live
		// 'db'=>array(
			// 'connectionString' => 'pgsql:host=ec2-54-204-45-126.compute-1.amazonaws.com;port=5432;dbname=dejnsecqciku21',
			// 'emulatePrepare' => true,
			// 'username' => 'jrfcncjrpgwsog',
			// 'password' => 'bmlI25f9-TyRWce9TdZoEmnjGk',
			// 'charset' => 'utf8',
		// ),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
		'bootstrap' => array(
			'class'=>'bootstrap.components.Bootstrap'
		)
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
	
	
	// bootstrap
	'theme'=>'bootstrap', // requires you to copy the theme under your themes directory
    // 'modules'=>array(
        // 'gii'=>array(
            // 'generatorPaths'=>array(
                // 'bootstrap.gii',
            // ),
        // ),
    // ),
    // 'components'=>array(
        // 'bootstrap'=>array(
            // 'class'=>'bootstrap.components.Bootstrap',
        // ),
    // ),
	
);