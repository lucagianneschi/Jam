<?php
/* @var $this MessageController */
/* @var $model Message */
/* @var $form CActiveForm */
?>



<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'message-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	
<div class="row bg-white box-message" style="padding-top: 3%;">	
	<div class="row">
		<?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>50, 'placeholder'=>Yii::t('string','view.message.message'))); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>
	<div class="row">
    	<div class="large-12">
    		
				<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('string','view.message.send') : Yii::t('string','view.save'), array('class'=>'buttonNext')); ?>
			
		</div>
	</div>
</div>
<?php $this->endWidget(); ?>

