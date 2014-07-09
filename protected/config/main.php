<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'g11',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=> array('2.236.95.12','91.252.164.214','127.0.0.1','::1'), //array('127.0.0.1','::1'),
		),
	),
	
	'sourceLanguage'=>'en_us',
	'language'=>'en',
	
	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'gii'=>'gii',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		'clientScript'=>array(
            'packages'=>array(
                'jquery'=>array(
                    'baseUrl'=>'js/jquery',
                    'js'=>array('jquery-1.8.3.min.js'),
                ),
                'foundation'=>array(
                	'baseUrl'=>'js/foundation',
                    'js'=>array('foundation.js','foundation.section.js','foundation.clearing.js','foundation.reveal.js','foundation.abide.js','foundation.tooltips.js'),
				)
            ),
        ),
		
		// uncomment the following to use a SQLite database
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		'db'=>array(
			'connectionString' => 'mysql:host=jam-vm-dev-1.cloudapp.net:3306;dbname=jamdb',
			'emulatePrepare' => true,
			'username' => 'jamyourself',
			'password' => 'J4my0urs3lf',
			'charset' => 'utf8',
		),
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
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);