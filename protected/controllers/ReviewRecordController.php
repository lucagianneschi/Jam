<?php

class ReviewRecordController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
	return array(
	    'accessControl', // perform access control for CRUD operations
	    'postOnly + delete', // we only allow deletion via POST request
	);
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
	return array(
	    array('allow', // allow all users to perform 'index' and 'view' actions
		'actions' => array('index', 'view'),
		'users' => array('*'),
	    ),
	    array('allow', // allow authenticated user to perform 'create' and 'update' actions
		'actions' => array('create', 'update'),
		'users' => array('@'),
		'expression'=>Yii::app()->session['type'].'== SPOTTER',
	    ),
	    array('allow', // allow admin user to perform 'admin' and 'delete' actions
		'actions' => array('admin', 'delete'),
		'users' => array('admin'),
	    ),
	    array('deny', // deny all users
		'users' => array('*'),
	    ),
	);
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id = null) {
    	$id = $_GET['id'];
	$this->render('view', array(
	    'model' => $this->loadModel($id),
	));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param integer $record the ID of the model record
     */
    public function actionCreate($record = null) {
	$record = $_GET['id'];
	$record = Record::model()->findByPk($record);

	if ($record === null)
	    throw new CHttpException(404, 'The requested page does not exist.');

	$recordGenre = RecordGenre::model()->findAll(array("condition" => "id_record =  $record->id", "order" => "id_record"));
	$recordTag = RecordTag::model()->findAll(array("condition" => "id_record =  $record->id", "order" => "id_record"));

	$touser = User::model()->findByPk($record->fromuser);

	if ($touser === null)
	    throw new CHttpException(404, 'The requested page does not exist.');

	$fromuser = User::model()->findByPk(Yii::app()->session['id']);

	if ($fromuser === null)
	    throw new CHttpException(404, 'The requested page does not exist.');

	$reviewRecord = new ReviewRecord;

	// Uncomment the following line if AJAX validation is needed
	$this->performAjaxValidation($reviewRecord);

	if (isset($_POST['ReviewRecord'])) {
	    $_POST['ReviewRecord']['record'] = $record->id;
	    $_POST['ReviewRecord']['fromuser'] = $fromuser->id;
	    $_POST['ReviewRecord']['touser'] = $touser->id;
	    $_POST['ReviewRecord']['latitude'] = null;
	    $_POST['ReviewRecord']['longitude'] = null;
	    $_POST['ReviewRecord']['createdat'] = date('Y-m-d H:m:s');
	    $_POST['ReviewRecord']['updatedat'] = date('Y-m-d H:m:s');
	    $_POST['ReviewRecord']['vote'] = $_POST['vote'];
	    $reviewRecord->attributes = $_POST['ReviewRecord'];

	    if ($reviewRecord->save())
		$this->redirect(array('view', 'id' => $reviewRecord->id));
	}

	$this->render('create', array(
	    'model' => $reviewRecord,
	    'record' => $record,
	    'fromuser' => $fromuser,
	    'touser' => $touser,
	    'recordGenre' => $recordGenre,
	    'recordTag' => $recordTag,
	));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     * @param integer $record the id of the model record
     */
    public function actionUpdate($id = null) {
    	$id = $_GET['id'];

	$model = $this->loadModel($id);

	$record = Record::model()->findByPk($model->record);

	if ($record === null)
	    throw new CHttpException(404, 'The requested page does not exist.');

	$recordGenre = RecordGenre::model()->findAll(array("condition" => "id_record =  $record->id", "order" => "id_record"));
	$recordTag = RecordTag::model()->findAll(array("condition" => "id_record =  $record->id", "order" => "id_record"));

	$touser = User::model()->findByPk($model->touser);

	if ($touser === null)
	    throw new CHttpException(404, 'The requested page does not exist.');

	$fromuser = User::model()->findByPk(Yii::app()->session['id']);

	if ($fromuser === null)
	    throw new CHttpException(404, 'The requested page does not exist.');



	// Uncomment the following line if AJAX validation is needed
	$this->performAjaxValidation($model);

	if (isset($_POST['ReviewRecord'])) {
	    $_POST['ReviewRecord']['record'] = $record->id;
	    $_POST['ReviewRecord']['fromuser'] = $fromuser->id;
	    $_POST['ReviewRecord']['touser'] = $touser->id;
	    $_POST['ReviewRecord']['latitude'] = null;
	    $_POST['ReviewRecord']['longitude'] = null;
	    $_POST['ReviewRecord']['updatedat'] = date('Y-m-d H:i:s');
	    $_POST['ReviewRecord']['vote'] = $_POST['vote'];
	    $model->attributes = $_POST['ReviewRecord'];
	    if ($model->save())
		$this->redirect(array('view', 'id' => $model->id));
	}

	$this->render('update', array(
	    'model' => $model,
	    'record' => $record,
	    'fromuser' => $fromuser,
	    'touser' => $touser,
	    'recordGenre' => $recordGenre,
	    'recordTag' => $recordTag,
	));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id = null) {
    	$id = $_GET['id'];
	$this->loadModel($id)->delete();

	// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
	if (!isset($_GET['ajax']))
	    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
	$dataProvider = new CActiveDataProvider('ReviewRecord');
	$this->render('view', array(
	    'model' => $this->loadModel(1),
	));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
	$model = new ReviewRecord('search');
	$model->unsetAttributes();  // clear any default values
	if (isset($_GET['ReviewRecord']))
	    $model->attributes = $_GET['ReviewRecord'];

	$this->render('admin', array(
	    'model' => $model,
	));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return ReviewRecord the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
	$model = ReviewRecord::model()->findByPk($id);
	if ($model === null)
	    throw new CHttpException(404, 'The requested page does not exist.');
	return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param ReviewRecord $model the model to be validated
     */
    protected function performAjaxValidation($model) {
	if (isset($_POST['ajax']) && $_POST['ajax'] === 'review-event-form') {
	    echo CActiveForm::validate($model);
	    Yii::app()->end();
	}
    }

    /**
     * Before action
     * @param Aciton to be performed before save operation
     */
    public function beforeAction($action) {
	if (parent::beforeAction($action)) {
	    /* @var $cs CClientScript */
	    $cs = Yii::app()->clientScript;

	    $baseUrl = Yii::app()->baseUrl;

	    $cs->registerCssFile($baseUrl . '/css/formWhiteStyle.css');


	    return true;
	}
	return false;
    }

}
