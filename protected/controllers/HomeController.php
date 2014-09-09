<?php

class HomeController extends Controller {

    public function beforeAction($action) {
	if (parent::beforeAction($action)) {
	    /* @var $cs CClientScript */
	    $cs = Yii::app()->clientScript;
	    $baseUrl = Yii::app()->baseUrl;
	    $cs->registerCssFile('http://fonts.googleapis.com/css?family=Open+Sans:400,700,600');
	    $cs->registerCssFile($baseUrl . '/css/normalize.css');
	    $cs->registerCssFile($baseUrl . '/css/grid.css');
	    $cs->registerCssFile($baseUrl . '/css/home.css');
	    $cs->registerCssFile($baseUrl . '/css/colorbox/colorbox.css');
	    $cs->registerScriptFile('http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js');
	    $cs->registerScriptFile($baseUrl . '/js/jquery/jquery.stellar.min.js');
	    $cs->registerScriptFile($baseUrl . '/js/jquery/waypoints.min.js');
	    $cs->registerScriptFile($baseUrl . '/js/jquery/jquery.easing.1.3.js');
	    $cs->registerScriptFile($baseUrl . '/js/custom/home.js');
	    $cs->registerScriptFile($baseUrl . '/js/custom/access.js');
	    return true;
	}
	return false;
    }

}
