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
	<div class="bg-white">
	    <div class="row">
	        <div class="large-12 columns">
	            <div class="box-upload-review-event">
	                <h3><?php echo Yii::t('string','view.uploadreview.review') ?></h3>
	                <div class="row">
	                    <div class="large-12 columns">
	                        <div class="box">
	
	                            <div class="row box-upload-title">
	                                <div class="large-12 columns">
	                                    <h2><?php echo Yii::t('string','view.uploadreview.create') ?></h2>
	                                </div>
	                            </div>
	                            <div class="row">
	                                <div class="large-4 columns">
	                                    <div class="sidebar">
	                                        <div class="oggetto-review">										    
												<div class="row">
												    <div class="small-3 columns ">							    						
														<div class="coverThumb" style="cursor: pointer">
														    <!--img src="<?php echo $elReviewedThumb; ?>" onerror="this.src='<?php echo $defThumb ?>'" alt-->
														    <?php echo CHtml::image(Yii::app()->request->baseUrl.'/'.Yii::app()->params['users_dir']['users'] .'/'. $touser->id . '/'.Yii::app()->params['users_dir']['eventcoverthumb'].'/'.$event->thumbnail, $event->title, array('onerror'=>'this.src="'.Yii::app()->request->baseUrl.'/images/default/defaultEventThumb.jpg"'));  ?>
														</div>
												    </div>						
												    <div class="small-9 columns ">
														<div class="row ">							
														    <div class="small-12 columns ">
																<?php echo CHtml::link($event->title, array('event/view', 'id'=>$event->id), array('class'=>'sottotitle grey-dark')); ?>
																<div class="breakOffTest">
																<a class="ico-label _tag inline grey">
																	<?php foreach ($eventType as $key => $value) {
																		$types = Eventtypes::model()->findByPk($value->id_type);
																		echo strtolower($types->type).', ';
																	} ?>
																</a></div>
																<div class="breakOffTest">
																<a class="ico-label _note inline grey breakOffTest">
																	<?php foreach ($eventGenre as $key => $value) {
																		$genre = Genre::model()->findByPk($value->id_genre);
																		echo strtolower($genre->genre).', ';
																	} ?>
																</a></div>
														    </div>		
														</div>							
												    </div>
												</div>
	                                            <div class="row">
	                                                <div class="large-12 columns"><div class="line"></div></div>
	                                            </div>					         
											</div>
											<div class="row ">
											    <div class="large-12 columns ">
													<div class="text orange"><?php echo Yii::t('string','view.uploadreview.performed') ?></div>
													<div class="row">
													    <div class="small-12 columns">												
														    <div class="box-membre">
																<div class="row">
																    <div class="small-2 columns">
																		<div class="icon-header">								                                    									                                    	
									                                    	<?php 
									                                    	$userType = $touser->type == 'JAMMER' ? 'Jammer' : 'Venue';
									                                    	echo CHtml::image(Yii::app()->request->baseUrl.'/'.Yii::app()->params['users_dir']['users'] .'/'. $touser->id . '/'.Yii::app()->params['users_dir']['thumbnail'].'/'.$touser->thumbnail, $touser->username, array('onerror'=>'this.src="'.Yii::app()->request->baseUrl.'/images/default/defaultAvatarThumb'.$userType.'.jpg"'));  ?>
																		</div>
																    </div>
																    <div class="small-10 columns ">
																    	<?php echo CHtml::link($touser->username, array('user/view', 'id'=>$touser->id), array('class'=>'text grey-dark breakOffTest')); ?>
																    	<div class="note orange" style="margin-top: 3px"><?php echo  ucfirst(strtolower($touser->type)) ?></div>
																    </div>		
																</div>	
														    </div>
													    </div>
													</div>	
											    </div>								
											</div>
											<br> <br>
											<div class="row ">
											    <div class="large-12 columns ">
													<div class="text orange"><?php echo Yii::t('string','view.uploadreview.featuring') ?></div>
													<div class="row">
													    <div class="small-12 columns">
														<?php
														foreach ($eventTag as $key => $value) {
															$user = User::model()->findByPk($value->id_user);
															
														}
														if (is_array($eventTag) && count($eventTag) > 0) {
														    foreach ($eventTag as $key => $value) {
																$user = User::model()->findByPk($value->id_user);
																switch ($user->type) {
																    case 'JAMMER':
																	$userType = 'Jammer';
																	break;
																    case 'VENUE':
																	$userType = 'Venue';
																	break;
																	case 'SPOTTER':
																	$userType = 'Spotter';
																	break;
																}
															
															?>
															
															    <div class="box-membre" id="<?php echo $user->id ?>">
																<div class="row">
																    <div class="small-2 columns ">
																	<div class="icon-header">																	    
																	   <?php echo CHtml::image(Yii::app()->request->baseUrl.'/'.Yii::app()->params['users_dir']['users'] .'/'. $user->id . '/'.Yii::app()->params['users_dir']['thumbnail'].'/'.$user->thumbnail, $user->username, array('onerror'=>'this.src="'.Yii::app()->request->baseUrl.'/images/default/defaultAvatarThumb'.$userType.'.jpg"'));  ?>
																	</div>
																    </div>
																    <div class="small-10 columns">
																    	<?php echo CHtml::link($user->username, array('user/view', 'id'=>$user->id), array('class'=>'text grey-dark breakOffTest')); ?>
																    	<div class="note orange" style="margin-top: 3px"><?php echo  ucfirst(strtolower($user->type)) ?></div>
																    </div>		
																</div>	
															    </div>
															
															<?php
														    }
														} else {
														    ?>
							    							<div class="row">
							    							    <div class="small-12 columns">
							    								<div class="text gray"><?php echo Yii::t('string','view.uploadreview.notfeaturing') ?></div>
							    							    </div>
							    							</div>
														<?php }  ?>
													    </div>
													</div>	
											    </div>								
											</div>
					    				</div>
									</div>
									<div class="large-6 large-offset-1 end columns">	
										<div class="row">
											<div class="large-12 columns ">
											    <h5><?php //echo $views['uploadReview']['write']; ?></h5>
											    <?php echo $form->labelEx($model,'text'); ?>
												<?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>50)); ?>
												<?php echo $form->error($model,'text'); ?>
											</div>
									   </div>
									   <br>
										<div class="row rating">
											<div class="large-3 columns ">
											    <h5><?php echo Yii::t('string','view.uploadreview.your_rating') ?></h5>
											</div>
											<div class="large-9 columns big-star" style="top: 8px">
												<?php $this->widget('CStarRating',array('name'=>'vote','minRating'=>1, 'maxRating'=>5, 'allowEmpty'=>false, 'value'=>1)); ?>											   
											</div>
									    </div>				
									</div>
				    			</div>
							    <br><br>							  
							    <div class="row">
							    	<div  class="small-6 columns">
								        <div class="note grey sidebar" style="padding-top: 50px;"><span class="orange">* </span><?php echo Yii::t('string','view.mandatory_fields') ?></div>
								    </div>								    	
									<div class="small-6 columns">
									    <div class="row buttons">
											<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('string','view.create') : Yii::t('string','view.save'),array('class'=>'buttonNext','id'=>'button_publish')); ?>
										</div>
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
</div><!-- form -->	