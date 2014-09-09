<?php
/* box comment
 * box chiamato tramite load con:
 * data: {data,typeuser}
 * @todo : passare l'oggetto del quale si cerca il commento, per ora è impostato 
 * ad event
 */

$id = $_POST['id'];
$fromUserObjectId = $_POST['fromUserObjectId'];
$limit = $_POST['limit'];
$skip = $_POST['skip'];
$commentToShow = 3;
$comments = Comment::model()->anyPage($id, 'event', $limit, $skip);

if ($comments || isset($_SESSION['id'])) {
    $currentUserId = $_SESSION['id'];
    $commentcounter = count($comments);
    ?>
    <div class="row" id="social-Comment <?php echo $id; ?>">
        <div  class="large-12 columns">
    	<h3><?php echo Yii::t('string', 'view.media.comment.title'); ?></h3>
    	<div class="row ">
    	    <div  class="large-12 columns ">
    		<div class="row  ">
    		    <div  class="large-12 columns ">
    			<form action="" class="box-write" onsubmit="sendComment('<?php echo $fromUserObjectId; ?>', $('#commentEvent_<?php echo $id; ?>').val(), '<?php echo $id; ?>', 'Event', 'box-comment', '<?php echo $limit; ?>', '<?php echo $skip; ?>');
    				return false;">
    			    <div class="">
    				<div class="row  ">
    				    <div  class="small-9 columns ">
    					<input id="commentEvent_<?php echo $id; ?>" type="text" class="comment inline" placeholder="<?php echo Yii::t('string', 'view.comment.write'); ?>" />
    				    </div>
    				    <div  class="small-3 columns ">
    					<input type="button" class="post-button inline" value="<?php echo Yii::t('string', 'view.comment'); ?>" onclick="sendComment('<?php echo $fromUserObjectId; ?>', $('#commentEvent_<?php echo $id; ?>').val(), '<?php echo $id; ?>', 'Event', 'box-comment', '<?php echo $limit; ?>', '<?php echo $skip; ?>')"/>
    				    </div>
    				</div>
    			    </div>
    			</form>
    		    </div>
    		</div>
		    <?php
		    $comment_limit_count = $commentcounter > $limit ? $limit : $commentcounter;
		    $comment_other = $comment_limit_count >= $commentcounter ? 0 : ($commentcounter - $comment_limit_count);
		    if ($commentcounter > 0) {
			$indice = 1;
			foreach ($comments as $key => $value) {
			    $comment_user_objectId = $value['fromuser']['id'];
			    $comment_user_thumbnail = $value['fromuser']['thumbnail'];
			    $comment_user_username = $value['fromuser']['username'];
			    $comment_user_type = $value['fromuser']['type'];
			    $comment_objectId = $value['id'];
			    $comment_data = ucwords(strftime("%A %d %B %Y - %H:%M", $value['createdat']->getTimestamp()));
			    $comment_text = $value['text'];
			    #TODO
			    //$comment_rating = $value->getRating();
			    $comment_counter_love = $value['lovecounter'];
			    $comment_counter_comment = $value['commentcounter'];
			    $comment_counter_share = $value['sharecounter'];
			    switch ($value['fromuser']['type']) {
				case 'JAMMER':
				    $defaultThum = Yii::app()->params['defaultImages']['DEFTHUMBJAMMER'];
				    break;
				case 'VENUE':
				    $defaultThum = Yii::app()->params['defaultImages']['DEFTHUMBVENUE'];
				    break;
				case 'SPOTTER':
				    $defaultThum = Yii::app()->params['defaultImages']['DEFTHUMBSPOTTER'];
				    break;
			    }
			    if (existsRelation('user', $currentUserId, 'comment', $comment_objectId, 'LOVE')) {
				$css_love = '_love orange';
				$text_love = Yii::t('string', 'view.unlove');
			    } else {
				$css_love = '_unlove grey';
				$text_love = Yii::t('string', 'view.love');
			    }
			    ?>				
	    		<div id='<?php echo $comment_objectId; ?>'>
	    		    <div class="box" style="padding: 15px !important;padding-bottom: 10px !important;">
	    			<a href="profile.php?user=<?php echo $comment_user_objectId ?>">
	    			    <div class="row  line" style="padding-bottom: 10px !important;padding-right: 20px !important;">
	    				<div  class="small-1 columns ">
	    				    <div class="icon-header">
	    					<!-- THUMB USER-->
						    <?php
						    $fileManagerService = new FileManagerService();
						    $thumbPath = $fileManagerService->getUserAvatarPath($comment_user_objectId, $comment_user_thumbnail, true);
						    ?>
	    					<img src="<?php echo $thumbPath; ?>" onerror="this.src='<?php echo $defaultThum; ?>'" alt ="<?php echo $comment_user_username; ?> ">
	    				    </div>
	    				</div>
	    				<div  class="small-5 columns" style="padding-left: 20px;">
	    				    <div class="text grey" style="margin-bottom: 0px;">
	    					<strong><?php echo $comment_user_username; ?></strong>
	    				    </div>
	    				    <div class="note orange">
	    					<strong><?php echo $comment_user_type ?></strong>
	    				    </div>
	    				</div>
	    				<div  class="small-6 columns propriety">
	    				    <div class="note grey-light">
						    <?php echo $comment_data; ?>
	    				    </div>
	    				</div>
	    			    </div>
	    			</a>
	    			<div class="row  line">
	    			    <div  class="small-12 columns ">
	    				<div class="row ">
	    				    <div  class="small-12 columns ">
	    					<div class="text grey" style="padding-top: 10px;">
							<?php echo $comment_text; ?>	
	    					</div>
	    				    </div>
	    				</div>

	    			    </div>
	    			</div>
	    			<div class="row">
	    			    <div class="box-propriety">
	    				<div class="small-5 columns ">
	    				    <a class="note grey " onclick="love(this, 'Comment', '<?php echo $comment_objectId; ?>', '<?php echo $currentUserId; ?>');"><?php echo $text_love; ?></a>
	    				</div>
	    				<div class="small-5 columns propriety ">
	    				    <a class="icon-propriety <?php echo $css_love; ?>"><?php echo $comment_counter_love; ?></a>
	    				</div>
	    			    </div>
	    			</div>
	    		    </div> <!--BOX-->	
	    		</div>
			    <?php
			    if ($indice == $comment_limit_count)
				break;
			    $indice++;
			}
		    }
		    if ($comment_other > 0) {
			?>
			<div class="row otherSet">
			    <div class="large-12 colums">
				<?php
				$nextToShow = ($commentcounter - $limit > $commentToShow) ? $commentToShow : $commentcounter - $limit;
				?>
				<div class="text" onclick="loadBoxComment(<?php echo $limit + $commentToShow; ?>, 0);"><?php echo Yii::t('string', 'view.media.other'); ?><?php echo $nextToShow; ?><?php echo Yii::t('string', 'view.media.comment'); ?></div>	
			    </div>
			</div>
			<?php
		    }
		    if ($commentcounter == 0) {
			?>
			<div class="box">	
			    <div class="row">
				<div  class="large-12 columns ">
				    <p class="grey"><?php echo Yii::t('string', 'view.media.comment.nodata'); ?></p>
				</div>
			    </div>
			</div>
			<?php
		    }
		    ?>
    	    </div>
    	</div>
        </div>
    </div>
    <?php
}