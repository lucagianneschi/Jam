<?php
$baseUrl = Yii::app()->baseUrl;
$id = '';
if (isset($_GET['record']))
    $id = $_GET['record'];

$records = Record::model()->recordPage($id);
if ($records) {
    $record = $records[0];
    ?>
    <!DOCTYPE html>
    <!--[if IE 8]><html class="no-js lt-ie9" lang="en" ><![endif]-->
    <!--[if gt IE 8]><!--><html class="no-js" lang="en" ><!--<![endif]-->
        <head>
    	<title><?php echo Yii::t('string', 'metatag.record.title') . $record['title']; ?></title>
    	<meta name="description" content="<?php echo Yii::t('string', 'metatag.record.description'); ?>">
    	<meta name="keywords" content="<?php echo Yii::t('string', 'metatag.record.keywords'); ?>">
    	<!-------------------------- METADATI --------------------------->
	    <?php require_once($baseUrl . "views/general/meta.php"); ?>
        </head>
        <body>
    	<!-------------------------- HEADER --------------------------->
	    <?php require_once($baseUrl . 'views/header/main.php'); ?>
    	<!-------------------------- BODY --------------------------->
	    <?php require_once($baseUrl . 'views/recordPage/main.php'); ?>
    	<!-------------------------- FOOTER --------------------------->
	    <?php require_once($baseUrl . 'views/general/footer.php'); ?>	
    	<!-------------------------- SCRIPT --------------------------->
	    <?php require_once($baseUrl . "views/general/script.php"); ?>
    	<script type="text/javascript">
    	    loadBoxRecord();
    	    loadBoxInformationFeaturing();
    	    loadBoxRecordReview(3, 0);
    	    loadBoxComment(3, 0);
    	</script>
        </body>
    </html>
    <?php
} else {
    header('Location: ' . $baseUrl . '404.php');
}
?>