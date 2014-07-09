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


<?php $this->renderPartial('_form', array('model'=>$model,'event'=>$event, 'fromuser'=>$fromuser, 'touser'=>$touser, 'eventGenre'=>$eventGenre, 'eventType'=>$eventType, 'eventTag'=>$eventTag)); ?>
