<?php
/* @var $this ReviewEventController */
/* @var $data ReviewEvent */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('event')); ?>:</b>
	<?php echo CHtml::encode($data->event); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fromuser')); ?>:</b>
	<?php echo CHtml::encode($data->fromuser); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text')); ?>:</b>
	<?php echo CHtml::encode($data->text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('touser')); ?>:</b>
	<?php echo CHtml::encode($data->touser); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vote')); ?>:</b>
	<?php echo CHtml::encode($data->vote); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('createdat')); ?>:</b>
	<?php echo CHtml::encode($data->createdat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updatedat')); ?>:</b>
	<?php echo CHtml::encode($data->updatedat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('latitude')); ?>:</b>
	<?php echo CHtml::encode($data->latitude); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('longitude')); ?>:</b>
	<?php echo CHtml::encode($data->longitude); ?>
	<br />

	*/ ?>

</div>