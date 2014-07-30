<?php
/*
 * box album
 * box chiamato tramite load con:
 * data: {data: data, typeUser: id}
 * 
 * box per tutti gli utenti
 */

$objectIdUser = $_POST['objectIdUser'];

if (isset($_SESSION['id']))
    $currentUserId = $_SESSION['id'];
$albums = Album::model()->profileOrUpload($_POST['id']);
$albumCounter = count($albums);
$fileManagerService = new FileManagerService();
?>
<!-- Photography-->
<div class="row" id='profile-Album'>
    <div class="large-12 columns ">
	<div class="row">
	    <div  class="large-5 columns">
		<h3><?php echo Yii::t('string', 'view.profile.album.title'); ?></h3>
	    </div>	
	    <div  class="large-7 columns align-right" id="albumBottonSlide">
		<?php if ($albumCounter > 4) { ?>
    		<div class="row">					
    		    <div  class="small-9 columns">
    			<a class="slide-button-prev _prevPage slide-button-prev-disabled" onclick="royalSlidePrev(this, 'album')"><?php echo Yii::t('string', 'view.profile.prev'); ?> </a>
    		    </div>
    		    <div  class="small-3 columns">
    			<a class="slide-button-next _nextPage" onclick="royalSlideNext(this, 'album')"><?php echo Yii::t('string', 'view.profile.next'); ?> </a>
    		    </div>
    		</div>		 		
		<?php } ?>
	    </div>
	</div>	
	<!--LIST ALBUM PHOTO-->
	<div class="row">
	    <div class="large-12 columns ">
		<?php
		if ($albumCounter > 0) {
		    $index = 0;
		    ?>
    		<div class="box royalSlider rsMinW" id="albumSlide">						
			<?php
			foreach ($albums as $key => $value) {
			    $album_thumbnail = $value['thumbnail'];
			    $album_id = $value['id'];
			    $album_title = $value['title'];
			    $album_imageCounter = $value['imagecounter'];
			    $album_love = $value['lovecounter'];
			    $album_comment = $value['commentcounter'];
			    $album_share = $value['sharecounter'];
			    $pathCoverAlbum = $fileManagerService->getAlbumCoverPath($_POST['id'], $album_thumbnail, true);
			    if (existsRelation($connectionService, 'user', $currentUserId, 'album', $album_id, 'LOVE')) {
				$css_love = '_love orange';
				$text_love = Yii::t('string', 'view.unlove');
			    } else {
				$css_love = '_unlove grey';
				$text_love = Yii::t('string', 'view.love');
			    }
			    ?> 
			    <?php if ($index % 4 == 0) { ?> <div class="rsContent">	<?php
			    }
			    if ($index % 2 == 0) {
				?>									
	    			<div class="row" style="margin-left: 0px; margin-right: 0px;">
				    <?php } ?>	
				    <div class="small-6 columns box-coveralbum <?php echo $album_id; ?>" onclick="loadBoxAlbumDetail('<?php echo $_POST['id'] ?>', '<?php echo $album_id; ?>',<?php echo $album_imageCounter; ?>, 30, 0)">
					<img class="albumcover" src="<?php echo $pathCoverAlbum; ?>" onerror="this.src='<?php echo Yii::app()->params['defaultImages']['DEFALBUMTHUMB']; ?>'" alt="<?php echo $album_title; ?>"/>  
					<div class="text white breakOffTest"><?php echo $album_title; ?></div>
					<div class="row">
					    <div class="small-5 columns ">
						<a class="note grey"><?php echo $album_imageCounter; ?> <?php echo Yii::t('string', 'view.profile.album.photos'); ?></a>								
					    </div>
					    <div class="small-7 columns propriety ">					
						<a class="icon-propriety <?php echo $css_love ?>"><?php echo $album_love; ?></a>
						<a class="icon-propriety _comment"><?php echo $album_comment; ?></a>
						<a class="icon-propriety _share"><?php echo $album_share; ?></a>	
					    </div>		
					</div>
				    </div>
				    <?php if (($index + 1) % 2 == 0 || $albumCounter == $index + 1) { ?> </div> <?php
				}
				if (($index + 1) % 4 == 0 || $albumCounter == $index + 1) {
				    ?> </div> <?php
				}
				$index++;
			    }
			    ?>							
    		</div>
		<?php } else { ?>
    		<div class="row  ">
    		    <div  class="large-12 columns ">
    			<p class="grey"><?php echo Yii::t('string', 'view.profile.album.nodata'); ?></p>
    		    </div>
    		</div>
		<?php } ?>		
	    </div>
	</div>
	<!--ALBUM PHOTO SINGLE-->	
	<?php
	foreach ($albums as $key => $value) {
	    $album_id = $value['id'];
	    $album_user_objectId = $value['fromuser']['id'];
	    $album_title = $value['title'];
	    $album_imageCounter = $value['imagecounter'];
	    $album_love = $value['lovecounter'];
	    $album_comment = $value['commentcounter'];
	    $album_share = $value['sharecounter'];
	    $connectionService = new ConnectionService();
	    if (existsRelation($connectionService, 'user', $currentUserId, 'album', $album_id, 'LOVE')) {
		$css_love = '_love orange';
		$text_love = Yii::t('string', 'view.unlove');
	    } else {
		$css_love = '_unlove grey';
		$text_love = Yii::t('string', 'view.love');
	    }
	    ?>
    	<div class="profile-singleAlbum">
    	    <div id="<?php echo $album_id; ?>" class='no-display box-singleAlbum'>
    		<div class="box" >
    		    <div class="row box-album" style="border-bottom: 1px solid #303030;margin-bottom: 20px;">
    			<div class="large-12 columns" >					
    			    <a class="ico-label _back_page text white" style="margin-bottom: 10px;" onclick="loadBoxAlbum()"><?php echo Yii::t('string', 'view.back'); ?></a>
    			</div>
    		    </div>	
    		    <!--ALBUM DETAIL-->			
    		    <div id='box-albumDetail'></div>
    		    <script type="text/javascript">
    			    function loadBoxAlbumDetail(userId, id, countImage, limit, skip) {
    				var json_data = {};
    				json_data.userId = userId;
    				json_data.id = id;
    				json_data.countImage = countImage;
    				json_data.limit = limit;
    				json_data.skip = skip;
    				$.ajax({
    				    type: "POST",
    				    url: "views/profile/box/box-albumDetail.php",
    				    data: json_data,
    				    beforeSend: function(xhr) {
    					//spinner.show();
    					$("#albumSlide").fadeOut(100, function() {
    					    $('#' + id).fadeIn(100);
    					    if (skip === 0)
    						goSpinnerBox('#' + id + ' #box-albumDetail', '');
    					    else {
    						$('#' + id + ' #box-albumDetail .otherObject').addClass('no-display');
    						goSpinnerBox('#' + id + ' #box-albumDetail .spinnerDetail', '');
    					    }
    					});
    					console.log('Sono partito box-albumDetail');
    				    }
    				}).done(function(message, status, xhr) {
    				    //spinner.hide();
    				    if (skip > 0) {
    					$('#' + id + ' #box-albumDetail .otherObject').addClass('no-display');
    					$('#' + id + ' #box-albumDetail .spinnerDetail').addClass('no-display');
    				    } else {
    					$("#" + id + " #box-albumDetail").html('');
    				    }
    				    $('#albumBottonSlide').addClass('no-display');
    				    $(message).appendTo("#" + id + " #box-albumDetail");
    				    lightBoxPhoto('photo-colorbox-group');
    				    addthis.init();
    				    addthis.toolbox(".addthis_toolbox");
    				    //    rsi_album.updateSliderSize(true);

    				    //	$("#"+id+" #box-albumDetail").html(message);
    				    code = xhr.status;
    				    //console.log("Code: " + code + " | Message: " + message);
    				    //gestione visualizzazione box detail
    				    console.log("Code: " + code + " | Message: <omitted because too large>");
    				}).fail(function(xhr) {
    				    //spinner.hide();
    				    console.log("Error: " + $.parseJSON(xhr));
    				    //message = $.parseJSON(xhr.responseText).status;
    				    //code = xhr.status;
    				    //console.log("Code: " + code + " | Message: " + message);
    				});
    			    }
    		    </script>
    		    <!-- FINE ALBUM DETAIL-->	
    		    <div class="row album-single-propriety">
    			<div class="box-propriety">
    			    <div class="small-6 columns">
    				<a class="note grey" onclick="love(this, 'Album', '<?php echo $album_id; ?>', '<?php echo $objectIdUser; ?>')"><?php echo $text_love; ?></a>
    				<a class="note grey" onclick="loadBoxOpinion('<?php echo $album_id; ?>', '<?php echo $album_user_objectId; ?>', 'Album', '#<?php echo $album_id; ?> .albumOpinion.box-opinion', 10, 0)"><?php echo Yii::t('string', 'view.comment'); ?></a>
    				<a class="note grey" onclick="share(this, '<?php echo $album_id; ?>', 'profile-singleAlbum')"><?php echo Yii::t('string', 'view.share'); ?></a>
    			    </div>
    			    <div class="small-6 columns propriety ">					
    				<a class="icon-propriety <?php echo $css_love ?>"><?php echo $album_love; ?></a>
    				<a class="icon-propriety _comment"><?php echo $album_comment; ?></a>
    				<a class="icon-propriety _share"><?php echo $album_share; ?></a>	
    			    </div>
    			</div>		
    		    </div>			
    		</div>
    		<!--OPINION-->
    		<div class="albumOpinion box-opinion no-display"></div>
    	    </div>				
    	</div>
	<?php } ?>	
    </div>
</div>