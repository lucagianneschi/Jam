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

<?php $this->renderPartial('_form', array('model'=>$model)); ?>


<?php echo Yii::t('form','create');?>