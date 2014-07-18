<?php
/* @var $this EventController */
/* @var $model Event */
/* @var $form CActiveForm */
?>

</div><!-- form -->

<div class="bg-grey-dark">
    <div class="row formBlack" id="uploadEvent">
		<div  class="large-12 columns">
		    <div class="row">
				<div  class="large-12 columns">
				    <h3><?php echo Yii::t('string','view.uploadevent.upload') ?></h3>
				</div>				
		    </div>
		    <div class="row">
				<div  class="large-12 columns formBlack-box">
				    
					<div id="uploadEvent01">
						<div class="form">	
							<?php $form = $this -> beginWidget('CActiveForm', array('id' => 'event-form',
								'enableAjaxValidation' => true,
								
								 ));
			 				?>
			 				<div class="row">
							    <div  class="large-12 columns formBlack-title">
							        <h2><?php echo Yii::t('string','view.uploadevent.create') ?></h2>												
							    </div>	
							</div>				
							<div class="row formBlack-body">
							    <div  class="small-6 columns">							        
								    <div class="row">
										<?php echo $form -> labelEx($model, 'title'); ?>
										<?php echo $form -> textField($model, 'title', array('size' => 60, 'maxlength' => 100)); ?>
										<?php echo $form -> error($model, 'title'); ?>
									</div>
									<!--------------------------- UPLOAD IMAGE -------------------------------->
							        <div class="row upload-box">
							            <div  class="small-3 columns" id="tumbnail-pane">
											<div class="thumbnail-box">
											    <div id="uploadImage_tumbnail-pane" class="uploadImage_tumbnail-pane">
											    	<?php $previewWidth = 100; $previewHeight = 100;?>
														<div id="avatar-thumb" style="position:relative; overflow:hidden; width:<?=$previewWidth?>px; height:<?=$previewHeight?>px; ">
															<?php if(isset($model->thumbnail)){
																 $thumbnail = Yii::app()->params['users_dir']['eventcoverthumb'].'/'.$model->thumbnail;
															}
															?>
															<img id="avatar-preview" class='no-display' src="<?php echo $thumbnail ?>">
														</div>
											    </div>
											</div>
							            </div>
							            <div  class="small-9 columns">							            	
											<a  class="text orange" data-reveal-id="upload"><?php echo Yii::t('string','view.uploadevent.upload_image_mandatory') ?></a>
											 <?php echo $form->error($model,'image');  ?>
							                <div id="upload" class="reveal-modal upload-reveal">							
							                    <div class="row">
							                        <div  class="large-12 columns formBlack-title">
							                            <h2><?php echo Yii::t('string','view.uploadevent.upload_image'); ?></h2>		
							                        </div>	
							                    </div>							                    
							                    <div class="row">							
							                        <div  class="small-5 small-centered columns formBlack-title"> 
							                            <?php
															$this->widget('ext.EFineUploader.EFineUploader',
															 array(
															       'id'=>'FineUploader',								       
															       'config'=>array(
																       'autoUpload'=>true,
																       'request'=>array(
																          'endpoint'=> $this->createUrl('upload'),
																          'params'=>array('YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken),
																       ),
																       'text'=> array('uploadButton'=>'<div class="buttonOrange _add sottotitle ">'.Yii::t('string','view.uploadevent.select_file').'</div>'),
																       'retry'=>array('enableAuto'=>true,'preventRetryResponseProperty'=>true),
																       'chunking'=>array('enable'=>true,'partSize'=>100),//bytes
																       'callbacks'=>array(
															               'onComplete'=>"js:function(id, name, response){
															               		$('#cropImg').load('". $this->createUrl('cropImg') ."/name/'+encodeURI(response.filename));
															               		$('#uploadImage_save').removeClass('no-display');
															                    $('#avatar-preview').attr('src','". Yii::app()->request->baseUrl ."/".Yii::app()->params['users_dir']['temp']."/'+response.filename);
																				$('#Event_image').val('". Yii::getPathOfAlias('webroot') ."/".Yii::app()->params['users_dir']['temp']."/'+response.filename);
															               }",
															               'onError'=>"js:function(id, name, errorReason){ alert(errorReason)}",
															           ),
																       'validation'=>array(
															                 'allowedExtensions'=>Yii::app()->params['extensionsAccepted'],
															                 'sizeLimit'=>Yii::app()->params['maxSize'],//maximum file size in bytes
															                 'minSizeLimit'=>0,// minimum file size in bytes
																       ),
																   )
															 ));   ?>
							                        </div>
							                    </div>
							                   	<div class="row">	
							                   		<div id="cropImg"></div>
							                   	</div>	 											
							                    <div class="row">							
							                        <div  class="small-10 small-centered columns align-center">
							                        	<?php 
							                        		$previewWidth = 100; $previewHeight = 100;
										                    echo $form->hiddenField($model,'image',array('maxlength'=>100)); 
															echo $form->hiddenField($model,'thumbnail');
															echo $form->hiddenField($model,'cover');
															echo $form->hiddenField($model,'cropX', array('value' => '0'));
															echo $form->hiddenField($model,'cropY', array('value' => '0'));
															echo $form->hiddenField($model,'cropW', array('value' => '100'));
															echo $form->hiddenField($model,'cropH', array('value' => '100'));
															?>	
													   
							                        </div>
							
							                    </div>
							
							                    <div class="row">							
							                        <div  class="small-3 small-offset-9 columns">
							                            <input type="button" id="uploadImage_save" name="uploadImage_save" class="buttonNext no-display" value="<?php echo Yii::t('string','view.save'); ?>">
							                        </div>
							                    </div>
							
							                </div>							
							            </div>	
							        </div>
									<!--------------------------- FINE UPLOAD IMAGE -------------------------------->
									<div class="row">
									    
									    	<?php echo $form -> labelEx($model, 'eventdate'); ?>
									    	<?php
									    		
									    		$this->widget('zii.widgets.jui.CJuiDatePicker',array(
												    'name'=>'Event[eventdate]',
												    // additional javascript options for the date picker plugin
												    'options'=>array(
												        'showAnim'=>'fold',
          												'dateFormat'=>'yy-mm-dd',
          												'minDate'=>  date ("Y-m-d"),
												         'onSelect'=>'js:function(i,j){
										                       function JSClock() {
										                          var time = new Date();
										                          var hour = time.getHours();
										                          var minute = time.getMinutes();
										                          var second = time.getSeconds();
										                          var temp="";
										                          temp +=(hour<10)? "0"+hour : hour;
										                          temp += (minute < 10) ? ":0"+minute : ":"+minute ;
										                          return temp;
										                        }
										
										                        $v=$(this).val();
										                        $(this).val($v+" "+JSClock());
																
										                          
										                 }',
										                
												    ),
												    'htmlOptions'=>array(
												        'style'=>'height:20px;'
												    ),
												));
												
									    	?>
									    	<?php echo $form -> error($model, 'eventdate'); ?>
										
									    
									</div>
									<div class="row">										
								        <label for="jammers"><?php echo Yii::t('string','view.uploadevent.jammer_name'); ?></label>
								        <input type="text" />
								        <?php /*
											$this->widget('application.extensions.autocomplete.EJuiAutoCompleteFkField', array(
											      'model'=>$model, 
											      'attribute'=>'id', //the FK field (from CJuiInputWidget)
											      // controller method to return the autoComplete data (from CJuiAutoComplete)
											      'sourceUrl'=>Yii::app()->createUrl('/user/findUser'), 
											      // defaults to false.  set 'true' to display the FK field with 'readonly' attribute.
											      'showFKField'=>true,
											       // display size of the FK field.  only matters if not hidden.  defaults to 10
											      'FKFieldSize'=>15, 
											      'relName'=>'eventTag', // the relation name defined above
											      'displayAttr'=>'PostCodeAndProvince',  // attribute or pseudo-attribute to display
											      // length of the AutoComplete/display field, defaults to 50
											      'autoCompleteLength'=>60,
											      // any attributes of CJuiAutoComplete and jQuery JUI AutoComplete widget may 
											      // also be defined.  read the code and docs for all options
											      'options'=>array(
											          // number of characters that must be typed before 
											          // autoCompleter returns a value, defaults to 2
											          'minLength'=>3, 
											      ),
											 ));
											*/
											?>        	
								    </div>							
									<div class="row">
										<?php echo $form -> labelEx($model, 'locationname'); ?>
										<?php echo $form -> textField($model, 'locationname', array('size' => 60, 'maxlength' => 80)); ?>
										<?php echo $form -> error($model, 'locationname'); ?>
									</div>
							        <div class="row">
										<?php echo $form -> labelEx($model, 'address'); ?>
										<?php echo $form -> textField($model, 'address', array('size' => 60, 'maxlength' => 100)); ?>
										<?php echo $form -> error($model, 'address'); ?>
										<?php echo $form -> error($model, 'city'); ?>
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
									</div>
							        <div class="row no-display">	
										<?php echo $form -> labelEx($model, 'city'); ?>
										<?php echo $form -> textField($model, 'city', array('size' => 60, 'maxlength' => 100)); ?>										
										<span data-geo="locality" id="spanCity"></span>										
									</div>
									
							    </div>							    
							    <div  class="small-6 columns">
									<div class="row">
										<?php echo $form -> labelEx($model, 'description'); ?>
										<?php echo $form -> textArea($model, 'description', array('rows' => 6, 'cols' => 50, 'style'=>'height: 178px;')); ?>
										<?php echo $form -> error($model, 'description'); ?>										 
									</div>
									<div class="row">
										<div  class="small-12 columns">	
											<div class="row">									
										    	<label style="padding-top: 20px !important;" id="label-tag-localType"><?php echo Yii::t('string','view.uploadevent.select_genre'); ?><span class="orange">*</span></label>									    		
										    </div>
										    <div class="row">
											    <div id="tag-localType">
													<?php		
													
													foreach ($eventTypes as $key => $value) {									
														
													    ?>
											    		<input onclick="checkmax(this, 1, 'type')" type="checkbox" name="tag-localType<?php echo $value->id ?>" id="tag-localType<?php echo $value->id ?>" value="<?php echo $value->id ?>" class="no-display">
											    		<label for="tag-localType<?php echo $value->id ?>"><?php echo $value->type ?></label>
													    <?php
													    												
													} 
													?>
											    </div>
										    </div>
										    <div class="row" style="text-align: right" id='boxtype'>
												<?php echo $form -> textField($model, 'eventtype',array('style'=>'display:none')); ?>
												<?php echo $form -> error($model, 'eventtype'); ?>
										    </div>
										</div> 
							        </div>
							        <div class="row">
										<div  class="small-12 columns">	
							        		<div class="row" style="margin-top: 30px">
									    		<label style="padding-bottom: 0px !important;" id="label-tag-music"><?php echo Yii::t('string','view.uploadevent.select_genre_music'); ?><span class="orange">*</span></label>
									    	</div>
									    	 <div class="row">			
										   		 <div id="tag-music">
													<?php 											
													foreach ($genre as $key => $value) {
													    ?>
											    		<input onclick="checkmax(this, 1, 'genre')" type="checkbox" name="tag-music<?php echo $value->id ?>" id="tag-music<?php echo $value->id ?>" value="<?php echo $value->id ?>" class="no-display">
											    		<label for="tag-music<?php echo $value->id ?>"><?php echo $value->genre ?></label>
													    <?php
													   
													} 
													?>
												</div>
											</div>
											<div class="row" style="text-align: right" id='boxgenre'>
										    	<?php echo $form -> textField($model, 'genre',array('style'=>'display:none')); ?>
												<?php echo $form -> error($model, 'genre'); ?>
										    </div>
									    </div>
									</div>
							    </div>
							
							</div>
							<div class="row">
							    <div  class="small-6 columns">
							        <div class="note grey-light" style="padding-top: 50px;"><span class="orange">* </span><?php echo Yii::t('string','view.mandatory_fields')  ?></div>
							    </div>	
							    <div  class="small-6 columns" >
							        <!--input type="submit" name="uploadEvent01-next" id="uploadEvent01-next" class="buttonNext" value="<?php //echo Yii::t('string','view.create'); ?>" style="float: right;"/-->
							    	<div class="row buttons">
										<?php echo CHtml::submitButton($model -> isNewRecord ? Yii::t('string','view.create') : Yii::t('string','view.save'), array('class'=>'buttonNext', 'style'=>'float: right')); ?>
									</div>
							    </div>	
							</div>	
													
						
						<?php $this -> endWidget(); ?>   
					</div>								
				   
				</div>
		    </div>
		</div>
    </div>	
</div>

						    
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script>
  $(function(){
    	geocomplete("#Event_address");    	
    	<?php if(isset($model->eventdate) && $model->eventdate != "CURRENT_TIMESTAMP"){ ?>
    		$('#Event_eventdate').val("<?php echo date("Y-m-d H:i", strtotime($model->eventdate)) ?>")
    		
    	<?php } ?>
    	if($('#avatar-preview').attr('src') != "") $('#avatar-preview').removeClass('no-display');
    	$( "#uploadImage_save" ).click(function() {
		  	$('#avatar-preview').removeClass('no-display');
		  	$('#upload').foundation('reveal', 'close');
		});
    			
  });
  function compileForm(location){
  	$('#Event_latitude').val(location.latitude); 
  	$('#Event_longitude').val(location.longitude);
  	$('#Event_city').val($('#spanCity').html());
  }
</script>