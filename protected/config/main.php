<?php

//require of the DB connection service
//require_once( dirname(__FILE__) . '/../components/helpers.php');
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Jamyourself',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
	'application.models.*',
	'application.components.*',
    ),
    'modules' => array(
	'gii' => array(
	    'class' => 'system.gii.GiiModule',
	    'password' => 'g11',
	    // If removed, Gii defaults to localhost only. Edit carefully to taste.
	    'ipFilters' => array('2.236.95.12', '91.252.164.214', '127.0.0.1', '::1'), //array('127.0.0.1','::1'),
	),
    ),
    'sourceLanguage' => 'en_us',
    'language' => 'en',
    // application components
    'components' => array(
	'user' => array(
	    // enable cookie-based authentication
	    'allowAutoLogin' => true,
	),
	// uncomment the following to enable URLs in path-format
	/*
	  'urlManager'=>array(
	  'urlFormat'=>'path',
	  'showScriptName'=>true,

	  'rules'=>array(
	  'gii'=>'gii',
	  '<controller:\w+>/<id:\d+>'=>'<controller>/view',
	  '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
	  '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
	  ),


	  ),
	 */
	'clientScript' => array(
	    'packages' => array(
		'jquery' => array(
		    'baseUrl' => 'js/jquery',
		    'js' => array('jquery-1.8.3.min.js'),
		),
		'foundation' => array(
		    'baseUrl' => 'js/foundation',
		    'js' => array('foundation.js', 'foundation.section.js', 'foundation.clearing.js', 'foundation.reveal.js', 'foundation.abide.js', 'foundation.tooltips.js'),
		),
		'custom' => array(
		    'baseUrl' => 'js/custom',
		    'js' => array('layout.js', 'utils.js', 'player.js', 'header.js','relation.js'),
		),
		'stylesheets' => array(
		    'baseUrl' => 'css',
		    'css' => array('headerstyle.js', 'plugins/jplayer/jplayer.pink.flag.css', 'headerstyle.css', 'footerstyle.css'),
		)
	    ),
	),
	// uncomment the following to use a SQLite database
	/*
	  'db'=>array(
	  'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	  ),
	 */
	'db' => array(
	    'connectionString' => 'mysql:host=jam-vm-dev-1.cloudapp.net:3306;dbname=jamdb',
	    'emulatePrepare' => true,
	    'username' => 'jamyourself',
	    'password' => 'J4my0urs3lf',
	    'charset' => 'utf8',
	),
	'errorHandler' => array(
	    // use 'site/error' action to display errors
	    'errorAction' => 'site/error',
	),
	'log' => array(
	    'class' => 'CLogRouter',
	    'routes' => array(
		array(
		    'class' => 'CFileLogRoute',
		    'levels' => 'error, warning',
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
    'params' => array(
	// this is used in contact page
	'adminEmail' => 'webmaster@example.com',
	//default images definition
	'defaultImages' => array(
	    'DEFBGD' => Yii::app()->request->baseUrl . '/images/default/defaultBackground.jpg',
	    'DEFAVATARJAMMER' => Yii::app()->request->baseUrl . '/images/default/defaultAvatarJammer.jpg',
	    'DEFTHUMBJAMMER' => Yii::app()->request->baseUrl . '/images/default/efaultAvatarThumbJammer.jpg',
	    'DEFAVATARVENUE' => Yii::app()->request->baseUrl . '/images/default/defaultAvatarVenue.jpg',
	    'DEFTHUMBVENUE' => Yii::app()->request->baseUrl . '/images/default/defaultAvatarThumbVenue.jpg',
	    'DEFAVATARSPOTTER' => Yii::app()->request->baseUrl . '/images/default/defaultAvatarSpotter.jpg',
	    'DEFTHUMBSPOTTER' => Yii::app()->request->baseUrl . '/images/default/defaultAvatarThumbSpotter.jpg',
	    'DEFALBUMCOVER' => Yii::app()->request->baseUrl . '/images/default/defaultAlbumCover.jpg',
	    'DEFALBUMTHUMB' => Yii::app()->request->baseUrl . '/images/default/defaultAlbumThumb.jpg',
	    'DEFEVENTCOVER' => Yii::app()->request->baseUrl . '/images/default/defaultEventImage.jpg',
	    'DEFEVENTTHUMB' => Yii::app()->request->baseUrl . '/images/default/defaultEventThumb.jpg',
	    'DEFRECORDCOVER' => Yii::app()->request->baseUrl . '/images/default/defaultRecordCover.jpg',
	    'DEFRECORDTHUMB' => Yii::app()->request->baseUrl . '/images/default/defaultRecordThumb.jpg',
	    'DEFSONGTHUMB' => Yii::app()->request->baseUrl . '/images/default/defaultSongThumb.jpg',
	    'DEFIMAGE' => Yii::app()->request->baseUrl . '/images/default/defaultImage.jpg',
	    'DEFIMAGETHUMB' => Yii::app()->request->baseUrl . '/images/default/defaultImageThumb.jpg',
	    'DEFVIDEOTHUMB' => Yii::app()->request->baseUrl . '/images/default/defaultVideoThumb.jpg',
	),
	'badges' => array(
	    'BADGE0' => Yii::app()->request->baseUrl . '/images/badge/badgeDefault.png',
	    'BADGE1' => Yii::app()->request->baseUrl . '/images/badge/badgeOldSchool.png',
	    'BADGE2' => Yii::app()->request->baseUrl . '/images/badge/badgeWelcome.png',
	    'BADGE3' => Yii::app()->request->baseUrl . '/images/badge/badgePub.png',
	    'BADGE4' => Yii::app()->request->baseUrl . '/images/badge/badgeNightLife.png',
	    'BADGE5' => Yii::app()->request->baseUrl . '/images/badge/badgeLive.png',
	    'BADGE6' => Yii::app()->request->baseUrl . '/images/badge/badgeRock.png',
	    'BADGE7' => Yii::app()->request->baseUrl . '/images/badge/badgeJamSession.png',
	    'BADGE8' => Yii::app()->request->baseUrl . '/images/badge/badgeJammedIn.png',
	    'BADGE9' => Yii::app()->request->baseUrl . '/images/badge/badgeHappyHour.png',
	    'BADGE10' => Yii::app()->request->baseUrl . '/images/badge/badgeProducer.png',
	    'BADGE11' => Yii::app()->request->baseUrl . '/images/badge/badgeDj.png',
	    'BADGE12' => Yii::app()->request->baseUrl . '/images/badge/badgeDinner.png',
	    'BADGE13' => Yii::app()->request->baseUrl . '/images/badge/badgeContest.png',
	    'BADGE14' => Yii::app()->request->baseUrl . '/images/badge/badgeDance.png',
	    'BADGE15' => Yii::app()->request->baseUrl . '/images/badge/badgeElectro.png',
	    'BADGE16' => Yii::app()->request->baseUrl . '/images/badge/badgePop.png',
	    'BADGE17' => Yii::app()->request->baseUrl . '/images/badge/badgeMetal.png',
	    'BADGE18' => Yii::app()->request->baseUrl . '/images/badge/badgeJazz.png',
	    'BADGE19' => Yii::app()->request->baseUrl . '/images/badge/badgeInDemand.png',
	    'BADGE20' => Yii::app()->request->baseUrl . '/images/badge/badgeTeamUp.png',
	    'BADGE21' => Yii::app()->request->baseUrl . '/images/badge/badgePhotographer.png',
	    'BADGE22' => Yii::app()->request->baseUrl . '/images/badge/badgePr.png',
	    'BADGE23' => Yii::app()->request->baseUrl . '/images/badge/badgeJournalist.png',
	),
	// param for upload images
	'extensionsAccepted' => array('jpg', 'jpeg', 'png', 'gif'),
	'maxSize' => 2 * 1024 * 1024,
	// path upload images
	'users_dir' => array(
	    'users' => 'users',
	    'temp' => 'users/temp', //cartella con file temporanei			
	    'thumbnail' => 'images/thumbnail', //profile thumbnail 
	    'avatar' => 'images/avatar', //profile
	    'albumcover' => 'images/albumcover',
	    'albumcoverthumb' => 'images/albumcoverthumb',
	    'photos' => 'images/photos',
	    'recordcover' => 'images/recordcover',
	    'recordcoverthumb' => 'images/recordcoverthumb',
	    'eventcoverthumb' => 'images/eventcoverthumb',
	    'eventcover' => 'images/eventcover',
	    'songs' => 'songs',
	),
    ),
);