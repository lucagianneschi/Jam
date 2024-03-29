<?php
/* @var $this EventController */
/* @var $model Event */

$this->breadcrumbs=array(
	'Events'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Event', 'url'=>array('index')),
	array('label'=>'Create Event', 'url'=>array('create')),
	array('label'=>'Update Event', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Event', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Event', 'url'=>array('admin')),
);
?>

<h1>View Event #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'active',
		'address',
		'attendeecounter',
		'cancelledcounter',
		'city',
		'commentcounter',
		'cover',
		'description',
		'eventdate',
		'fromuser',
		'invitedcounter',
		'latitude',
		'locationname',
		'longitude',
		'lovecounter',
		'refusedcounter',
		'reviewcounter',
		'sharecounter',
		'thumbnail',
		'title',
		'createdat',
		'updatedat',
	),
)); ?>
