<?php
/* @var $this ReviewEventController */
/* @var $model ReviewEvent */

$this->breadcrumbs=array(
	'Review Events'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ReviewEvent', 'url'=>array('index')),
	array('label'=>'Create ReviewEvent', 'url'=>array('create')),
	array('label'=>'Update ReviewEvent', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ReviewEvent', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ReviewEvent', 'url'=>array('admin')),
);
?>

<h1>View ReviewEvent #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'active',
		'event',
		'fromuser',
		'text',
		'touser',
		'vote',
		'createdat',
		'updatedat',
		'latitude',
		'longitude',
	),
)); ?>
