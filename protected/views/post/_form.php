<?php
/* @var $this PostController */
/* @var $model Post */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'post-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

<div class="row social-Post">
	<div  class="large-12 columns">
		<div class="row">
	    	<h3><?php echo Yii::t('string','view.profile.post.title') ?></h3>
	    </div>
	    <div class="row ">
	   		<div  class="large-12 columns ">
	    		<div class="row  ">
	    		    <div  class="large-12 columns ">	    					    
	    			    <div class="row">
		    				<div class="small-9 columns ">
		    				    <div class="row">									
									<?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>50, 'class'=>"post inline", 'placeholder'=>Yii::t('string','view.profile.post.write'))); ?>
									<?php echo $form -> error($model, 'text'); ?>
								</div>	
		    				</div>
		    				
		    				<div class="small-3 columns ">		    				   
			    				<div class="row buttons">
									<?php echo CHtml::submitButton($model->isNewRecord ?  Yii::t('string','view.post_button') : Yii::t('string','view.save'), array('class'=>"post-button inline" )); ?>
								</div>
		    				</div>
	    			    </div>
	    		    </div>
	    		</div>	    		
	    	</div>
	    </div>
   </div> 
</div>
<?php $this->endWidget(); ?>



   