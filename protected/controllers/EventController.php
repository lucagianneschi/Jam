<?php

class EventController extends Controller
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
				'actions'=>array('create','update','upload','cropImg'),
				'users'=>array('@'),
				'expression'=>Yii::app()->session['type'].'== VENUE || '.Yii::app()->session['type'].' == JAMMER',
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
	 */
	public function actionCreate()
	{
		$model=new Event;
		
		$fromuser = User::model()->findByPk(Yii::app()->session['id']);
		
		if($fromuser===null)
			throw new CHttpException(404,'The requested page does not exist.');
		
		$genre = Genre::model()->findAll();
		
		if($genre===null)
			throw new CHttpException(404,'The requested page does not exist.');
		
		$eventTypes = Eventtypes::model()->findAll();
		
		if($eventTypes===null)
			throw new CHttpException(404,'The requested page does not exist.');
		
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Event']))
		{
			
			$_POST['Event']['cover'] = 'cover'; //ricavato da plugin per upload image
			$_POST['Event']['fromuser'] = $fromuser->id;			
			$_POST['Event']['thumbnail'] = 'thumbnail'; //ricavato da plugin per upload image
			$_POST['Event']['createdat'] = date('Y-m-d H:i:s');
			$_POST['Event']['updatedat'] = date('Y-m-d H:i:s');
			
			$model->attributes=$_POST['Event'];
			if($model->save()){
				$eventGenre =new EventGenre;
				$eventGenre->id_event = $model->id;
				$eventGenre->id_genre = $_POST['Event']['genre'];
				
				if(!$eventGenre->save()){
					throw new CHttpException(405,'Errors saving event genre');
				}
				
				$eventType =new EventType;
				$eventType->id_event = $model->id;
				$eventType->id_type = $_POST['Event']['eventtype'];
				if(!$eventType->save()){
					throw new CHttpException(405,'Errors saving event type');
				}
				$this->redirect(array('view','id'=>$model->id));
				
			}
	/*		else{
				Yii::log("errors saving event: " . var_export($model->getErrors(), true), CLogger::LEVEL_WARNING, __METHOD__);			
				throw new CHttpException(405,'Error saving event');
			}
		*/		
		}

		$this->render('create',array(
			'model'=>$model,
			'genre'=>$genre,
			'eventTypes' => $eventTypes,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Event']))
		{
			$model->attributes=$_POST['Event'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		$dataProvider=new CActiveDataProvider('Event');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Event('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Event']))
			$model->attributes=$_GET['Event'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	/*
	 * upload image
	 */ 
	public function actionUpload()
        {
        	
            $tempFolder=Yii::app()->baseUrl.'/'.Yii::app()->params['users_dir']['temp'].'/';
			
			if(!@opendir($tempFolder)){
				mkdir($tempFolder, 0777, TRUE);
				mkdir($tempFolder.'chunks', 0777, TRUE);
			}
			
     		Yii::import("ext.EFineUploader.qqFileUploader");
 
            $uploader = new qqFileUploader();
            $uploader->allowedExtensions = Yii::app()->params['extensionsAccepted'];
            $uploader->sizeLimit = Yii::app()->params['maxSize'];//maximum file size in bytes
            $uploader->chunksFolder = $tempFolder.'chunks';
 			
 			$result = $uploader->handleUpload($tempFolder);
            $result['filename'] = $uploader->getUploadName();
            $result['folder'] = $webFolder;
 
            $uploadedFile=$tempFolder.$result['filename'];
 
            header("Content-Type: text/plain");
            $result=htmlspecialchars(json_encode($result), ENT_NOQUOTES);
            echo $result;
            Yii::app()->end();
		
        }
		
	/*
	 * preview e crop image
	 */ 
	public function actionCropImg()
    {
		
		Yii::app()->clientScript->scriptMap=array( (YII_DEBUG ?  'jquery.js':'jquery.min.js')=>false, );
        $imageUrl = Yii::app()->baseUrl.'/'.Yii::app()->params['users_dir']['temp'].'/'. $_GET['name'];
        $this->renderPartial('cropImg', array('imageUrl'=>$imageUrl), false, true);
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Event the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Event::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Event $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='event-form')
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
	        $cs->registerScriptFile($baseUrl.'/js/plugins/geocomplete/jquery.geocomplete.js');			
			$cs->registerScriptFile($baseUrl.'/js/custom/utils.js');
	        return true;
	    }
	    return false;
	}	
}
