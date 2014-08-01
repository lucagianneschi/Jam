<?php
$baseUrl = Yii::app()->baseUrl;
$id = '';
if (isset($_GET['event']))
    $id = $_GET['event'];
$events = Event::model()->eventPage($id);
if ($events) {
    $event = $events[0];
    ?>
    <!DOCTYPE html>
    <!--[if IE 8]><html class="no-js lt-ie9" lang="en" ><![endif]-->
    <!--[if gt IE 8]><!--><html class="no-js" lang="en" ><!--<![endif]-->
        <head>
    	<title><?php echo Yii::t('string', 'metatag.event.title') . $event['title'] ?></title>
    	<meta name="description" content="<?php echo Yii::t('string', 'metatag.event.description'); ?>">
    	<meta name="keywords" content="<?php echo Yii::t('string', 'metatag.event.keywords'); ?>">
    	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    	<!-------------------------- METADATI --------------------------->
	    <?php require_once($baseUrl . "views/general/meta.php"); ?>
        </head>
        <body>
    	<!-------------------------- HEADER --------------------------->
	    <?php require_once($baseUrl . 'views/header/main.php'); ?>
    	<!-------------------------- BODY --------------------------->
	    <?php require_once($baseUrl . 'views/event/main.php'); ?>
    	<!-------------------------- FOOTER --------------------------->
	    <?php require_once($baseUrl . 'views/general/footer.php'); ?>	
    	<!-------------------------- SCRIPT --------------------------->
	    <?php require_once($baseUrl . "views/general/script.php"); ?>
    	<script type="text/javascript">
    	    loadBoxInformationFeaturing();
    	    loadBoxInformationAttendee();
    	    loadBoxInformationInvited();
    	    loadBoxEventReview(3, 0);
    	    loadBoxComment(3, 0);
    	</script>
        </body>
    </html>
    <?php
} else {
    header('Location: ' . $baseUrl . '404.php');
}
?>