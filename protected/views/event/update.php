<?php
/* @var $this EventController */
/* @var $model Event */

$this->breadcrumbs=array(
	'Events'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);
/*
$this->menu=array(
	array('label'=>'List Event', 'url'=>array('index')),
	array('label'=>'Create Event', 'url'=>array('create')),
	array('label'=>'View Event', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Event', 'url'=>array('admin')),
); */
?>

<?php $this->renderPartial('_form', array('model'=>$model,'genre'=>$genre,'eventTypes'=>$eventTypes)); ?>