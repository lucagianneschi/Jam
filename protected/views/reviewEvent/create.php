<?php
/* @var $this ReviewEventController */
/* @var $model ReviewEvent */

$this->breadcrumbs=array(
	'Review Events'=>array('index'),
	'Create',
);
/*
$this->menu=array(
	array('label'=>'List ReviewEvent', 'url'=>array('index')),
	array('label'=>'Manage ReviewEvent', 'url'=>array('admin')),
); */
?>

<h1>Create ReviewEvent</h1>

<p><?php echo $event->title ?></p>

<p><?php echo $fromuser->username ?></p>

<p><?php echo $touser->username ?></p>

<?php $this->renderPartial('_form', array('model'=>$model,'event'=>$event, 'fromuser'=>$fromuser, 'touser'=>$touser)); ?>



<?php echo Yii::t('string','model.description')?>