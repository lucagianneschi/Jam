<?php
/* @var $this EventController */
/* @var $data Event */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('attendeecounter')); ?>:</b>
	<?php echo CHtml::encode($data->attendeecounter); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cancelledcounter')); ?>:</b>
	<?php echo CHtml::encode($data->cancelledcounter); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('city')); ?>:</b>
	<?php echo CHtml::encode($data->city); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('commentcounter')); ?>:</b>
	<?php echo CHtml::encode($data->commentcounter); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('cover')); ?>:</b>
	<?php echo CHtml::encode($data->cover); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('eventdate')); ?>:</b>
	<?php echo CHtml::encode($data->eventdate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fromuser')); ?>:</b>
	<?php echo CHtml::encode($data->fromuser); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invitedcounter')); ?>:</b>
	<?php echo CHtml::encode($data->invitedcounter); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('latitude')); ?>:</b>
	<?php echo CHtml::encode($data->latitude); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('locationname')); ?>:</b>
	<?php echo CHtml::encode($data->locationname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('longitude')); ?>:</b>
	<?php echo CHtml::encode($data->longitude); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lovecounter')); ?>:</b>
	<?php echo CHtml::encode($data->lovecounter); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('refusedcounter')); ?>:</b>
	<?php echo CHtml::encode($data->refusedcounter); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reviewcounter')); ?>:</b>
	<?php echo CHtml::encode($data->reviewcounter); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sharecounter')); ?>:</b>
	<?php echo CHtml::encode($data->sharecounter); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('thumbnail')); ?>:</b>
	<?php echo CHtml::encode($data->thumbnail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createdat')); ?>:</b>
	<?php echo CHtml::encode($data->createdat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updatedat')); ?>:</b>
	<?php echo CHtml::encode($data->updatedat); ?>
	<br />

	*/ ?>

</div>