<?php
/* @var $this ReviewEventController */
/* @var $model ReviewEvent */

$this->breadcrumbs=array(
	'Review Events'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ReviewEvent', 'url'=>array('index')),
	array('label'=>'Create ReviewEvent', 'url'=>array('create')),
	array('label'=>'View ReviewEvent', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ReviewEvent', 'url'=>array('admin')),
);
?>

<h1>Update ReviewEvent <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>