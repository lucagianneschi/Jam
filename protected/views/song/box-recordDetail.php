<?php
/* box per gli dettagli album record
 * box chiamato tramite ajax con:
 * data: {currentUser: id},
 * data-type: html,
 * type: POST o GET
 *
 * box solo per jammer
 */
$songs = Song::model()->profile($_POST['id']);
$pathCover = $_POST['pathCover'];
$userId = $_POST['userId'];

$fileManagerService = new FileManagerService();

$indice = 0;
if ($songs) {
    foreach ($songs as $key => $value) {

	if (existsRelation($connectionService, 'user', $currentUserId, 'song', $value['id'], 'LOVE')) {
	    $track_css_love = '_love orange';
	    $track_text_love = Yii::t('string', 'view.unlove');
	} else {
	    $track_css_love = '_unlove grey';
	    $track_text_love = Yii::t('string', 'view.love');
	}
	$css_addPlayList = "";
	$css_removePlayList = "";
	if (is_array($_SESSION['playlist']['songs']) && in_array($value['id'], $_SESSION['playlist']['songs'])) {
	    $css_addPlayList = 'no-display';
	} else {
	    $css_removePlayList = 'no-display';
	}
	$song = json_encode(array(
	    'id' => $value['id'],
	    'title' => $value['title'],
	    'artist' => $_POST['username'],
	    'mp3' => $fileManagerService->getSongURL($userId, $value['path']),
	    'love' => $value['lovecounter'],
	    'share' => $value['sharecounter'],
	    'pathCover' => $fileManagerService->getUserAvatarPath($userId, $_POST['pathCover'], false)
	));

	if ($value['duration'] >= 3600)
	    $hoursminsandsecs = date('H:i:s', $value['duration']);
	else
	    $hoursminsandsecs = date('i:s', $value['duration']);
	?>
	<div class="row  track" id="<?php echo $value['id']; ?>">
	    <!-- DETTAGLIO TRACCIA -->			
	    <div class="small-12 columns ">	
		<div class="row">
		    <div class="small-9 columns">					
			<a class="ico-label _play-large text breakOffTest jpPlay" onclick="playSong('<?php echo $value['id']; ?>', '<?php echo $pathCover ?>')"><?php echo $indice + 1; ?>. <span class="songTitle"><?php echo $value['title']; ?></span></a>
			<input type="hidden" name="song" value="<?php echo $fileManagerService->getSongURL($userId, $value['path']); ?>" />
		    </div>					
		    <div class="small-3 columns track-propriety align-right" style="padding-right: 15px;">					
			<a class="icon-propriety _menu-small note orange <?php echo $css_addPlayList ?>" onclick='playlist(this, "add",<?php echo $song ?>)'> <?php echo Yii::t('string', 'view.profile.record.addplaylist'); ?></a>
			<a class="icon-propriety _remove-small note orange <?php echo $css_removePlayList ?>" onclick='playlist(this, "remove",<?php echo $song; ?>)'> <?php echo Yii::t('string', 'view.profile.record.removeplaylist'); ?></a>											
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
	<?php
	$indice++;
    }
}else {
    ?>
    <div class="row" style="padding-left: 20px !important; padding-top: 20px !important;}">
        <div  class="large-12 columns"><p class="grey"><?php echo Yii::t('string', 'view.profile.recorddetail.nodata'); ?></p></div>
    </div>
    <?php
}
?>