<?php
/*
 * box album detail
 * box chiamato tramite load con:
 * data: {data: data, typeUser: id}
 * 
 * box per tutti gli utenti
 */

$userId = $_POST['userId'];
$id = $_POST['id'];
$countImage = $_POST['countImage'];
$limit = intval($_POST['limit']);
$skip = intval($_POST['skip']);
if (session_id() == '')
    session_start();
if (isset($_SESSION['id']))
    $currentUserId = $_SESSION['id'];
$images = Image::model()->profile($id, $limit, $skip);

$css_other = 'no-display';
$other = 0;
if (($limit + $skip) < $countImage) {
    $css_other = '';
    $other = $countImage - ($limit + $skip);
}
$fileManagerService = new FileManagerService();
?>
<ul class="small-block-grid-3 small-block-grid-2 " >	
    <?php
    foreach ($images as $key => $value) {
	$thumbImage = $value['thumbnail'];
	?>
        <!--THUMBNAIL -->
        <li><a class="photo-colorbox-group" href="#<?php echo $value['id']; ?>"><img class="photo" src="<?php echo $fileManagerService->getPhotoPath($id, $value['thumbnail']); ?>" onerror="this.src='<?php echo Yii::app()->params['defaultImages']['DEFIMAGETHUMB']; ?>'" alt></a></li>
    <?php } ?>
</ul>
<div class="row">
    <div class="small-12 columns">
	<a class="text orange otherObject <?php echo $css_other; ?>" onclick="loadBoxAlbumDetail('<?php echo $id ?>',<?php echo $countImage ?>, 30,<?php echo $limit + $skip ?>)" style="padding-bottom: 15px;float: right;"><?php echo Yii::t('string', 'view.other'); ?><span><?php echo $other; ?></span><?php echo Yii::t('string', 'view.profile.album.photos'); ?></a>	
    </div>
</div>
<div class='spinnerDetail'></div>
<?php if (count($albumDetail->imageArray) == 0) { ?>
    <div class="row  ">
        <div  class="large-12 columns ">
    	<p class="grey"><?php echo Yii::t('string', 'view.profile.album.nodata'); ?></p>
        </div>
    </div>

<?php } ?>
<!----------------------------------- lightbox ------------------------------------------>
<div class="row no-display box" id="profile-Image">
    <div class="large-12 columns">
	<?php
	foreach ($albumDetail->imageArray as $key => $value) {
		
	    if (existsRelation($connectionService,'user', $currentUserId, 'image', $value['id'], 'LOVE')) {
			$css_love = '_love orange';
			$text_love = Yii::t('string', 'view.unlove');
	    } else {
			$css_love = '_unlove grey';
			$text_love = Yii::t('string', 'view.love');
	    }
	    ?>				 	
    	<div id="<?php echo $value['id']; ?>" class="lightbox-photo <?php echo $fileManagerService->getPhotoPath($id, $value['path']); ?>">
    	    <div class="row " style="max-width: none;">
    		<div class="large-12 columns lightbox-photo-box">
    		    <div class="album-photo-box" onclick="nextLightBox()"><img class="album-photo"  src="<?php echo $pathImage . $value['path']; ?>" onerror="this.src='<?php echo Yii::app()->params['defaultImages']['DEFIMAGETHUMB']; ?>'" alt/></div>
    		    <div class="row">
    			<div  class="large-12 columns" style="padding-top: 15px;padding-bottom: 15px"><div class="line"></div></div>
    		    </div>
    		    <div class="row" style="margin-bottom: 10px">
    			<div  class="small-6 columns">
    			    <a class="note grey " onclick="love(this, 'Image', '<?php echo $value['id']; ?>', '<?php echo $objectIdUser; ?>')"><?php echo $text_love; ?></a>
    			    <a class="note grey" onclick="loadBoxOpinion('<?php echo $value['id']; ?>', '<?php echo $value['fromuser']['id']; ?>', 'Image', '#<?php echo $value['id']; ?> .box-opinion', 10, 0)"><?php echo Yii::t('string', 'view.comment'); ?></a>
    			    <a class="note grey" onclick="share(this, '<?php echo $value['id']; ?>', 'profile-Image')"><?php echo Yii::t('string', 'view.share'); ?></a>
    			</div>
    			<div  class="small-6 columns propriety">
    			    <a class="icon-propriety <?php echo $css_love ?>"><?php echo $value['lovecounter']; ?></a>
    			    <a class="icon-propriety _comment"><?php echo $value['commentcounter']; ?></a>
    			    <a class="icon-propriety _share"><?php echo $value['sharecounter']; ?></a>	
    			</div>
    		    </div>
    		    <div class="row">
    			<div  class="small-5 columns">
    			    <div class="sottotitle white"><?php echo $album_title; ?></div>
				<?php if ($value['description'] != "") { ?>
				    <div class="text grey"><?php echo $value['description']; ?></div>		
				    <?php
				}
				if ($value['latitude'] && $value['longitude']) {
				    $lat = $value['latitude'];
				    $lng = $value['longitude'];
				    $geocode = new GeocoderService();
				    $addressCode = $geocode->getAddress($lat, $lng);
				    if (count($addressCode) > 0) {
					$address = $addressCode['locality'] . " - " . $addressCode['country'];
				    }
				    ?>
				    <div class="text grey"><?php echo $address; ?></div>			
				    <?php
				}
				$tag = "";
				if (is_array($value['tags'])) {
				    foreach ($value['tags'] as $key => $value) {
					$tag = $tag + ' ' + $value;
				    }
				    ?>
				    <div class="text grey"><?php echo $tag; ?></div>
				<?php }
				?>
    			</div>
    			<div  class="small-7 columns">
    			    <!---------------------------------------- COMMENT ------------------------------------------------->
    			    <div class="box-opinion no-display" ></div>
    			    <!---------------------------------------- SHARE ---------------------------------------------------->
    			</div>
			    <?php
			    //	$paramsImage = getShareParameters('Image', '', $value->getPath());
			    ?>		    			    
    		    </div>
    		</div>			
    	    </div>
    	</div>
	<?php } ?>
    </div>	
</div>