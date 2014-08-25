<?php
/* @var $this ImageController */
/* @var $data Image */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('album')); ?>:</b>
	<?php echo CHtml::encode($data->album); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('commentcounter')); ?>:</b>
	<?php echo CHtml::encode($data->commentcounter); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fromuser')); ?>:</b>
	<?php echo CHtml::encode($data->fromuser); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('latitude')); ?>:</b>
	<?php echo CHtml::encode($data->latitude); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('longitude')); ?>:</b>
	<?php echo CHtml::encode($data->longitude); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lovecounter')); ?>:</b>
	<?php echo CHtml::encode($data->lovecounter); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('path')); ?>:</b>
	<?php echo CHtml::encode($data->path); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sharecounter')); ?>:</b>
	<?php echo CHtml::encode($data->sharecounter); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('thumbnail')); ?>:</b>
	<?php echo CHtml::encode($data->thumbnail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createdat')); ?>:</b>
	<?php echo CHtml::encode($data->createdat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updatedat')); ?>:</b>
	<?php echo CHtml::encode($data->updatedat); ?>
	<br />

	*/ ?>

</div>