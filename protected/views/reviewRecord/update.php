<?php
/* @var $this ReviewRercordController */
/* @var $model ReviewRercord */

$this->breadcrumbs=array(
	'Review Records'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
/*
$this->menu=array(
	array('label'=>'List ReviewRercord', 'url'=>array('index')),
	array('label'=>'Create ReviewRercord', 'url'=>array('create')),
	array('label'=>'View ReviewRercord', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ReviewRercord', 'url'=>array('admin')),
);*/
?>

<h1>Update ReviewRecord <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'record'=>$record, 'fromuser'=>$fromuser, 'touser'=>$touser, 'recordGenre'=>$recordGenre, 'recordTag'=>$recordTag)); ?>