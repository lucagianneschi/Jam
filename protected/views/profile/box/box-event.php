<?php
/* Box degli eventi, viene effettuata la chiamata a tale box solo se typeUser: jammer or venue
 * box chiamato tramite load con:
 * data: {data: data, typeUser: typeUser}
 * 
 * @data: array contenente tutti di dati relativi agli eventi
 * @typeUser: tipo utente (JAMMER, VENUE o SPOTTER)
 */

$events = Event::model()->profile($_POST['id'], 3, 0);
$typeUser = $_POST['typeUser'];

if ($events) {
    $currentUserId = $_SESSION['id'];
    $eventCounter = count($events);
    ?>
    <div class="row" id='profile-Event'>
        <div class="large-12 columns ">	
    	<div class="row">
    	    <div  class="small-5 columns">
    		<h3><?php echo Yii::t('string', 'view.profile.event.title'); ?> </h3>
    	    </div>	
    	    <div  class="small-7 columns align-right">
		    <?php
		    if ($eventCounter > 3) {
			?>
			<div class="row">					
			    <div  class="small-9 columns">
				<a class="slide-button-prev _prevPage slide-button-prev-disabled" onclick="royalSlidePrev(this, 'event')"><?php echo Yii::t('string', 'view.prev'); ?> </a>
			    </div>
			    <div  class="small-3 columns">
				<a class="slide-button-next _nextPage" onclick="royalSlideNext(this, 'event')"><?php echo Yii::t('string', 'view.next'); ?> </a>
			    </div>
			</div>
			<?php
		    }
		    ?>
    	    </div>
    	</div>		
    	<!--LISTA Event-->
    	<div class="box">
		<?php
		if ($eventCounter > 0) {
		    $index = 0;
		    ?>
		    <div class="royalSlider rsMinW>" id="eventSlide">					
			<?php
			$fileManagerService = new FileManagerService();
			foreach ($events as $key => $value) {
			    if ($index % 3 == 0) {
				?><div class="rsContent">	<?php
			    }
			    $event_thumbnail = $value['thumbnail'];
			    $event_id = $value['id'];
			    $event_locationName = $value['locationname'];
			    $event_title = $value['title'];
			    $event_featuring = "";
			    //TODO RECUPERARE FEATURING
			    $featurings = array();
			    //	$featuringsCounter = count($featurings);
			    $indexFeat = 0;
			    foreach ($featurings as $key1 => $feat) {
				if ($indexFeat == 0)
				    $event_featuring = $feat['username'];
				elseif ($indexFeat < 5) {
				    $event_featuring = $event_featuring + ', ' + $feat['username'];
				}
				else
				    $event_featuring = $feat['username'] . '...';
				$indexFeat++;
			    }

			    #TODO
			    /*
			      if(is_array($value->getfeaturing']) && count($value->getfeaturing'])>0){
			      foreach ($value->getfeaturing'] as $keyFeaturing => $valueFeaturing) {
			      $event_featuring = $event_featuring.' '.$value['username'];
			      }
			      }
			     */
			    $event_eventDate = ucwords(strftime("%A %d %B %Y - %H:%M", strtotime($value['eventdate'])));
			    $css_location = '';
			    if (is_null($value['city']) || $value['city'] == '') {
				if (is_null($value['address']) || $value['address'] == '' || $value['address'] == ', ') {
				    $event_location = '';
				    $css_location = 'no-display';
				}
				else
				    $event_location = $value['address'];
			    }else {
				if (is_null($value['address']) || $value['address'] == '' || $value['address'] == ', ')
				    $event_location = $value['city'];
				else
				    $event_location = $value['city'] . ' - ' . $value['address'];
			    }
			    $event_love = $value['lovecounter'];
			    $event_comment = $value['commentcounter'];
			    $event_review = $value['reviewcounter'];
			    $event_share = $value['sharecounter'];
			    $pathCoverEvent = $fileManagerService->getEventPhotoPath($_POST['id'], $event_thumbnail);
			
			    
			    if (existsRelation($connectionService, 'user', $currentUserId, 'event', $event_id, 'LOVE')) {
				$css_love = '_love orange';
				$text_love = Yii::t('string', 'view.unlove');
			    } else {
				$css_love = '_unlove grey';
				$text_love = Yii::t('string', 'view.love');
			    }
			    ?>
	    		    <!----------------------------------- SINGLE Event-->
	    		    <a href="event.php?event=<?php echo $event_id ?>">
	    			<div class="box-element" id='<?php echo $event_id ?>'>
	    			    <div class="row">
	    				<div class="small-4 columns" >
	    				    <img class="eventcover" src="<?php echo $pathCoverEvent; ?>" onerror="this.src='<?php echo Yii::app()->params['defaultImages']['DEFEVENTTHUMB']; ?>'" alt="<?php echo $event_title ?>">
	    				</div>
	    				<div class="small-8 columns" style="min-height: 130px;">
						<?php
						if ($typeUser == 'JAMMER') {
						    ?>
						    <div class="row">
							<div class="large-12 colums">
							    <div class="sottotitle white breakOffTest"><?php echo $event_locationName ?></div>
							</div>
						    </div>
						    <div class="row">
							<div class="large-12 colums">
							    <div class="sottotitle grey breakOffTest"><?php echo $event_title ?></div>
							</div>
						    </div>
						    <?php
						} else {
						    ?>	
						    <div class="row">
							<div class="large-12 colums">
							    <div class="sottotitle white breakOffTest"><?php echo $event_title ?></div>
							</div>
						    </div>
						    <?php
						}
						?>
	    				    <div class="row">
	    					<div class="large-12 colums">
	    					    <div class="sottotitle white breakOffTest"><?php echo $event_featuring ?></div>
	    					</div>
	    				    </div>
	    				    <div class="row">
	    					<div class="large-12 colums">
	    					    <a class="ico-label _calendar inline text grey breakOff"><?php echo $event_eventDate ?></a>
	    					</div>
	    				    </div>
						<?php
						if ($typeUser == 'JAMMER') {
						    ?>
						    <div class="row">
							<div class="large-12 colums">
							    <a class="ico-label _pin inline text grey breakOff <?php echo $css_location ?>"><?php echo $event_location ?></a>
							</div>
						    </div>	
						    <?php
						}
						?>
	    				    <div class="row">
	    					<div class="box-propriety ">					
	    					    <div class="small-7 columns no-display">
	    						<a class="icon-propriety _menu-small note orange "> <?php echo Yii::t('string', 'view.profile.event.calendar'); ?></a>	
	    						<a class="note grey " onclick="setCounter(this, '<?php echo $event_id; ?>', 'Event')"><?php echo $text_love ?></a>
	    						<a class="note grey" onclick="setCounter(this, '<?php echo $event_id; ?>', 'Event')"><?php echo Yii::t('string', 'view.comment'); ?></a>
	    						<a class="note grey" onclick="setCounter(this, '<?php echo $event_id; ?>', 'Event')"><?php echo Yii::t('string', 'view.share'); ?></a>
	    						<a class="note grey" onclick="setCounter(this, '<?php echo $event_id; ?>', 'Event')"><?php Yii::t('string', 'view.review'); ?></a>	
	    					    </div>
	    					    <div class="small-5 columns propriety " style="position: absolute;bottom: 0px;right: 0px;">					
	    						<a class="icon-propriety <?php echo $css_love ?>"><?php echo $event_love ?></a>
	    						<a class="icon-propriety _comment"><?php echo $event_comment ?></a>
	    						<a class="icon-propriety _share"><?php echo $event_share ?></a>
	    						<a class="icon-propriety _review"><?php echo $event_review ?></a>		
	    					    </div>
	    					</div>		
	    				    </div>
	    				</div>
	    			    </div>

	    			</div>					
	    		    </a>
				<?php if (($index + 1) % 3 == 0 || $eventCounter == $index + 1) { ?> </div> <?php
			    }
			    $index++;
			} //fine foreach
			?>
			<!--------------------------- FINE ------------------------------------------------>						
		    </div>
		    <?php
		} else {
		    ?>
		    <div class="row" style="padding-left: 20px !important; padding-top: 20px !important;}">
			<div  class="large-12 columns"><p class="grey"><?php echo Yii::t('string', 'view.profile.event.nodata'); ?></p></div>
		    </div>
		    <?php
		}
		?>
    	</div>
        </div>
    </div>	
    <?php
} else {
    echo 'Errore';
}
?>