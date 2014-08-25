<?php

class AlbumController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
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
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','createAlbum','update','updateAlbum'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id = null)
	{
		$id = $_GET['id'];
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = Album::model()->profileOrUpload(Yii::app()->session['id']);
		
		$this->render('list',array(
			'model'=>$model,
		));
	}

	
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreateAlbum()
	{
		$model=new Album;
		
		$fromuser = User::model()->findByPk(Yii::app()->session['id']);
		
		if($fromuser===null)
			throw new CHttpException(404,'The requested page does not exist.');
		
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Album']))
		{
			$_POST['Album']['fromuser'] = $fromuser->id;
			$_POST['Album']['createdat'] = date('Y-m-d H:i:s');
			$_POST['Album']['updatedat'] = date('Y-m-d H:i:s');
			
			$model->attributes=$_POST['Album'];
			if($model->save())
				$this->redirect(array('image/create','id'=>$model->id));
			else throw new CHttpException(405,'Errors saving album');
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdateAlbum($id = null)
	{
		$id = $_GET['id'];
		$model=$this->loadModel($id);
		
		$fromuser = User::model()->findByPk(Yii::app()->session['id']);
		
		if($model->fromuser != Yii::app()->session['id'])
			throw new CHttpException(403,'You are not authorized to perform this action');

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Album']))
		{
			$_POST['Album']['updatedat'] = date('Y-m-d H:i:s');
			
			$model->attributes=$_POST['Album'];			
			if($model->save())
				$this->redirect(array('image/create','id'=>$model->id));
			else throw new CHttpException(405,'Errors update album');
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id = null)
	{
		$id = $_GET['id'];
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Album');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Album('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Album']))
			$model->attributes=$_GET['Album'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Album the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Album::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Album $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='album-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function beforeAction($action) {
	    if( parent::beforeAction($action) ) {
	        /* @var $cs CClientScript */
	        $cs = Yii::app()->clientScript;
	        
	       	$baseUrl = Yii::app()->baseUrl; 
	        	        
	        $cs->registerCssFile($baseUrl.'/css/formBlackStyle.css');
			 $cs->registerCssFile($baseUrl.'/css/touchCarousel/touchcarousel.css');
			$cs->registerCssFile($baseUrl.'/css/uploadAlbumStyle.css');			
	        $cs->registerScriptFile($baseUrl.'/js/plugins/geocomplete/jquery.geocomplete.js');
			$cs->registerScriptFile($baseUrl.'/js/plugins/touchCarousel/jquery.touchcarousel-1.1.min.js');			
			$cs->registerScriptFile($baseUrl.'/js/custom/utils.js');
	        return true;
	    }
	    return false;
	}	
}
