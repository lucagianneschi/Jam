<?php
/* box review RECORD
 * box chiamato tramite load con:
 * data: {data,typeUser}
 * 
 * box 
 */

$id = $_POST['id'];
$type = $_POST['type'];
$reviews = ReviewRecord::model()->profile($id, $type, 3, 0);

if ($reviews) {
    $currentUserId = $_SESSION['id'];
    $reviewCounter = count($reviews);
    ?>
    <!--Reviews-->
    <div class="row" id="social-RecordReview">
        <div  class="large-12 columns">	
    	<div class="row">
    	    <div  class="small-5 columns">
    		<h3><?php echo Yii::t('string', 'view.profile.recordReview.title'); ?></h3>
    	    </div>	
    	    <div  class="small-7 columns align-right">
		    <?php
		    if ($reviewCounter > 1) {
			?>
			<div class="row">					
			    <div  class="small-9 columns">
				<a class="slide-button-prev _prevPage slide-button-prev-disabled" onclick="royalSlidePrev(this, 'recordReview')"><?php echo Yii::t('string', 'view.prev'); ?> </a>
			    </div>
			    <div  class="small-3 columns">
				<a class="slide-button-next _nextPage" onclick="royalSlideNext(this, 'recordReview')"><?php echo Yii::t('string', 'view.next'); ?> </a>
			    </div>
			</div>
			<?php
		    }
		    ?>
    	    </div>	
    	</div>	
    	<div class="row">
    	    <div  class="large-12 columns ">
    		<div class="box" style="padding: 15px !important">
    		    <div class="royalSlider contentSlider  rsDefault" id="recordReviewSlide">				
			    <?php
			    if ($reviewCounter > 0) {
				foreach ($reviews as $key => $value) {
				    $recordReview_objectId = $value['id'];
				    $recordReview_user_objectId = $value['fromuser']['id'];
				    $recordReview_user_thumbnail = $value['fromuser']['thumbnail'];
				    $recordReview_user_username = $value['fromuser']['username'];
				    $recordReview_user_type = $value['fromuser']['type'];
				    $recordReview_thumbnailCover = $value['record']['thumbnail'];
				    $recordObjectId = $value['record']['id'];
				    $recordReview_title = $value['record']['title'];
				    $recordReview_data = ucwords(strftime("%A %d %B %Y - %H:%M", strtotime($value['createdat'])));
				    $recordReview_rating = $value['vote'];
				    $recordReview_text = $value['text'];
				    $recordReview_love = $value['lovecounter'];
				    $recordReview_comment = $value['commentcounter'];
				    $recordReview_share = $value['sharecounter'];

				    if (existsRelation($connectionService, 'user', $currentUserId, 'comment', $recordReview_objectId, 'LOVE')) {
					$css_love = '_love orange';
					$text_love = Yii::t('string', 'view.unlove');
				    } else {
					$css_love = '_unlove grey';
					$text_love = Yii::t('string', 'view.love');
				    }
				    ?>
	    			<div  class="rsContent">	
	    			    <div id='recordReview_<?php echo $recordReview_objectId ?>'>
					    <?php
					    if ($type != 'SPOTTER') {
						switch ($recordReview_user_type) {
						    case 'JAMMER':
							$defaultThum = Yii::app()->params['defaultImages']['DEFTHUMBJAMMER'];
							break;
						    case 'VENUE':
							$defaultThum = Yii::app()->params['defaultImages']['DEFTHUMBVENUE'];
							break;
						}
						$fileManagerService = new FileManagerService();
						$pathUser = $fileManagerService->getUserAvatarPath($recordReview_user_objectId, $recordReview_user_thumbnail, true);
						$pathRecord = $fileManagerService->getUserAvatarPath($currentUserId, $recordReview_thumbnailCover, true);
						?>
						<a href="profile.php?user=<?php echo $recordReview_user_objectId ?>">	
						    <div class="row">
							<div  class="small-1 columns ">
							    <div class="userThumb">
								<img src="<?php echo $pathUser; ?>" onerror="this.src='<?php echo $defaultThum; ?>'" alt="<?php echo $recordReview_user_username; ?>">
							    </div>
							</div>
							<div  class="small-5 columns">
							    <div class="text grey" style="margin-left: 20px;"><strong><?php echo $recordReview_user_username ?></strong></div>
							</div>
							<div  class="small-6 columns" style="text-align: right;">
							    <div class="note grey-light">
								<?php echo $recordReview_data; ?>
							    </div>
							</div>		
						    </div>
						</a>	
						<div class="row">
						    <div  class="large-12 columns"><div class="line"></div></div>
						</div>
						<?php
					    }
					    ?>
	    				<a href="record.php?record=<?php echo $recordObjectId ?>">
	    				    <div class="row">
	    					<div  class="small-2 columns ">
	    					    <div class="coverThumb"><img src="<?php echo $pathRecord; ?>" onerror="this.src='<?php Yii::app()->params['defaultImages']['DEFRECORDTHUMB']; ?>'" alt="<?php echo $recordReview_title; ?>"></div>						
	    					</div>
	    					<div  class="small-10 columns ">
	    					    <div class="row ">							
	    						<div  class="small-12 columns ">
	    						    <div class="sottotitle grey-dark"><?php echo $recordReview_title ?></div>
	    						</div>	
	    					    </div>	
	    					    <div class="row">						
	    						<div  class="small-12 columns ">
	    						    <div class="note grey"><?php echo Yii::t('string', 'view.profile.recordReview.rating'); ?></div>
	    						</div>
	    					    </div>
	    					    <div class="row ">						
	    						<div  class="small-12 columns ">
								<?php
								for ($index = 1; $index <= 5; $index++) {
								    if ($index <= $recordReview_rating) {
									echo '<a class="icon-propriety _star-orange"></a>';
								    } else {
									echo '<a class="icon-propriety _star-grey"></a>';
								    }
								}
								?>
	    						</div>
	    					    </div>													
	    					</div>
	    				    </div>
	    				</a>
	    				<div class="row " style=" margin-top:10px;">						
	    				    <div  class="small-12 columns ">
	    					<div class="text grey cropText inline" style="line-height: 18px !important;">
							<?php echo $recordReview_text; ?>
	    					</div>
	    					<a href="#" class="orange no-display viewText"><strong onclick="toggleText(this, 'recordReview_<?php echo $recordReview_objectId ?>', '<?php echo $recordReview_text ?>')"><?php echo Yii::t('string', 'view.viewall'); ?></strong></a>
	    					<a href="#" class="orange no-display closeText"><strong onclick="toggleText(this, 'recordReview_<?php echo $recordReview_objectId ?>', '<?php echo $recordReview_text ?>')"><?php echo Yii::t('string', 'view.close'); ?></strong></a>
	    				    </div>
	    				</div>	
	    				<div class="row">
	    				    <div  class="large-12 columns"><div class="line"></div></div>
	    				</div>
	    				<div class="row recordReview-propriety">
	    				    <div class="box-propriety">
	    					<div class="small-6 columns ">
	    					    <a class="note grey" onclick="love(this, 'Comment', '<?php echo $recordReview_objectId; ?>', '<?php echo $objectIdUser; ?>')"><?php echo $text_love; ?></a>
	    					    <a class="note grey" onclick="loadBoxOpinion('<?php echo $recordReview_objectId; ?>', '<?php echo $recordReview_user_objectId; ?>', 'Comment', '#social-RecordReview .box-opinion', 10, 0)"><?php echo Yii::t('string', 'view.comment'); ?></a>
	    					    <a class="note grey" onclick="share(this, '<?php echo $recordReview_objectId; ?>', 'social-RecordReview')"><?php echo Yii::t('string', 'view.share'); ?> </a>
	    					</div>
	    					<div class="small-6 columns propriety ">					
	    					    <a class="icon-propriety <?php echo $css_love; ?>" ><?php echo $recordReview_love ?></a>
	    					    <a class="icon-propriety _comment" ><?php echo $recordReview_comment ?></a>
	    					    <a class="icon-propriety _share" ><?php echo $recordReview_share ?></a>
	    					</div>	
	    				    </div>		
	    				</div>

	    			    </div>	
	    			</div>	
				    <?php
				}
			    } else {
				?>
				<div  class="rsContent">	
				    <div class="row">
					<div  class="large-12 columns grey"><?php echo Yii::t('string', 'view.profile.recordReview.nodata'); ?></div>
				    </div>
				</div>			
				<?php
			    }
			    ?>
    		    </div>
    		</div>
    		<!---------------------------------------- comment ------------------------------------------------->
    		<div class="box-opinion no-display"></div>
    	    </div>
    	</div>
        </div>
    </div>
    <?php
}
?>