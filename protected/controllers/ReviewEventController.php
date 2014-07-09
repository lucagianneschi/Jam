<?php

class ReviewEventController extends Controller
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
				'actions'=>array('create','update'),
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
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @param integer $event the ID of the model event
	 */
	public function actionCreate($event)
	{
		
		$event = Event::model()->findByPk($event);
		
		if($event===null)
			throw new CHttpException(404,'The requested page does not exist.');
		
		$eventGenre = EventGenre::model()->findAll(array("condition"=>"id_event =  $event->id","order"=>"id_event"));
		$eventType = EventType::model()->findAll(array("condition"=>"id_event =  $event->id","order"=>"id_event"));	
		$eventTag = EventTag::model()->findAll(array("condition"=>"id_event =  $event->id","order"=>"id_event"));	
		
		$touser = User::model()->findByPk($event->fromuser);
		
		if($touser===null)
			throw new CHttpException(404,'The requested page does not exist.');	
			
		$fromuser = User::model()->findByPk(Yii::app()->session['id']);
		
		if($fromuser===null)
			throw new CHttpException(404,'The requested page does not exist.');	
		
		$reviewEvent =new ReviewEvent;
		
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($reviewEvent);

		if(isset($_POST['ReviewEvent']))
		{
			$_POST['ReviewEvent']['event'] =  $event->id;
			$_POST['ReviewEvent']['fromuser'] = $fromuser->id;
			$_POST['ReviewEvent']['touser'] = $touser->id;
			$_POST['ReviewEvent']['latitude'] = null;
			$_POST['ReviewEvent']['longitude'] = null;
			$_POST['ReviewEvent']['createdat'] = date('Y-m-d H:i:s');
			$_POST['ReviewEvent']['updatedat'] = date('Y-m-d H:i:s');
			
			$reviewEvent->attributes=$_POST['ReviewEvent'];			
			
			if($reviewEvent->save())
				$this->redirect(array('view','id'=>$reviewEvent->id));
		}

		$this->render('create',array(
			'model'=>$reviewEvent,
			'event'=>$event,
			'fromuser'=>$fromuser,
			'touser'=>$touser,
			'eventGenre' => $eventGenre,
			'eventType'=>$eventType,
			'eventTag'=>$eventTag,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 * @param integer $event the id of the model event
	 */
	public function actionUpdate($id)
	{
		
		$model=$this->loadModel($id);
		
		$event = Event::model()->findByPk($model->event);
		
		if($event===null)
			throw new CHttpException(404,'The requested page does not exist.');
		
		$touser = User::model()->findByPk($model->touser);
		
		if($touser===null)
			throw new CHttpException(404,'The requested page does not exist.');	
			
		$fromuser = User::model()->findByPk(Yii::app()->session['id']);
		
		if($fromuser===null)
			throw new CHttpException(404,'The requested page does not exist.');	
		
		

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['ReviewEvent']))
		{
			$_POST['ReviewEvent']['event'] =  $event->id;
			$_POST['ReviewEvent']['fromuser'] = $fromuser->id;
			$_POST['ReviewEvent']['touser'] = $touser->id;
			$_POST['ReviewEvent']['latitude'] = null;
			$_POST['ReviewEvent']['longitude'] = null;
			$_POST['ReviewEvent']['updatedat'] = date('Y-m-d H:i:s');
			
			$model->attributes=$_POST['ReviewEvent'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
			'event'=>$event,
			'fromuser'=>$fromuser,
			'touser'=>$touser,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
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
		$dataProvider=new CActiveDataProvider('ReviewEvent');
		$this->render('view',array(
			'model'=>$this->loadModel(1),
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ReviewEvent('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ReviewEvent']))
			$model->attributes=$_GET['ReviewEvent'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ReviewEvent the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ReviewEvent::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ReviewEvent $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='review-event-form')
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
	        	        
	        $cs->registerCssFile($baseUrl.'/css/formWhiteStyle.css');
	        
			
	        return true;
	    }
	    return false;
	}
}
