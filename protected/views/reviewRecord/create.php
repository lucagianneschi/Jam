<?php
/* @var $this ReviewRercordController */
/* @var $model ReviewRercord */

$this->breadcrumbs=array(
	'Review Records'=>array('index'),
	'Create',
);
/*
$this->menu=array(
	array('label'=>'List ReviewRercord', 'url'=>array('index')),
	array('label'=>'Manage ReviewRercord', 'url'=>array('admin')),
); */
?>


<?php $this->renderPartial('_form', array('model'=>$model,'record'=>$record, 'fromuser'=>$fromuser, 'touser'=>$touser, 'recordGenre'=>$recordGenre,  'recordTag'=>$recordTag)); ?>
