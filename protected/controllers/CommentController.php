<?php

class CommentController extends Controller {

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
     */
    public function actionCreate($id = null, $class = null) {
	$id = $_GET['id'];
	$class = $_GET['class'];

	$object = $class::model()->findByPk($id);

	if ($object === null)
	    throw new CHttpException(404, 'The requested page does not exist.');

	$touser = User::model()->findByPk($object->fromuser);

	if ($touser === null)
	    throw new CHttpException(404, 'The requested page does not exist.');

	$fromuser = User::model()->findByPk(Yii::app()->session['id']);

	if ($fromuser === null)
	    throw new CHttpException(404, 'The requested page does not exist.');

	$comment = new Comment;

	// Uncomment the following line if AJAX validation is needed
	//$this->performAjaxValidation($comment);

	if (isset($_POST['Comment'])) {
	    $_POST['Comment']['fromuser'] = $fromuser->id;
	    $_POST['Comment']['touser'] = $touser->id;
	    $_POST['Comment']['latitude'] = null;
	    $_POST['Comment']['longitude'] = null;
	    $_POST['Comment']['createdat'] = date('Y-m-d H:i:s');
	    $_POST['Comment']['updatedat'] = date('Y-m-d H:i:s');
	    $_POST['Comment'][$class] = $id;

	    $comment->attributes = $_POST['Comment'];
	    if ($comment->save()) {
		$class::model()->incrementCounter($id, 'commentcounter');
		$this->redirect(array('view', 'id' => $comment->id));
	    }
	    else
		Yii::log("errors save comment: " . var_export($comment->getErrors(), true), CLogger::LEVEL_WARNING, __METHOD__);
	}
	$this->render('create', array(
	    'model' => $comment,
	));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id = null) {
	$id = $_GET['id'];

	$comment = $this->loadModel($id);

	// Uncomment the following line if AJAX validation is needed
	//$this->performAjaxValidation($model);

	$fromuser = User::model()->findByPk(Yii::app()->session['id']);

	if ($fromuser === null)
	    throw new CHttpException(404, 'The requested page does not exist.');

	if ($fromuser->id != $comment->fromuser)
	    throw new CHttpException(403, 'You are not authorized to perform this action');

	if (isset($_POST['Comment'])) {
	    $_POST['Comment']['updatedat'] = date('Y-m-d H:i:s');

	    $comment->attributes = $_POST['Comment'];
	    if ($comment->save())
		$this->redirect(array('view', 'id' => $comment->id));
	    else
		Yii::log("errors update comment: " . var_export($comment->getErrors(), true), CLogger::LEVEL_WARNING, __METHOD__);
	}
	$this->render('update', array(
	    'model' => $comment,
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
	$dataProvider = new CActiveDataProvider('Comment');
	$this->render('index', array(
	    'dataProvider' => $dataProvider,
	));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
	$model = new Comment('search');
	$model->unsetAttributes();  // clear any default values
	if (isset($_GET['Comment']))
	    $model->attributes = $_GET['Comment'];

	$this->render('admin', array(
	    'model' => $model,
	));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Comment the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
	$model = Comment::model()->findByPk($id);
	if ($model === null)
	    throw new CHttpException(404, 'The requested page does not exist.');
	return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Comment $model the model to be validated
     */
    protected function performAjaxValidation($model) {
	if (isset($_POST['ajax']) && $_POST['ajax'] === 'comment-form') {
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

	    $cs->registerCssFile($baseUrl . '/css/profileStyle.css');


	    return true;
	}
	return false;
    }

}
