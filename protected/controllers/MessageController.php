<?php

class MessageController extends Controller
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
				'actions'=>array('create','update','read'),
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
	public function actionCreate($id = null){
		
		$id = $_GET['id'];
		
		$model=new Message;
		
		$fromuser = User::model()->findByPk(Yii::app()->session['id']);
	
		if ($fromuser === null)
		    throw new CHttpException(404, 'The requested page does not exist.');
		
		$touser = User::model()->findByPk($id);
	
		if ($touser === null)
		    throw new CHttpException(404, 'The requested page does not exist.');
		
		if($fromuser->id == $touser->id)
			throw new CHttpException(404, 'You can not send messages to yourself');
			
		if($fromuser->type != 'SPOTTER' && $touser->type == 'SPOTTER')
			throw new CHttpException(403,'You are not authorized to perform this action');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Message']))
		{
			$_POST['Message']['id_user'] = $fromuser->id;
			$_POST['Message']['fromuser'] = $fromuser->id;
		    $_POST['Message']['touser'] = $touser->id;
			$_POST['Message']['type'] = 'READ';			
		    $_POST['Message']['createdat'] = date('Y-m-d H:i:s');
		    $_POST['Message']['updatedat'] = date('Y-m-d H:i:s');
			
			$model->attributes=$_POST['Message'];
			if($model->save()){
				$model2=new Message;
			
				$_POST['Message']['id_user'] = $touser->id;
				$_POST['Message']['fromuser'] = $fromuser->id;
			    $_POST['Message']['touser'] = $touser->id;
				$_POST['Message']['type'] = 'UNREAD';			
			    $_POST['Message']['createdat'] = date('Y-m-d H:i:s');
			    $_POST['Message']['updatedat'] = date('Y-m-d H:i:s');
				
				$model2->attributes=$_POST['Message'];
				if($model2->save())
					$this->redirect(array('view','id'=>$model->id));
				else{			
					Yii::log("errors saving second message: " . var_export($post->getErrors(), true), CLogger::LEVEL_WARNING, __METHOD__);
				}
				
			}
				
			else{			
				Yii::log("errors saving first message: " . var_export($post->getErrors(), true), CLogger::LEVEL_WARNING, __METHOD__);
			}
			
			
			
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
	public function actionUpdate($id = null){
			
		$id = $_GET['id'];
		
		$model=$this->loadModel($id);		
			
		if($model->fromuser != Yii::app()->session['id'])
			throw new CHttpException(403,'You are not authorized to perform this action');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Message']))
		{
			$_POST['Message']['updatedat'] = date('Y-m-d H:i:s');
			
			$model->attributes=$_POST['Message'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
			else{			
				Yii::log("errors update message: " . var_export($post->getErrors(), true), CLogger::LEVEL_WARNING, __METHOD__);
			}
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
		
		$model=$this->loadModel($id);
		
		if($model->id_user != Yii::app()->session['id'])
			throw new CHttpException(403,'You are not authorized to perform this action');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$_POST['Message']['type'] = 'DELETED';
			
		$model->attributes=$_POST['Message'];
		if($model->save())
			$this->redirect(array('view','id'=>$model->id));
		else{			
			Yii::log("errors update message: " . var_export($post->getErrors(), true), CLogger::LEVEL_WARNING, __METHOD__);
		}
		
		$this->render('view',array(
			'model'=>$model,
		));
		

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
	
	/*
	 * 
	 */ 
	public function actionRead($id = null){
		$id = $_GET['id'];
		
		$model=$this->loadModel($id);
		
		if($model->id_user != Yii::app()->session['id'])
			throw new CHttpException(403,'You are not authorized to perform this action');
		
		$_POST['Message']['type'] = 'READ';
			
		$model->attributes=$_POST['Message'];
		
		if($model->save())
			$this->redirect(array('view','id'=>$model->id));
		else{			
			Yii::log("errors update message: " . var_export($post->getErrors(), true), CLogger::LEVEL_WARNING, __METHOD__);
		}
		
		$this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Message');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Message('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Message']))
			$model->attributes=$_GET['Message'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Message the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Message::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Message $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='message-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/**
	 * Before action
	 * @param Aciton to be performed before save operation
	 */
	public function beforeAction($action) {
	    if( parent::beforeAction($action) ) {
	        /* @var $cs CClientScript */
	        $cs = Yii::app()->clientScript;
	        
	       	$baseUrl = Yii::app()->baseUrl; 
	        	        
	        $cs->registerCssFile($baseUrl.'/css/formWhiteStyle.css');
	        $cs->registerCssFile($baseUrl.'/css/messageStyle.css');
			
	        return true;
	    }
	    return false;
	}
}
