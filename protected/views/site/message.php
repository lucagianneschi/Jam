<?php
$currentUser = $_SESSION['id'];
//esempio: id dell'utente a cui si vuole vedere il profilo 
$user = $_GET['user'];
?>
<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en" ><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="en" ><!--<![endif]-->

    <head>
	<title><?php echo Yii::t('string', 'metatag.message.title') . $user['username'] ?></title>
	<meta name="description" content="<?php echo Yii::t('string', 'metatag.message.description'); ?>">
	<meta name="keywords" content="<?php echo Yii::t('string', 'metatag.message.keywords'); ?>">
        <style>
        </style>
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
    </body>
</html>