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
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vote'); ?>
		<?php echo $form->textField($model,'vote'); ?>
		<?php echo $form->error($model,'vote'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<div class="bg-white">
    <div class="row">
        <div class="large-12 columns">
            <div class="box-upload-review-event">
                <h3><?php echo $views['uploadReview']['review']; ?></h3>
                <div class="row">
                    <div class="large-12 columns">
                        <div class="box">

                            <div class="row box-upload-title">
                                <div class="large-12 columns">
                                    <h2><?php echo $views['uploadReview']['create']; ?></h2>
                                </div>
                            </div>

                            <div class="row">
                                <div class="large-4 columns">
                                    <div class="sidebar">

                                        <div class="oggetto-review">
					    <a href="<?php echo $link ?>">
						<div class="row">
						    <div class="small-3 columns ">							    						
							<div class="coverThumb" style="cursor: pointer">
							    <img src="<?php echo $elReviewedThumb; ?>" onerror="this.src='<?php echo $defThumb ?>'" alt>
							</div>
						    </div>						
						    <div class="small-9 columns ">
								<div class="row ">							
								    <div class="small-12 columns ">
										<a href="record.php?record=<?php echo $_GET["rewiewId"] ?>"><div class="sottotitle grey-dark"><?php echo $title; ?></div></a>
										<a class="ico-label _tag inline text grey <?php echo $css_stringGenre ?>"><?php echo $stringGenre ?></a>
										<a class="ico-label _note inline text grey"><?php echo $stringTag ?></a>
								    </div>		
								</div>							
						    </div>
						</div>
					    </a>
                                            <div class="row">
                                                <div class="large-12 columns"><div class="line"></div></div>
                                            </div>
                                            <!--div class="row">						
                                                <div class="small-3 columns ">
												<div class="note grey"><?php echo $views['uploadReview']['rating']; ?></div>
                                                </div>
                                                <div class="small-9 columns ">
					    <?php /*
					      switch ($rating) {
					      case 0 :
					      ?>
					      <a class="icon-propriety _star-grey"></a>
					      <a class="icon-propriety _star-grey"></a>
					      <a class="icon-propriety _star-grey"></a>
					      <a class="icon-propriety _star-grey"></a>
					      <a class="icon-propriety _star-grey"></a>
					      <?php
					      break;
					      case 1 :
					      ?>
					      <a class="icon-propriety _star-orange"></a>
					      <a class="icon-propriety _star-grey"></a>
					      <a class="icon-propriety _star-grey"></a>
					      <a class="icon-propriety _star-grey"></a>
					      <a class="icon-propriety _star-grey"></a>
					      <?php
					      break;
					      case 2 :
					      ?>
					      <a class="icon-propriety _star-orange"></a>
					      <a class="icon-propriety _star-orange"></a>
					      <a class="icon-propriety _star-grey"></a>
					      <a class="icon-propriety _star-grey"></a>
					      <a class="icon-propriety _star-grey"></a>
					      <?php
					      break;
					      case 3 :
					      ?>
					      <a class="icon-propriety _star-orange"></a>
					      <a class="icon-propriety _star-orange"></a>
					      <a class="icon-propriety _star-orange"></a>
					      <a class="icon-propriety _star-grey"></a>
					      <a class="icon-propriety _star-grey"></a>
					      <?php
					      break;
					      case 4 :
					      ?>
					      <a class="icon-propriety _star-orange"></a>
					      <a class="icon-propriety _star-orange"></a>
					      <a class="icon-propriety _star-orange"></a>
					      <a class="icon-propriety _star-orange"></a>
					      <a class="icon-propriety _star-grey"></a>
					      <?php
					      break;
					      case 5 :
					      ?>
					      <a class="icon-propriety _star-orange"></a>
					      <a class="icon-propriety _star-orange"></a>
					      <a class="icon-propriety _star-orange"></a>
					      <a class="icon-propriety _star-orange"></a>
					      <a class="icon-propriety _star-orange"></a>
					      <?php
					      break;
					      } */
					    ?>
                                                </div>
                                            </div-->
					</div>
					<div class="row ">
					    <div class="large-12 columns ">
						<div class="text orange"><?php echo $views['uploadReview']['performed']; ?></div>
						<div class="row">
						    <div class="small-12 columns">
							<a href="profile.php?user=<?php echo $authorObjectId ?>">
							    <div class="box-membre">
								<div class="row">
								    <div class="small-2 columns">
									<div class="icon-header">
                                                                            <img src="<?php $fileManagerService->getPhotoPath($authorObjectId, $authorThumbnail); ?>" onerror="this.src='<?php echo DEFAVATARSPOTTER; ?>'" alt>
									</div>
								    </div>
								    <div class="small-10 columns ">
									<div class="text grey-dark breakOffTest"><?php echo $author; ?></div>
								    </div>		
								</div>	
							    </div>
							</a>
						    </div>
						</div>	
					    </div>								
					</div>
					<br> <br>
					<div class="row ">
					    <div class="large-12 columns ">
						<div class="text orange"><?php echo $views['uploadReview']['featuring']; ?></div>
						<div class="row">
						    <div class="small-12 columns">
							<?php
							if (is_array($uploadReviewController->reviewedFeaturing) && count($uploadReviewController->reviewedFeaturing) > 0) {
							    foreach ($uploadReviewController->reviewedFeaturing as $featuringUser) {
								switch ($featuringUser->getType()) {
								    case 'JAMMER':
									$defaultThum = DEFTHUMBJAMMER;
									break;
								    case 'VENUE':
									$defaultThum = DEFTHUMBVENUE;
									break;
								}
								$featuringThumbnail = $featuringUser->getThumbnail();
								$featuringUsername = $featuringUser->getUsername();
								$featuringUserId = $featuringUser->getId();
								?>
								<a href="profile.php?user=<?php echo $featuringUserId ?>">
								    <div class="box-membre" id="<?php echo $featuringUserId ?>">
									<div class="row">
									    <div class="small-2 columns ">
										<div class="icon-header">
										    <img src="<?php $fileManagerService->getPhotoPath($featuringUserId, $featuringThumbnail); ?>" onerror="this.src='<?php echo $defaultThum ?>'" alt>
										</div>
									    </div>
									    <div class="small-10 columns">
										<div class="text grey-dark breakOffTest"><?php echo $featuringUsername ?></div>
									    </div>		
									</div>	
								    </div>
								</a>
								<?php
							    }
							} else {
							    ?>
    							<div class="row">
    							    <div class="small-12 columns">
    								<div class="text gray"><?php echo $views['uploadReview']['notfeaturing']; ?></div>
    							    </div>
    							</div>
							<?php } ?>
						    </div>
						</div>	
					    </div>								
					</div>

				    </div>
				</div>
				<div class="large-6 large-offset-1 end columns">
				    <div class="row">
					<div class="large-12 columns ">
					    <h5><?php echo $views['uploadReview']['write']; ?></h5>
					    <textarea></textarea>
					</div>
				    </div>
				    <div class="row rating">
					<div class="large-3 columns ">
					    <h5><?php echo $views['uploadReview']['your_rating']; ?></h5>
					</div>
					<div class="large-9 columns big-star">
					    <select id="example-f" name="rating">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					    </select>
					</div>
				    </div>
				</div>
			    </div>
			    <br><br>
			    <div class="row">
				<div class="large-12">
				    <input type="button" class="buttonNext" id="button_publish" value="<?php echo $views['publish']; ?>">
				    <input type="hidden" id="reviewedId" value="<?php echo $_GET['rewiewId']; ?>">
				    <input type="hidden" id="type" value="<?php echo $_GET['type']; ?>">
				</div>
			    </div>

			</div>
		    </div>
		</div>
	    </div>
	</div>
    </div>
</div>