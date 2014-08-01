<?php
/*
 * Contiene il box information invited dell'utente
 * Il contenuto varia a seconda del tipo di utente:
 * spotter: abount
 * jammer: abount e member
 * venue: abount e map
 * 
 * box chiamato tramite load con:
 * data: array conente infomazoini di tipo userInfo, 
 */


$id = $_POST['id'];
$inviteds = array();

$inviteds = getRelatedNodes('user', $id, 'event', 'invited');
$invitedsCounter = count($inviteds);

if ($invitedsCounter > 0) {
    ?>
    <p class="title" data-section-title><a href="#"><?php echo Yii::t('string', 'view.media.information.content5'); ?> <span>[<?php echo $invitedsCounter ?>]</span></a></p>
    <div class="content" data-section-content>
        <div class="row">
	    <?php
	    $totalView = $invitedsCounter > 6 ? 6 : $invitedsCounter;
	    $i = 1;
	    foreach ($inviteds as $key => $value) {
		switch ($value['type']) {
		    case 'JAMMER':
			$defaultThum = Yii::app()->params['defaultImages']['DEFTHUMBJAMMER'];
			break;
		    case 'VENUE':
			$defaultThum = Yii::app()->params['defaultImages']['DEFTHUMBVENUE'];
			break;
		    case 'SPOTTER':
			$defaultThum = Yii::app()->params['defaultImages']['DEFTHUMBSPOTTER'];
			break;
		}
		?>
		<div  class="small-6 columns">
		    <div class="box-membre" onclick="location.href = 'profile.php?user=<?php echo $value['id']; ?>'">
			<div class="row " id="featuring_<?php echo $value['id']; ?>">
			    <div  class="small-3 columns ">
				<div class="icon-header">
				    <!-- THUMB USER-->
				    <?php
				    $fileManagerService = new FileManagerService();
				    $thumbPath = $fileManagerService->getPhotoPath($value['id'], $value['thumbnail']);
				    ?>
				    <img src="<?php echo $thumbPath; ?>" onerror="this.src='<?php echo $defaultThum; ?>'" alt ="<?php echo $value['username']; ?>">
				</div>
			    </div>
			    <div  class="small-9 columns ">
				<div class="text white breakOffTest"><strong><?php echo $value['username']; ?></strong></div>
				<small class="orange"><?php echo $value['type']; ?></small>
			    </div>		
			</div>
		    </div>
		</div>
		<?php
		if ($i % 2 == 0) {
		    ?>
	        </div>
	        <div class="row">
		    <?php
		}
		if ($i == $totalView)
		    break;
		$i++;
	    }
	    ?>
        </div>
    </div>
    <?php
}
?>