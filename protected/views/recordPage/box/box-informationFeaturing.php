<?php
/*
 * Contiene il box information featuring dell'utente
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

$id = $_POST['id'];
$connectionService = new ConnectionService();
$featurings = getRelatedNodes($connectionService, 'user', $id, 'record', 'featuring');

$featuringsCounter = count($featurings);

if ($featuringsCounter > 0) {
    ?>
    <p class="title" data-section-title><a href="#"><?php echo Yii::t('string', 'view.media.info.content2'); ?></a></p>
    <div class="content" data-section-content>
        <div class="row">
	    <?php
	    $totalView = $featuringsCounter > 4 ? 4 : $featuringsCounter;
	    $i = 1;
	    foreach ($featurings as $key => $value) {
		$defaultThum = $value['type'] == 'JAMMER' ? Yii::app()->params['defaultImages']['DEFTHUMBJAMMER'] : Yii::app()->params['defaultImages']['DEFTHUMBVENUE'];
		$fileManagerService = new FileManagerService();
		$pathPicture = $fileManagerService->getUserAvatarPath($value['id'], $value['thumbnail'], true);
		?>
		<div  class="small-6 columns">
		    <a href="profile.php?user=<?php echo $value['id']; ?> ">
			<div class="box-membre">
			    <div class="row ">
				<div  class="small-3 columns ">
				    <div class="icon-header">
					<img src="<?php echo $pathPicture . $value['thumbnail']; ?>" onerror="this.src='<?php echo $defaultThum; ?>'" alt ="<?php echo $value['username']; ?> ">
				    </div>
				</div>
				<div  class="small-9 columns ">
				    <div class="text white breakOffTest"><strong><?php echo $value['username']; ?></strong></div>
				    <small class="orange"><?php echo $value['type']; ?></small>
				</div>		
			    </div>
			</div>
		    </a>
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