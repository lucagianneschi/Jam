<?php
/* box status utente 
 * box chiamato tramite load con:
 * data: {data,typeCurrentUser}, 
 */
if (existsRelation('user', $currentUser['id'], 'event', $event['id'], 'LOVE')) {
    $css_love = '_love orange';
    $text_love = Yii::t('string', 'views.unlove');
} else {
    $css_love = '_unlove grey';
    $text_love = Yii::t('string', 'views.love');
}
?>
<div id="social-status">
    <!-- div class="row">
	    <div class="small-8 columns">
		    <h3><strong><?php echo $event['reviewcounter']; ?> <?php echo Yii::t('string', 'views.review'); ?></strong></h3>
	    </div>
	    <div class="small-4 columns">
		    <p class="grey" style="float: right;">Spotter Rating</p>		
		    <form id="rating" style="float: right;">
			<input class="star required" type="radio" name="test-1-rating-5" value="1" checked="checked"/>
			<input class="star" type="radio" name="test-1-rating-5" value="2" checked="checked"/>
			<input class="star" type="radio" name="test-1-rating-5" value="3" checked="checked"/>
			<input class="star" type="radio" name="test-1-rating-5" value="4"/>
			<input class="star" type="radio" name="test-1-rating-5" value="5"/>
		    </form>
	    </div>
    </div -->
    <div class="row">
	<div  class="large-12 columns"><div class="line"></div></div>
    </div>
    <div class="row recordReview-propriety">
	<div class="box-propriety">
	    <div class="small-7 columns ">
		<a class="note grey" onclick="love(this, 'Event', '<?php echo $event['id']; ?>', '<?php echo $currentUser['id']; ?>');"><?php echo $text_love; ?></a>
		<a class="note grey" onclick="setCounter()"><?php echo Yii::t('string', 'view.comment'); ?></a>
		<a class="note grey" onclick="share()"><?php echo Yii::t('string', 'views.share'); ?></a>
	    </div>
	    <div class="small-5 columns propriety ">					
		<a class="icon-propriety <?php echo $css_love; ?>"><?php echo $event['lovecounter']; ?></a>
		<a id="commentCounter" class="icon-propriety _comment"><?php echo $event['commentcounter']; ?></a>
		<a class="icon-propriety _share"><?php echo $event['sharecounter']; ?></a>
	    </div>	
	</div>		
    </div>
    <div class="row">
	<div  class="large-12 columns"><div class="line"></div></div>
    </div>
</div>
<?php
if (strtoupper($currentUser['type']) == 'SPOTTER') {
    ?>
    <div class="row ">
        <div  class="large-12 columns">
    	<div class="status-button">
    	    <a href="uploadReview.php?rewiewId=<?php echo $event['id'] ?>&type=Event" class="button bg-orange">
    		<div class="icon-button _follower_status"><?php echo Yii::t('string', 'view.media.addreview'); ?></div>
    	    </a>
    	</div>
        </div>
    </div>
    <?php
}