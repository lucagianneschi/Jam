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
 */
$id = $_POST['id'];
$featurings = array();

$featurings = getRelatedNodes('user', $id, 'event', 'featuring');
$featuringsCounter = count($featurings);

if ($featuringsCounter > 0) {
    ?>
    <p class="title" data-section-title><a href="#"><?php echo Yii::t('string', 'view.media.information.content2'); ?></a></p>
    <div class="content" data-section-content>
        <div class="row">
	    <?php
	    $totalView = $featuringsCounter > 6 ? 6 : $featuringsCounter;
	    $i = 1;
	    foreach ($featurings as $key => $value) {
		switch ($value['type']) {
		    case 'JAMMER':
			$defaultThum = Yii::app()->params['defaultImages']['DEFTHUMBJAMMER'];
			break;
		    case 'VENUE':
			$defaultThum = Yii::app()->params['defaultImages']['DEFTHUMBVENUE'];
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
				    $thumbPath = $fileManagerService->getUserAvatarPath($value['id'], $value['thumbnail'], true);
				    ?>
				    <img src="<?php echo $thumbPath; ?>" onerror="this.src='<?php echo $defaultThum; ?>'" alt ="<?php echo $value['username']; ?> ">
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