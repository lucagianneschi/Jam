<?php

$playlists = Playlist::model()->header($_SESSION['id']);
#TODO da modificare quando ci saranno più playlist 
foreach ($playlists as $key => $value) {
	$playlist = $value;
}

#TODO
//decidere come gestire i possibili errori
if (count($playlist['songs']) == 0 && $playlist) {
    // echo 'Playlist vuota';
} elseif (!$playlist) {
    echo 'errore playlist';
}
$_SESSION['playlist']['id'] = $playlist['id'];
$_SESSION['playlist']['songs'] = array();
?>

<div class="row">
    <div  class="small-6 columns hide-for-small">
	<h3><?php echo $playlist['name']; ?></h3>
	<div class="row">
	    <div  class="large-6 columns">
			<!--div class="text white" style="margin-bottom: 15px;"><?php echo Yii::t('string', 'view.header.profile.title'); ?></div-->    		
	    </div>	
	</div>
    </div>	
</div>

<div class="row">
    <div  class="small-12 columns">					
	<?php
	if (count($playlist['songs']) > 0) {
	    $index = 0;
	    foreach ($playlist['songs'] as $key => $value) {
		$id = $value['id'];
		$author_name = $value['fromuser']['username'];
		$author_objectId = $value['fromuser']['id'];
		$title = $value['title'];
		$lovecounter = $value['lovecounter'];
		$sharecounter = $value['sharecounter'];
		$recordObjectId = $value['record'];
		$fileManagerService = new FileManagerService();
		array_push($_SESSION['playlist']['songs'], $id);
		if ($value['duration'] >= 3600)
		    $hoursminsandsecs = date('H:i:s', $value['duration']);
		else
		    $hoursminsandsecs = date('i:s', $value['duration']);
		$song = json_encode(array(
		    'id' => $value-['id'],
		    'title' => $value['title'],
		    'artist' => $author_name,
		    'mp3' => $fileManagerService->getSongPath($author_objectId, $value->getPath()),
		    'love' => $value['lovecounter'],
		    'share' => $value['sharecounter'],
		    'pathCover' => $fileManagerService->getRecordPhotoPath($author_objectId, $value->getRecord()->getThumbnail())
		));
		$connectionService = new ConnectionService();		
		if (existsRelation($connectionService,'user', $currentUserId, 'song', $id, 'LOVE')) {
		    $track_css_love = '_love orange';
		    $track_text_love = Yii::t('string', 'view.unlove');
		} else {
		    $track_css_love = '_unlove grey';
		    $track_text_love = Yii::t('string', 'view.love');
		}
		?>				
		<script>
		    $(document).ready(function() {
			myPlaylist.add({
			    id: "<?php echo $id ?>",
			    title: "<?php echo $title ?>",
			    artist: "<?php echo $author_name ?>",
			    mp3: "<?php echo $fileManagerService->getSongPath($author_objectId, $value['path']) ?>",
			    love: "<?php echo $value['lovecounter']; ?>",
			    share: "<?php echo $value['sharecounter']; ?>",
			    pathCover: "<?php echo $fileManagerService->getRecordPhotoPath($author_objectId, $value['record']) ?>",
			});
			var index = '<?php echo $index ?>';
			if (index === '0') {
			    $('.title-player').html("<?php echo $title ?>");
			    $('#duration-player').html("<?php echo $hoursminsandsecs ?>");
			    $('#header-box-thum img').attr('src', "<?php echo $pathCover . $value['record']['thumbnail']; ?>");
			}
		    });
		</script>						
		<div class="row" id="pl_<?php echo $id ?>"> 
		    <div class="small-12 columns">
			<div class="track">
			    <div class="row">
				<div class="small-9 columns ">					
				    <a style="padding: 0 0px 0 15px !important;" class="ico-label text breakOffTest jpPlay" onclick='playSongPlayList(<?php echo $song; ?>, true)'><span class="songTitle"><?php echo $value['title']; ?></span><span class="note">&nbsp;&nbsp;&nbsp;by <?php echo $author_name ?></span></a>
				    <!--input type="hidden" name="song" value="<?php echo $fileManagerService->getSongPath($author_objectId, $value->getPath()) ?>" /-->
				    <input type="hidden" name="song" value="<?php echo $fileManagerService->getSongPath($author_objectId, $value->getPath()) ?>" />
				    <input type="hidden" name="index" value="<?php echo $index ?>" />
				</div>					
				<div class="small-3 columns track-propriety align-right" style="padding-right: 15px;">	
				    <a class="icon-propriety _remove-small note orange" onclick='playlist(this, "remove",<?php echo $song; ?>)'> <?php echo Yii::t('string', 'view.record.removeplaylist'); ?></a>											
				</div>
				<div class="small-3 columns track-nopropriety align-right" style="padding-right: 15px;">
				    <a class="icon-propriety "><?php echo $hoursminsandsecs ?></a>	
				</div>		
			    </div>
			    <div class="row track-propriety" >
				<div class="box-propriety album-single-propriety">
				    <div class="small-6 columns ">
					<a class="note white" onclick="love(this, 'Song', '<?php echo $value['id']; ?>', '<?php echo $value['fromuser']; ?>')"><?php echo $track_text_love; ?></a>
					<!--a class="note white" onclick="share()"><?php echo Yii::t('string', 'view.share'); ?></a-->
				    </div>
				    <div class="small-6 columns propriety ">					
					<a class="icon-propriety <?php echo $track_css_love ?>" ><?php echo $value['lovecounter']; ?></a>
					<!--a class="icon-propriety _share" ><?php echo $value['sharecounter']; ?></a-->
				    </div>
				</div>		
			    </div>
			</div>
		    </div>
		</div>
		<?php
		$index++;
	    }
	}
	?>
    </div>
</div>
<?php if (count($playlist['songs']) == 0 && $playlist) { ?>
    <div class="row">
        <div  class="small-12 columns hide-for-small">
    	<div class="text grey"><?php echo Yii::t('string', 'view.recordDetail.nodata'); ?></div>    	
        </div>	
    </div>
    <script>
    		$(document).ready(function() {
    		    $('.title-player').html("<?php echo Yii::t('string', 'view.header.song'); ?>");
    		    //	 	$('#player').addClass('no-display');
    		    //	 	$('#noPlaylist').removeClass('no-display');
    		});
    </script>
<?php } ?>