<?php
if (isset($_GET['id'])) {
    $users = User::model()->profile($_GET['id']);
    if (count($users) != 0 && $users != false) {
	$user = $users[0];
    }
    ?>
    <!DOCTYPE html>
    <!--[if IE 8]><html class="no-js lt-ie9" lang="en" ><![endif]-->
    <!--[if gt IE 8]><!--><html class="no-js" lang="en" ><!--<![endif]-->
        <head>
    	<title><?php echo Yii::t('string', 'metatag.profile.title') . $user['username'] ?></title>
    	<meta name="description" content="<?php echo Yii::t('string', 'metatag.profile.description') ?>">
    	<meta name="keywords" content="<?php echo Yii::t('string', 'metatag.profile.keywords') ?>">
    	<!-- METADATI-->
        </head>
        <body>
    	<!-- HEADER -->
	    <?php require_once Yii::getPathOfAlias('application') . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'header' . DIRECTORY_SEPARATOR . 'main.php'; ?>
    	<!-- BODY -->
	    <?php require_once Yii::getPathOfAlias('application') . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'profile' . DIRECTORY_SEPARATOR . 'main.php'; ?>
    	<!-- FOOTER -->
	    <?php require_once Yii::getPathOfAlias('application') . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'general' . DIRECTORY_SEPARATOR . 'footer.php'; ?>
    	<!-- SCRIPT -->
	    <?php require_once Yii::getPathOfAlias('application') . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'general' . DIRECTORY_SEPARATOR . 'script.php'; ?>
    	<script>
    <?php if ($user['type'] == 'JAMMER') { ?>
		    loadBoxRecord();
    <?php } ?>
    	    loadBoxAlbum();
    	    loadBoxRecordReview();
    	    loadBoxEventReview();
    	    //loadBoxActivity();
    	    loadBoxPost();
    <?php
    if ($user['type'] == 'JAMMER' || $user['type'] == 'VENUE') {
	?>
		    loadBoxEvent();
		    loadBoxCollaboration();
		    loadBoxFollowers();
	<?php
    } elseif ($user['type'] == 'SPOTTER') {
	?>
		    loadBoxFriends();
		    loadBoxFollowing();
	<?php
    }
    ?>
    	</script>
        </body>
    </html>
    <?php
} else {
    
}
?>