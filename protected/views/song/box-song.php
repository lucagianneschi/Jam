<?php
/* box per gli album musicali
 * box chiamato tramite ajax con:
 * data: {currentUser: id},
 * data-type: html,
 * type: POST o GET
 *
 * box solo per jammer
 */

$userId = $_POST['userId'];
$tracklist = Song::model()->profile($_POST['id']);

if (isset($_SESSION['id']))
    $currentUserId = $_SESSION['id'];
?>
<!--PLAYER ALBUM-->
<div class="row" id="profile-Record">
    <div class="large-12 columns">
        <div class="row">
            <div  class="small-12 columns"><h3><?php echo Yii::t('string', 'view.media.record.tracklist'); ?></h3></div>        
        </div> 
        <!--ALBUM SINGOLO-->       
        <div class="box" style="padding: 0px !important;">                
	    <?php
	    if (count($tracklist) > 0) {
		foreach ($tracklist as $key => $value) {
		    $record_objectId = $value['id'];
		    $record_title = $value['title'];
		    $record_duration = $value['duration'];
		    if ($value->getDuration() >= 3600)
			$hoursminsandsecs = date('H:i:s', $record_duration);
		    else
			$hoursminsandsecs = date('i:s', $record_duration);
		    $css_addPlayList = "";
		    $css_removePlayList = "";
		    if (is_array($_SESSION['playlist']['songs']) && in_array($value['id'], $_SESSION['playlist']['songs'])) {
			$css_addPlayList = 'no-display';
		    } else {
			$css_removePlayList = 'no-display';
		    }
		    $fileManagerService = new FileManagerService();
		    $pathCoverRecord = $fileManagerService->getRecordCoverPath($userId, $value['record']['thumbnail'], true);
		    $pathSong = $fileManagerService->getSongPath($userId, $value['path']);
		    $song = json_encode(array(
			'id' => $value['id'],
			'title' => $value['title'],
			'artist' => $_POST['username'],
			'mp3' => $pathSong,
			'love' => $value['lovecounter'],
			'share' => $value['sharecounter'],
			'pathCover' => $pathCoverRecord
		    ));
		    ?>
		    <div class="row" id="<?php echo $value['id'] ?>"> <!--CODICE TRACCIA: track01-->
			<div class="small-12 columns ">
			    <div class="track">
				<div class="row">
				    <div class="small-9 columns ">                                        
					<a class="ico-label _play-large text breakOffTest jpPlay" onclick="playSong('<?php echo $value['id']; ?>', '<?php echo $pathCoverRecord ?>')"><span class="songTitle"><?php echo $record_title ?></span></a>
					<input type="hidden" name="song" value="<?php echo $pathSong . $value['path']; ?>" />
				    </div>
				    <div class="small-3 columns track-propriety align-right" style="padding-right: 20px;">                                        
					<a class="icon-propriety _menu-small note orange <?php echo $css_addPlayList ?>" onclick='playlist(this, "add",<?php echo $song ?>)'> <?php echo Yii::t('string', 'view.media.record.addplaylist'); ?></a>
					<a class="icon-propriety _remove-small note orange <?php echo $css_removePlayList ?>" onclick='playlist(this, "remove",<?php echo $song; ?>)'> <?php echo Yii::t('string', 'view.media.record.removelist'); ?></a>
				    </div>
				    <div class="small-3 columns track-nopropriety align-right" style="padding-right: 20px;">
					<a class="icon-propriety "><?php echo $hoursminsandsecs ?></a>        
				    </div>                
				</div>
				<div class="row track-propriety" >
				    <div class="box-propriety album-single-propriety">
					<div class="small-5 columns ">
					    <a class="note white" onclick="love(this, 'Song', '<?php echo $record_objectId ?>', '<?php echo $currentUserId; ?>')"><?php echo Yii::t('string', 'view.love'); ?></a>
					    <!--a class="note white" onclick="setCounter(this, '<?php echo $record_objectId ?>', 'Song')"><?php echo Yii::t('string', 'view.share'); ?></a-->        
					</div>
					<div class="small-5 columns propriety ">                                        
					    <a class="icon-propriety _unlove grey" ><?php echo $value['lovecounter'] ?></a>
					    <!--a class="icon-propriety _share" ><?php echo $value['sharecounter']; ?></a-->                        
					</div>
				    </div>                
				</div>
			    </div>
			</div>
		    </div>

		    <?php
		}
	    } else {
		?>        
    	    <div class="row">
    		<div  class="large-12 columns ">
    		    <div class="box">                                                
    			<div class="row">
    			    <div  class="large-12 columns"><p class="grey"><?php echo $views['record']['nodata']; ?></p></div>
    			</div>
    		    </div>
    		</div>
    	    </div>
	    <?php } ?>
            <div class="box-comment no-display"></div>
        </div>
	<?php // }    ?>
        <!--comment-->
        <div class="box-comment no-display"></div>
    </div>
</div>