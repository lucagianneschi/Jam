<?php
/* @var $this ReviewRercordController */
/* @var $model ReviewRercord */

$this->breadcrumbs=array(
	'Review Rercords'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ReviewRercord', 'url'=>array('index')),
	array('label'=>'Create ReviewRercord', 'url'=>array('create')),
	array('label'=>'Update ReviewRercord', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ReviewRercord', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ReviewRercord', 'url'=>array('admin')),
);
?>

<h1>View ReviewRercord #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'active',
		'fromuser',
	        'record',
		'text',
		'touser',
		'vote',
		'createdat',
		'updatedat',
		'latitude',
		'longitude',
	),
)); ?>
