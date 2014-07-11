<?php
/* @var $this EventController */
/* @var $model Event */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'event-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->textField($model,'active'); ?>
		<?php echo $form->error($model,'active'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'attendeecounter'); ?>
		<?php echo $form->textField($model,'attendeecounter'); ?>
		<?php echo $form->error($model,'attendeecounter'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cancelledcounter'); ?>
		<?php echo $form->textField($model,'cancelledcounter'); ?>
		<?php echo $form->error($model,'cancelledcounter'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'commentcounter'); ?>
		<?php echo $form->textField($model,'commentcounter'); ?>
		<?php echo $form->error($model,'commentcounter'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cover'); ?>
		<?php echo $form->textField($model,'cover',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'cover'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'eventdate'); ?>
		<?php echo $form->textField($model,'eventdate'); ?>
		<?php echo $form->error($model,'eventdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fromuser'); ?>
		<?php echo $form->textField($model,'fromuser',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'fromuser'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'invitedcounter'); ?>
		<?php echo $form->textField($model,'invitedcounter'); ?>
		<?php echo $form->error($model,'invitedcounter'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'latitude'); ?>
		<?php echo $form->textField($model,'latitude'); ?>
		<?php echo $form->error($model,'latitude'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'locationname'); ?>
		<?php echo $form->textField($model,'locationname',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'locationname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'longitude'); ?>
		<?php echo $form->textField($model,'longitude'); ?>
		<?php echo $form->error($model,'longitude'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lovecounter'); ?>
		<?php echo $form->textField($model,'lovecounter'); ?>
		<?php echo $form->error($model,'lovecounter'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'refusedcounter'); ?>
		<?php echo $form->textField($model,'refusedcounter'); ?>
		<?php echo $form->error($model,'refusedcounter'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reviewcounter'); ?>
		<?php echo $form->textField($model,'reviewcounter'); ?>
		<?php echo $form->error($model,'reviewcounter'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sharecounter'); ?>
		<?php echo $form->textField($model,'sharecounter'); ?>
		<?php echo $form->error($model,'sharecounter'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'thumbnail'); ?>
		<?php echo $form->textField($model,'thumbnail',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'thumbnail'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'createdat'); ?>
		<?php echo $form->textField($model,'createdat'); ?>
		<?php echo $form->error($model,'createdat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'updatedat'); ?>
		<?php echo $form->textField($model,'updatedat'); ?>
		<?php echo $form->error($model,'updatedat'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->