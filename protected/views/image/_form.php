<?php
/* @var $this ImageController */
/* @var $model Image */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'image-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	
	
	<?php for ($i=0; $i < 5 ; $i++) {  ?>		
	
	<div id="form<?php echo $i ?>">
		
		<?php echo $form->errorSummary($model[$i]); ?>
		
		<div class="row">
			<?php echo $form->labelEx($model[$i],'['.$i.']description'); ?>
			<?php echo $form->textArea($model[$i],'['.$i.']description',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model[$i],'['.$i.']description'); ?>
		</div>
	
		<div class="row">
			<?php echo $form->labelEx($model[$i],'['.$i.']latitude'); ?>
			<?php echo $form->textField($model[$i],'['.$i.']latitude'); ?>
			<?php echo $form->error($model[$i],'['.$i.']latitude'); ?>
		</div>
	
		<div class="row">
			<?php echo $form->labelEx($model[$i],'['.$i.']longitude'); ?>
			<?php echo $form->textField($model[$i],'['.$i.']longitude'); ?>
			<?php echo $form->error($model[$i],'['.$i.']longitude'); ?>
		</div>
	
		<div class="row">
			<?php echo $form->labelEx($model[$i],'['.$i.']path'); ?>
			<?php echo $form->textField($model[$i],'['.$i.']path',array('size'=>60,'maxlength'=>100)); ?>
			<?php echo $form->error($model[$i],'['.$i.']path'); ?>
		</div>
	
		<div class="row">
			<?php echo $form->labelEx($model[$i],'['.$i.']thumbnail'); ?>
			<?php echo $form->textField($model[$i],'['.$i.']thumbnail',array('size'=>60,'maxlength'=>100)); ?>
			<?php echo $form->error($model[$i],'['.$i.']thumbnail'); ?>
		</div>
	
	</div>	
	<?php } ?>
	<div class="row">
	    <input type="text" name="countImage" id="countImage" >
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Create'); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->