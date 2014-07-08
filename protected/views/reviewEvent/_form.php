<?php
/* @var $this ReviewEventController */
/* @var $model ReviewEvent */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'review-event-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
	
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'event'); ?>
		<?php echo $form->textField($model,'event',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'event'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fromuser'); ?>
		<?php echo $form->textField($model,'fromuser',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'fromuser'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'touser'); ?>
		<?php echo $form->textField($model,'touser',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'touser'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vote'); ?>
		<?php echo $form->textField($model,'vote'); ?>
		<?php echo $form->error($model,'vote'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'latitude'); ?>
		<?php echo $form->textField($model,'latitude'); ?>
		<?php echo $form->error($model,'latitude'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'longitude'); ?>
		<?php echo $form->textField($model,'longitude'); ?>
		<?php echo $form->error($model,'longitude'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->