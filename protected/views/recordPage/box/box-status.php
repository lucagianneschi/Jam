<?php
/* box status utente 
 * box chiamato tramite load con:
 * data: {data,typeCurrentUser}, 
 * 
 * 
 */


if (existsRelation($connectionService,'user', $currentUser['id'], 'record', $record['id'], 'LOVE')) {
    $css_love = '_love orange';
    $text_love = Yii::t('string', 'view.unlove');
} else {
    $css_love = '_unlove grey';
    $text_love = Yii::t('string', 'view.love');
}
?>
<!--STATUS-->

<script src='resources/javascripts/plugins/rating/jquery.rating.js' type="text/javascript" language="javascript"></script>

<div id="social-status">
    <!-- l'implementazione del rating verrà fatta in un secondo momento -->
    <!--div class="row">
	    <div class="small-8 columns">			
		    <h3><strong>4 review</strong></h3>					
	    </div>
	    <div class="small-4 columns">
		    <p class="grey">Spotter Rating</p>		
		    <form id="rating">
			<input class="star required" type="radio" name="test-1-rating-5" value="1" checked="checked"/>
			<input class="star" type="radio" name="test-1-rating-5" value="2" checked="checked"/>
			<input class="star" type="radio" name="test-1-rating-5" value="3" checked="checked"/>
			<input class="star" type="radio" name="test-1-rating-5" value="4"/>
			<input class="star" type="radio" name="test-1-rating-5" value="5"/>
		    </form>
	    </div>
    </div-->

    <div class="row">
	<div  class="large-12 columns"><div class="line"></div></div>
    </div>

    <div class="row recordReview-propriety">
	<div class="box-propriety">
	    <div class="small-7 columns ">
		<a class="note grey" onclick="love(this, 'Record', '<?php echo $record['id']; ?>', '<?php echo $currentUser['id']; ?>');"><?php echo $text_love; ?></a>
		<a class="note grey" onclick="setCounter()"><?php echo Yii::t('string', 'view.comment'); ?></a>
		<a class="note grey" onclick="share()"><?php echo Yii::t('string', 'views.share'); ?></a>
	    </div>
	    <div class="small-5 columns propriety ">					
		<a class="icon-propriety <?php echo $css_love; ?>"><?php echo $record['lovecounter']; ?></a>
		<a id="commentCounter" class="icon-propriety _comment"><?php echo $record['commentcounter']; ?></a>
		<a class="icon-propriety _share"><?php echo $record['sharecounter']; ?></a>
	    </div>	
	</div>		
    </div>
    <div class="row">
	<div  class="large-12 columns"><div class="line"></div></div>
    </div>
</div>
<?php if ($currentUser['type'] == 'SPOTTER') { ?>
    <div class="row ">
        <div  class="large-12 columns">
    	<div class="status-button">
    	    <a href='uploadReview.php?rewiewId=<?php echo $record['id'] ?>&type=Record' class="button bg-orange" ><div class="icon-button _follower_status"><?php echo Yii::t('string', 'view.media.addreview'); ?></div></a>
    	</div>
        </div>
    </div>
<?php } ?>