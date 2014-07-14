<?php
/* @var $this CommentController */
/* @var $model Comment */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comment-form',
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
		<?php echo $form->labelEx($model,'album'); ?>
		<?php echo $form->textField($model,'album',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'album'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textField($model,'comment',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'commentcounter'); ?>
		<?php echo $form->textField($model,'commentcounter'); ?>
		<?php echo $form->error($model,'commentcounter'); ?>
	</div>

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
		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo $form->textField($model,'image',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'image'); ?>
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

	<div class="row">
		<?php echo $form->labelEx($model,'lovecounter'); ?>
		<?php echo $form->textField($model,'lovecounter'); ?>
		<?php echo $form->error($model,'lovecounter'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'record'); ?>
		<?php echo $form->textField($model,'record',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'record'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sharecounter'); ?>
		<?php echo $form->textField($model,'sharecounter'); ?>
		<?php echo $form->error($model,'sharecounter'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'song'); ?>
		<?php echo $form->textField($model,'song',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'song'); ?>
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
		<?php echo $form->labelEx($model,'video'); ?>
		<?php echo $form->textField($model,'video',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'video'); ?>
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