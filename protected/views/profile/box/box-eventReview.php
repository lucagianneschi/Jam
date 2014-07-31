<?php
/* box review eventi
 * box chiamato tramite load con:
 * data: {data: data, typeUser: typeUser},
 * 
 * box per tutti gli utenti, su spotter non viene visualizzato l'autore 
 */


$id = $_POST['id'];
$type = $_POST['type'];
$reviews = ReviewEvent::model()->profile($id, $type, 3, 0);

if ($reviews) {
    $currentUserId = $_SESSION['id'];
    $reviewCounter = count($reviews);
    ?>
    <!--Reviews-->
    <div class="row" id="social-EventReview">
        <div  class="large-12 columns">
    	<div class="row">
    	    <div  class="large-5 columns">
    		<h3><?php echo Yii::t('string', 'view.profile.eventReview.title'); ?></h3>
    	    </div>	
    	    <div  class="large-7 columns align-right">
		    <?php
		    if ($reviewCounter > 1) {
			?>
			<div class="row">					
			    <div  class="small-9 columns">
				<a class="slide-button-prev _prevPage slide-button-prev-disabled" onclick="royalSlidePrev(this, 'eventReview')"><?php echo Yii::t('string', 'view.prev'); ?> </a>
			    </div>
			    <div  class="small-3 columns">
				<a class="slide-button-next _nextPage" onclick="royalSlideNext(this, 'eventReview')"><?php echo Yii::t('string', 'view.next'); ?> </a>
			    </div>
			</div>
			<?php
		    }
		    ?>
    	    </div>	
    	</div>	
    	<div class="row  ">
    	    <div  class="large-12 columns ">
    		<div class="box" style="padding: 15px !important">
    		    <div class="royalSlider contentSlider  rsDefault" id="eventReviewSlide">
			    <?php
			    if ($reviewCounter > 0) {
				foreach ($reviews as $key => $value) {
				    $eventReview_objectId = $value['id'];
				    if ($type == 'SPOTTER') {
					$eventReview_user_objectId = $value['event']['fromuser']['id'];
					$eventReview_user_thumbnail = $value['event']['fromuser']['thumbnail'];
					$eventReview_user_username = $value['event']['fromuser']['username'];
					$eventReview_user_type = $value['event']['fromuser']['type'];
				    } else {
					$eventReview_user_objectId = $value['fromuser']['id'];
					$eventReview_user_thumbnail = $value['fromuser']['thumbnail'];
					$eventReview_user_username = $value['fromuser']['username'];
					$eventReview_user_type = $value['fromuser']['type'];
				    }
				    $eventReview_thumbnailCover = $value['event']['thumbnail'];
				    $event_objectId = $value['event']['id'];
				    $eventReview_title = $value['title'];
				    #TODO
				    $eventReview_rating = $value['vote'];
				    $eventReview_data = ucwords(strftime("%A %d %B %Y - %H:%M", strtotime($value['createdat'])));
				    $eventReview_text = $value['text'];
				    $eventReview_love = $value['lovecounter'];
				    $eventReview_comment = $value['commentcounter'];
				    $eventReview_share = $value['sharecounter'];

				    if (existsRelation($connectionService, 'user', $currentUserId, 'comment', $eventReview_objectId, 'LOVE')) {
					$css_love = '_love orange';
					$text_love = Yii::t('string', 'view.unlove');
				    } else {
					$css_love = '_unlove grey';
					$text_love = Yii::t('string', 'view.love');
				    }
				    ?>
	    			<div  class="rsContent">	
	    			    <div id='eventReview_<?php echo $eventReview_objectId ?>'>	
					    <?php
					    if ($type != "SPOTTER") {
						$fileManagerService = new FileManagerService();
						$pathUser = $fileManagerService->getUserAvatarPath($eventReview_user_objectId, $eventReview_user_thumbnail, true);
						$pathEvent = $fileManagerService->getEventCoverPath($currentUserId, $eventReview_thumbnailCover, true);
						?>
						<a href="profile.php?user=<?php echo $eventReview_user_objectId ?>">
						    <div class="row">
							<div  class="small-1 columns ">
							    <div class="userThumb">
								<img src="<?php echo $pathUser; ?>" onerror="this.src='<?php echo Yii::app()->params['defaultImages']['DEFTHUMBSPOTTER']; ?>'" alt="<?php echo $eventReview_user_username; ?>">
							    </div>
							</div>
							<div  class="small-5 columns">
							    <div class="text grey" style="margin-left: 20px;"><strong><?php echo $eventReview_user_username ?></strong></div>
							</div>
							<div  class="small-6 columns" style="text-align: right;">
							    <div class="note grey-light">
								<?php echo $eventReview_data; ?>
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
	    				<a href="event.php?event=<?php echo $eventReview_objectId ?>" >
	    				    <div class="row">
	    					<div  class="small-2 columns ">
	    					    <div class="coverThumb"><img src="<?php echo $pathEvent; ?>" onerror="this.src='<?php echo DEFEVENTTHUMB; ?>'" alt="<?php echo $eventReview_title; ?>"></div>						
	    					</div>
	    					<div  class="small-10 columns ">
	    					    <div class="row ">							
	    						<div  class="small-12 columns ">
	    						    <div class="sottotitle grey-dark"><?php echo $eventReview_title ?></div>
	    						</div>	
	    					    </div>	
	    					    <div class="row">						
	    						<div  class="small-12 columns ">
	    						    <div class="note grey"><?php echo Yii::t('string', 'view.profile.eventReview.rating'); ?></div>
	    						</div>
	    					    </div>
	    					    <div class="row ">						
	    						<div  class="small-12 columns ">
								<?php
								for ($index = 1; $index <= 5; $index++) {
								    if ($index <= $eventReview_rating) {
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
							<?php echo $eventReview_text; ?>
	    					</div>
	    					<a href="#" class="orange no-display viewText"><strong onclick="toggleText(this, 'eventReview_<?php echo $eventReview_objectId ?>', '<?php echo $eventReview_text ?>')"><?php echo Yii::t('string', 'view.viewall'); ?></strong></a>
	    					<a href="#" class="orange no-display closeText"><strong onclick="toggleText(this, 'eventReview_<?php echo $eventReview_objectId ?>', '<?php echo $eventReview_text ?>')"><?php echo Yii::t('string', 'view.close'); ?></strong></a>
	    				    </div>
	    				</div>
	    				<div class="row">
	    				    <div  class="large-12 columns">
	    					<div class="line"></div>
	    				    </div>
	    				</div>
	    				<div class="row recordReview-propriety">
	    				    <div class="box-propriety">
	    					<div class="small-7 columns ">
	    					    <a class="note grey" onclick="love(this, 'comment', '<?php echo $eventReview_objectId; ?>', '<?php echo $objectIdUser; ?>')"><?php echo $text_love ?></a>
	    					    <a class="note grey" onclick="loadBoxOpinion('<?php echo $eventReview_objectId; ?>', '<?php echo $eventReview_user_objectId; ?>', 'comment', '#social-EventReview .box-opinion', 10, 0)"><?php echo Yii::t('string', 'view.comment'); ?></a>
	    					    <a class="note grey" onclick="share(this, '<?php echo $eventReview_objectId; ?>', 'social-EventReview')"><?php echo Yii::t('string', 'view.share'); ?></a>
	    					</div>
	    					<div class="small-5 columns propriety ">					
	    					    <a class="icon-propriety <?php echo $css_love ?>" ><?php echo $eventReview_love ?></a>
	    					    <a class="icon-propriety _comment" ><?php echo $eventReview_comment ?></a>
	    					    <a class="icon-propriety _share" ><?php echo $eventReview_share ?></a>
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
					<div  class="large-12 columns grey"><?php echo Yii::t('string', 'view.profile.eventReview.nodata'); ?></div>
				    </div>
				</div>
				<?php
			    }
			    ?>
    		    </div>	
    		</div>
    		<!--comment-->
    		<div class="box-opinion no-display" ></div>				
    	    </div>
    	</div>
        </div>
    </div>
    <?php
}
?>