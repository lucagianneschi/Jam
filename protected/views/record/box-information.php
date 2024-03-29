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


$id = $record['id'];
$city = $record['city'];
$year = $record['year'];
$label = $record['label'];
$buylink = $record['buylink'];
$description = $record['description'];
$fromUserObjectId = $record['fromuser']['id'];
$fromUserThumbnail = $record['fromuser']['thumbnail'];
$fromUserUsername = $record['fromuser']['username'];

$css_city = (!isset($city) || $city == '') ? 'no-display' : '';
$css_year = (!isset($year) || $year == '') ? 'no-display' : '';
$css_label = (!isset($label) || $label == '') ? 'no-display' : '';
$css_buylink = (!isset($buylink) || $buylink == '') ? 'no-display' : '';
$css_description = (!isset($description) || $description == '') ? 'no-display' : '';

$fileManagerService = new FileManagerService();
$thumbPath = $fileManagerService->getUserAvatarPath($fromUserObjectId, $fromUserThumbnail, true);
?>
<!--INFORMATION-->
<div class="row" id="profile-information">
    <div class="large-12 columns">
	<h3><?php echo Yii::t('string', 'view.media.info.title'); ?></h3>		
	<div class="section-container accordion" data-section="accordion">
	    <section class="active" >
		<!--ABOUT-->
		<p class="title" data-section-title onclick="removeMap()"><a href="#"><?php echo Yii::t('string', 'view.media.info.content1_record'); ?></a></p>
		<div class="content" data-section-content>
		    <a href="profile.php?user=<?php echo $fromUserObjectId ?>">
			<div class="row " style="cursor: pointer" id="user_<?php echo $fromUserObjectId; ?>">
			    <div class="small-1 columns ">
				<div class="icon-header">
				    <img src="<?php echo $thumbPath; ?>" onerror="this.src='<?php echo Yii::app()->params['defaultImages']['DEFTHUMBJAMMER']; ?>'" alt ="<?php echo $fromUserUsername; ?> ">
				</div>
			    </div>
			    <div  class="small-11 columns ">
				<div class="text white breakOffTest"><strong><?php echo $fromUserUsername ?></strong></div>
			    </div>		
			</div>
		    </a>
		</div>	
		<div class="content" data-section-content>
		    <div class="row">
			<div class="small-12 columns">
			    <div class="row">
				<div class="small-12 columns">				
				    <a class="ico-label white breakOff _pin-white <?php echo $css_city ?>"><?php echo $city; ?></a>
				    <a class="ico-label white breakOff _calendar <?php echo $css_year ?>"><?php echo $year; ?></a>
				</div>
			    </div>
			    <div class="row">
				<div class="small-12 columns">
				    <a class="ico-label white breakOff _tag <?php echo $css_label ?>"><?php echo $label; ?></a>		    								    					
				</div>
			    </div>
			</div>

		    </div>
		</div>
		<div class="content <?php echo $css_buylink ?>" data-section-content>
		    <div class="row">
			<div class="small-12 columns">
			    <div class="text orange"><span class="white"><?php echo Yii::t('string', 'view.media.record.buy'); ?></span> <a class="orange" href="<?php echo $buylink; ?>"><?php echo $buylink; ?></a></div>		    								    					
			</div>
		    </div> 
		</div>
		<div class="content <?php echo $css_description ?>" data-section-content>
		    <p class="text grey">
			<?php echo $description; ?>
		    </p> 
		</div>
	    </section>
	    <!--FEATURING - PERFORMED BY-->
	    <section id='box-informationFeaturing'></section>
	    <script type="text/javascript">
		    function loadBoxInformationFeaturing() {
			var json_data = {};
			json_data.id = '<?php echo $id; ?>';
			$.ajax({
			    type: "POST",
			    url: "views/recordPage/box/box-informationFeaturing.php",
			    data: json_data,
			    beforeSend: function(xhr) {
				//spinner.show();
				console.log('Sono partito informationFeaturing');
			    }
			}).done(function(message, status, xhr) {
			    //spinner.hide();
			    $("#box-informationFeaturing").html(message);
			    code = xhr.status;
			    //console.log("Code: " + code + " | Message: " + message);
			    console.log("Code: " + code + " | Message: <omitted because too large>");
			}).fail(function(xhr) {
			    //spinner.hide();
			    message = $.parseJSON(xhr.responseText).status;
			    code = xhr.status;
			    console.log("Code: " + code + " | Message: " + message);
			});
		    }
	    </script>
	</div>
    </div>
</div>