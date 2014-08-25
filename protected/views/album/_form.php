<?php
/* @var $this AlbumController */
/* @var $model Album */
/* @var $form CActiveForm */
?>

<div class="bg-grey-dark">
    <div class="row formBlack" id="uploadAlbum">
		<div  class="large-12 columns">
		    <div class="row">
				<div  class="large-12 columns">
				    <h3><?php echo Yii::t('string','view.uploadalbum.upload') ?></h3>
				</div>				
		    </div>
		    <div class="row">
				<div  class="large-12 columns formBlack-box">	

				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'album-form',
					// Please note: When you enable ajax validation, make sure the corresponding
					// controller action is handling ajax validation correctly.
					// There is a call to performAjaxValidation() commented in generated controller code.
					// See class documentation of CActiveForm for details on this.
					'enableAjaxValidation'=>true,
				)); ?>
				
					<div class="row">
					    <div  class="large-12 columns formBlack-title">
					        <h2><?php echo Yii::t('string','view.uploadalbum.create_album') ?></h2>												
					    </div>	
					</div>
					<div class="row formBlack-body">
					    <div  class="small-6 columns">
					        <!--input type="text" name="albumTitle" id="albumTitle" pattern="description" required/>
					        <label for="albumTitle"><?php echo Yii::t('string','view.uploadalbum.title') ?><span class="orange">*</span><small class="error"><?php echo Yii::t('string','view.uploadalbum.valid_title'); ?></small></label-->
							<div class="row">
								<?php echo $form->labelEx($model,'title'); ?>
								<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>80)); ?>
								<?php echo $form->error($model,'title'); ?>
							</div>
							<div class="row">
								<label for="featuring"><?php echo  Yii::t('string','view.uploadalbum.feat'); ?></label>
						        <input type="text" name="featuring" id="featuring" pattern=""/>						        
							</div>
							<div class="row">						        
						        <label for="city"><?php echo Yii::t('string','view.uploadalbum.city'); ?></label>
						        <input type="text" name="city" id="city"/>
						        
							</div>
					    </div>
					
					    <div  class="small-6 columns">
					        <!--label for="description"><?php echo $views['uploadAlbum']['description']; ?><span class="orange">*</span><small class="error"><?php echo $views['uploadAlbum']['valid_description']; ?></small>		
						    <textarea name="description" id="description" pattern="description" maxlength="200" rows="100" required style="height: 155px; margin-bottom: 30px !important;"></textarea></label-->		 
					   		<div class="row">
								<?php echo $form->labelEx($model,'description'); ?>
								<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50,'style'=>'height: 178px;')); ?>
								<?php echo $form->error($model,'description'); ?>
							</div>
							<div class="row no-display">	
								<?php echo $form -> labelEx($model, 'latitude'); ?>
								<?php echo $form -> textField($model, 'latitude', array('size' => 60, 'maxlength' => 100)); ?>
								<?php echo $form -> error($model, 'latitude'); ?>
							</div>
					        <div class="row  no-display">	
								<?php echo $form -> labelEx($model, 'longitude'); ?>
								<?php echo $form -> textField($model, 'longitude', array('size' => 60, 'maxlength' => 100)); ?>
								<?php echo $form -> error($model, 'longitude'); ?>
								<span data-geo="locality" id="spanCity"></span>	 
							</div>
						</div>
					
					</div>
					<div class="row">
					    <div  class="small-6 columns">
					        <div class="note grey-light" style="padding-top: 50px;"><span class="orange">* </span><?php echo Yii::t('string','view.mandatory_fields'); ?></div>
					    </div>	
					    <div  class="small-6 columns" >
					        <!--input type="button" name="uploadAlbum02-next" id="uploadAlbum02-next" class="buttonNext" value="<?php //echo $views['next']; ?>" style="float: right;"/-->
					   		<div class="row buttons">
								<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('string','view.next') : Yii::t('string','view.save') , array('class'=>"buttonNext",'style'=>"float: right;")); ?>
							</div>
					    </div>	
					</div>
					
				
				<?php $this->endWidget(); ?>

				</div>
		    </div>
		</div>
    </div>	
</div>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script>
  $(function(){
    	geocomplete("#city"); 
    			
  });
  function compileForm(location){
  	$('#Album_latitude').val(location.latitude); 
  	$('#Album_longitude').val(location.longitude);
  }
</script>