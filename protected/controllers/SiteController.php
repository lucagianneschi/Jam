<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
	return array(
	    // captcha action renders the CAPTCHA image displayed on the contact page
	    'captcha' => array(
		'class' => 'CCaptchaAction',
		'backColor' => 0xFFFFFF,
	    ),
	    // page action renders "static" pages stored under 'protected/views/site/pages'
	    // They can be accessed via: index.php?r=site/page&view=FileName
	    'page' => array(
		'class' => 'CViewAction',
	    ),
	);
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionEvent() {
	$cs = Yii::app()->clientScript;
	$baseUrl = Yii::app()->baseUrl;
	$cs->registerScriptFile($baseUrl . '/js/custom/profile.js');
	$cs->registerScriptFile($baseUrl . '/js/custom/post.js');
	$cs->registerScriptFile($baseUrl . '/js/custom/love.js');
	$cs->registerScriptFile($baseUrl . '/js/custom/opinion.js');
	$this->render('event');
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionRecord() {
	$cs = Yii::app()->clientScript;
	$baseUrl = Yii::app()->baseUrl;
	$cs->registerScriptFile($baseUrl . '/js/custom/profile.js');
	$cs->registerScriptFile($baseUrl . '/js/custom/post.js');
	$cs->registerScriptFile($baseUrl . '/js/custom/love.js');
	$cs->registerScriptFile($baseUrl . '/js/custom/opinion.js');
	$this->render('record');
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
	// renders the view file 'protected/views/site/index.php'
	// using the default layout 'protected/views/layouts/main.php'
	$this->render('index');
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionProfile() {
	$cs = Yii::app()->clientScript;
	$baseUrl = Yii::app()->baseUrl;
	$cs->registerScriptFile($baseUrl . '/js/custom/profile.js');
	$cs->registerScriptFile($baseUrl . '/js/custom/post.js');
	$cs->registerScriptFile($baseUrl . '/js/custom/love.js');
	$cs->registerScriptFile($baseUrl . '/js/custom/opinion.js');
	$this->render('profile');
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionTest() {
	// renders the view file 'protected/views/site/index.php'
	// using the default layout 'protected/views/layouts/main.php'
	$this->render('test');
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionHome() {
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
	$cs->registerScriptFile($baseUrl . '/js/plugins/colorbox/jquery.colorbox.js');
	$this->render('home');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
	if ($error = Yii::app()->errorHandler->error) {
	    if (Yii::app()->request->isAjaxRequest)
		echo $error['message'];
	    else
		$this->render('error', $error);
	}
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
	$model = new ContactForm;
	if (isset($_POST['ContactForm'])) {
	    $model->attributes = $_POST['ContactForm'];
	    if ($model->validate()) {
		$name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
		$subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
		$headers = "From: $name <{$model->email}>\r\n" .
			"Reply-To: {$model->email}\r\n" .
			"MIME-Version: 1.0\r\n" .
			"Content-Type: text/plain; charset=UTF-8";

		mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
		Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
		$this->refresh();
	    }
	}
	$this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
	$model = new LoginForm;

	// if it is ajax validation request
	if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
	    echo CActiveForm::validate($model);
	    Yii::app()->end();
	}

	// collect user input data
	if (isset($_POST['LoginForm'])) {
	    $model->attributes = $_POST['LoginForm'];
	    // validate user input and redirect to the previous page if valid
	    if ($model->validate() && $model->login())
		$this->redirect(Yii::app()->user->returnUrl);
	}
	// display the login form
	$this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
	Yii::app()->user->logout();
	$this->redirect(Yii::app()->homeUrl);
    }

}