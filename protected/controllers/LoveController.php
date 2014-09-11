<?php

class LoveController extends Controller {

    public function actionCreate($id_object = null, $classname = null) {
	$id_object = $_GET['id_object'];
	$classname = $_GET['classname'];
	$id_user = User::model()->findByPk(Yii::app()->session['id']);
	if ($id_user === null)
	    throw new CHttpException(404, 'The requested page does not exist.');
	$alreadyLove = LoveAction::model()->loveCheck($id_user, $classname, $id_object);
	if ($alreadyLove) {
	    throw new CHttpException(404, 'You have already loved this element.');
	} else {
	    //questo codice commentato servirà per invio notifica a utente che ha love
	    /*
	      $object = $classname::model()->findByPk($id_object);
	      $touser = User::model()->findByPk($object->fromuser);
	      if ($touser === null)
	      throw new CHttpException(404, 'The requested page does not exist.');
	     */
	    $loveAction = new LoveAction;
	    if (isset($_POST['LoveAction'])) {
		$_POST['LoveAction']['id_user'] = $id_user->id;
		$_POST['LoveAction']['classname'] = $classname;
		$_POST['LoveAction']['id_object'] = $id_object;
		//per eventuale futura localizzazione dei love
		//$_POST['LoveAction']['latitude'] = null;
		//$_POST['LoveAction']['longitude'] = null;
		$_POST['LoveAction']['createdat'] = date('Y-m-d H:i:s');
		$loveAction->attributes = $_POST['LoveAction'];
		if ($loveAction->save()) {
		    $incrementCounter = $classname::model()->incrementCounter($id_object, 'lovecounter');
		    if(!$incrementCounter){
			Yii::log("errors incrementing loveCounter: ", CLogger::LEVEL_WARNING, __METHOD__);
		    }
		}
		else
		    Yii::log("errors save love action: " . var_export($loveAction->getErrors(), true), CLogger::LEVEL_WARNING, __METHOD__);
	    }
	}
    }

    public function actionDelete($id = null) {
	$id_object = $_GET['id_object'];
	$classname = $_GET['classname'];
	$id_user = User::model()->findByPk(Yii::app()->session['id']);
	if ($id_user === null)
	    throw new CHttpException(404, 'The requested page does not exist.');
	$alreadyLove = LoveAction::model()->loveCheck($id_user, $classname, $id_object);
	if (!$alreadyLove) {
	    throw new CHttpException(404, 'There is no loveAction for this element.');
	} else {
	    $counterDecrement = $classname::model()->decrementCounter($id_object, 'lovecounter');
	    if ($counterDecrement) {
		$this->loadModel($id)->delete();
	    } else {
		Yii::log("errors decrementing loveCounter: ", CLogger::LEVEL_WARNING, __METHOD__);
	    }
	}
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return LoveAction the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
	$model = LoveAction::model()->findByPk($id);
	if ($model === null)
	    throw new CHttpException(404, 'The requested page does not exist.');
	return $model;
    }

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
		'actions' => array('create', 'delete'),
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

    public function actions() {
// return external action classes, e.g.:
	return array(
	    'action1' => 'path.to.ActionClass',
	    'action2' => array(
		'class' => 'path.to.AnotherActionClass',
		'propertyName' => 'propertyValue',
	    ),
	);
    }

}