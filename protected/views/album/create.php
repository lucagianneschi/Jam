<?php
/* @var $this AlbumController */
/* @var $model Album */

$this->breadcrumbs=array(
	'Albums'=>array('index'),
	'Create',
);
/*
$this->menu=array(
	array('label'=>'List Album', 'url'=>array('index')),
	array('label'=>'Manage Album', 'url'=>array('admin')),
);*/
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
