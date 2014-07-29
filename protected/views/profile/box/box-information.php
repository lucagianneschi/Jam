<?php
/*
 * Contiene il box information dell'utente
 * Il contenuto varia a seconda del tipo di utente:
 * spotter: abount
 * jammer: abount e member
 * venue: abount e map
 * 
 * box chiamato tramite load con:
 * data: array conente infomazoini di tipo userInfo, 
 * 
 * 
 */

$type = $user['type'];
$information_description = $user['description'] != '' ? '<div class="content" data-section-content>' : '<div class="no-display">';
$information_pin = $user['city'] == '' ? '' : '_pin-white';
#TODO
/*
  if($type != 'VENUE') {
  $information_note = $data['music'] == '' ? '' : '_note-white';
  }
 */

function noDisplay($dato) {
    return $dato == '' ? 'no-display' : '';
}
?>
<!--INFORMATION-->
<div class="row" id="profile-information">
    <div class="large-12 columns">
	<h3><?php echo Yii::t('string', 'view.profile.info.title'); ?></h3>		
	<div class="section-container accordion" data-section="accordion">
	    <section class="active" >
		<!--------------------------------- ABOUT ---------------------------------------------------->
		<p class="title" data-section-title onclick="removeMap()"><a href="#"><?php echo Yii::t('string', 'view.profile.info.content1'); ?></a></p>
		<?php echo $information_description; ?>
		<p class="text grey"><?php echo $user['description']; ?></p> 
	</div>
	<div class="content" data-section-content>
	    <div class="row">
		<div class="small-6 columns">				
		    <a class="ico-label white breakOff <?php echo noDisplay($user['city']); ?><?php echo $information_pin; ?>"><?php echo $user['city']; ?></a>
		    <a class="ico-label grey breakOff <?php echo noDisplay($user['address']); ?>" id="information-address"><?php echo $user['address']; ?></a>
		    <!-- TODO -->
	    <!-- a class="ico-label white breakOff<?php echo $information_note; ?>"><?php // echo $user->getMusic(); ?></a -->
		</div>
		<div class="small-6 columns">
		    <div class="row <?php echo noDisplay($user['facebookpage']); ?>">
			<div class="small-12 columns">
			    <a style="max-width: 210px;" href="<?php echo $user['facebookpage']; ?>"  class="ico-label _facebook breakOff" ><?php echo $user['facebookpage']; ?></a>
			</div>
		    </div>
		    <div class="row <?php echo noDisplay($user['twitterpage']); ?>">
			<div class="small-12 columns">
			    <a style="max-width: 210px;" href="<?php echo $user['twitterpage']; ?>" class="ico-label _twitter breakOff"><?php echo $user['twitterpage']; ?></a>
			</div>	
		    </div>
		    <div class="row  <?php echo noDisplay($user['googlepluspage']); ?>">
			<div class="small-12 columns">
			    <a style="max-width: 210px;" href="<?php echo $user['googlepluspage']; ?>" class="ico-label _google breakOff"><?php echo $user['googlepluspage']; ?></a>
			</div>	
		    </div>
		    <div class="row  <?php echo noDisplay($user-['youtubechannel']); ?>">
			<div class="small-12 columns">
			    <a style="max-width: 210px;" href="<?php echo $user['youtubechannel']; ?>" class="ico-label _youtube breakOff"><?php echo $user['youtubechannel']; ?></a>
			</div>	
		    </div>
		    <div class="row  <?php echo noDisplay($user['website']); ?>">
			<div class="small-12 columns">
			    <a style="max-width: 210px;"href="<?php echo $user['website']; ?>" class="ico-label _web breakOff"><?php echo $user['website']; ?></a>
			</div>	
		    </div>
		</div>					
	    </div>
	</div>	    
	</section>
	<?php
	if ($type == 'JAMMER') {
		#TODO
		/*
	    ?>
    	<!--------------------------------------- MEMBRES --------------------------------------->
	    <?php
	    if (is_array($user->getMembers()) && count($user->getMembers()) > 0) {
		?>
		<section>
		    <p class="title" data-section-title><a href="#"><?php echo $views['information']['content2']; ?></a></p>
		    <div class="content" data-section-content>

			<?php
			$i = 0;
			foreach ($user->getMembers() as $key => $value) {
			    if ($i % 2 == 0) {
				?> <div class="row"> <?php }
			    ?>
	    		    <div class="small-6 columns">
	    			<div class="box-membre">
	    			    <span class="text white"><?php echo $value->name; ?></span></br>
	    			    <span class="note grey"><?php echo $value->instrument; ?></span>
	    			</div>
	    		    </div>		

				<?php if (($i + 1) % 2 == 0 || ($i + 1) == count($user->getMembers())) { ?> </div>  <?php
			    }
			    $i++;
			}
			?>				
		    </div>
		</section>
		<?php
	    }
		 * */
		
	}
	// su utente e' tipo venue allora viene mostrato il section del map
	if ($type == 'VENUE') {
		$lat = $user['latitude'];
		$lng = $user['longitude'];
	    ?>
    	<!--------------------------------------- MAP --------------------------------------->
    	<section id="profile_map_venue" > 
    	    <p class="title" data-section-title onclick="viewMap('<?php echo $lat ?>', '<?php echo $lng ?>')"><a href="#"><?php echo Yii::t('string', 'view.profile.info.content3'); ?></a></p>
    	    <div class="content" data-section-content>
    		<div class="row">
    		    <div class="small-12 columns">     					  	
    			<div  id="map_venue"></div>	
    		    </div>
    		</div>
    		<!--div class="row">
    		    <div class="small-12 columns ">
    			<a class="ico-label _pin white " onclick="getDirectionMap()"><?php echo Yii::t('string', 'view.profile.info.content3_direction'); ?></a> 
    		    </div>
    		</div-->				 	
    	    </div>
    	</section>
	    <?php
	}
	?>	
    </div>
</div>
</div>