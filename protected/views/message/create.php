<?php
/* @var $this MessageController */
/* @var $model Message */

$this->breadcrumbs=array(
	'Messages'=>array('index'),
	'Create',
);

?>



<?php $this->renderPartial('_form', array('model'=>$model)); ?>