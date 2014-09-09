<?php
/* box per elenco relations
 */

$id = $_POST['id'];
$relation = $_POST['relation'];
$limit = intval($_POST['limit']);
$skip = intval($_POST['skip']);
$tot = intval($_POST['tot']);
$connectionService = new ConnectionService();
$arrayRelation = getRelatedNodes($connectionService, 'user', $id, 'user', strtoupper($relation), $skip, $limit);

if ($relation == 'friendship')
    $rel = 'friends';
else
    $rel = $relation;
if (is_null($arrayRelation) || count($arrayRelation) == 0) {
    ?>
    <div class="grey "><?php echo $views[$rel]['nodata'] ?></div>
    <?php
} else {
    $count = count($arrayRelation);
    $index = 0;
    $relation = Array();
    $where = array();
    $connection = $connectionService->connect();
    foreach ($arrayRelation as $id) {
	$user = selectUsers($connection, $id);
	array_push($relation, $user[$id]);
    }
    foreach ($relation as $value) {
	switch ($user['type']) {
	    case 'JAMMER':
		$defaultImage = Yii::app()->params['defaultImages']['DEFTHUMBJAMMER'];
		break;
	    case 'VENUE':
		$defaultImage = Yii::app()->params['defaultImages']['DEFTHUMBVENUE'];
		break;
	    case 'SPOTTER':
		$defaultImage = Yii::app()->params['defaultImages']['DEFTHUMBSPOTTER'];
		break;
	}
	$fileManagerService = new FileManagerService();
	$pathPicture = $fileManagerService->getUserAvatarPath($value['id'], $value['thumbnail'], true);
	if ($index % 3 == 0) {
	    ?> <div class="row">	<?php } ?>
	    <div class="small-4 columns">
		<a href="profile.php?user=<?php echo $value['id']; ?>">
		    <div class="box-membre">
			<div class="row">
			    <div  class="small-3 columns hide-for-medium-down">
				<div class="icon-header">
				    <img src="<?php echo $pathPicture . $value['thumbnail']; ?>" onerror="this.src='<?php echo $defaultThum; ?>'" alt="<?php echo $value['username']; ?>">
				</div>
			    </div>
			    <div  class="small-9 columns">
				<div class="text grey-light breakOffTest"><strong><?php echo $value['username']; ?></strong></div>
				<div class="note orange breakOffTest" style="margin-top: 8px;"><?php echo $value['type']; ?></div>
			    </div>		
			</div>	
		    </div>
		</a>
	    </div>		
	    <?php if (($index + 1) % 3 == 0 || $count == $index + 1) { ?> </div> <?php
	}
	$index++;
    }
    $css_prev = 'no-display';
    $css_next = 'no-display';
    if ($skip != 0) {
	$css_prev = '';
    }
    if ($tot > ($limit + $skip)) {
	$css_next = '';
    }
    ?>
    <div class="row">
        <div class="small-6 columns">
    	<div class="row">
    	    <div class="small-12 columns">
    		<a class="text orange <?php echo $css_prev ?> " style="float: left !important;" onclick="loadBoxRelation('<?php echo $_POST['relation'] ?>', 21,<?php echo ($skip - $limit) ?>,<?php echo $tot ?>)" style="padding-bottom: 15px;float: right;"><?php echo Yii::t('string', 'view.prev'); ?></a>	
    	    </div>
    	</div>
        </div>
        <div class="small-6 columns">
    	<div class="row">
    	    <div class="small-12 columns">
    		<a class="text orange <?php echo $css_next ?>" onclick="loadBoxRelation('<?php echo $_POST['relation'] ?>', 21,<?php echo ($limit + $skip) ?>,<?php echo $tot ?>)" style="padding-bottom: 15px;float: right;"><?php echo Yii::t('string', 'view.next'); ?></a>	
    	    </div>
    	</div>
        </div>
    </div>
    <?php
}
?>