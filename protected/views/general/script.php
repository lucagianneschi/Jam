
<!--   *** JQUERY *** -->
<!-- <script>
    document.write('<script src=' +
            ('__proto__' in {} ? 'js/plugins/vendor/zepto' : 'js/plugins/vendor/jquery') +
            '.js><\/script>')
</script> -->



<!---------------------------------- FOUNDATION  ------------------------------------------>
<!--<script src="js/foundation/foundation.js"></script>
<script src="js/foundation/foundation.section.js"></script>
<script src="js/foundation/foundation.clearing.js"></script>
<script src="js/foundation/foundation.reveal.js"></script>
<script src="js/foundation/foundation.abide.js"></script>
<script src="js/foundation/foundation.tooltips.js"></script>-->
<!--
<script src="js/foundation/foundation.alerts.js"></script>

<script src="js/foundation/foundation.cookie.js"></script>
<script src="js/foundation/foundation.dropdown.js"></script>
<script src="js/foundation/foundation.forms.js"></script>
<script src="js/foundation/foundation.joyride.js"></script>
<script src="js/foundation/foundation.magellan.js"></script>
<script src="js/foundation/foundation.orbit.js"></script>
<script src="js/foundation/foundation.placeholder.js"></script>
<script src="js/foundation/foundation.reveal.js"></script>

<script src="js/foundation/foundation.tooltips.js"></script>
<script src="js/foundation/foundation.topbar.js"></script>
-->
<script>
    $(document).foundation();
</script>

<script src="js/jquery/jquery-ui-1.10.3.custom.min.js"></script>

<!------------------------------------ ALTRI PLUGINS ---------------------------------------------->
<!------------ touchCarousel //scorrimento element --------------------------------------->
<script src="js/plugins/touchCarousel/jquery.touchcarousel-1.1.min.js"></script>

<!------------ JCrop // crop foto -------------------------------------------------------->
<script type="text/javascript" src="js/plugins/jcrop/jquery.Jcrop.js"></script> 

<!----------- plugin nicescroll -------- sostituito da mCustomScrollbar
<script type="text/javascript" src="js/plugins/nicescroll/jquery.nicescroll.js"></script> -->	 

<!----------- royalslider // scorrimento box ----------------------------------------------->
<script src="js/plugins/royalslider/jquery.royalslider.min.js"></script>

<!----------- colorbox // lightbox foto ---------------------------------------------------->
<script src="js/plugins/colorbox/jquery.colorbox.js"></script>

<!----------- mCustomScrollbar // scrollbar ------------------------------------------------>
<script src="js/plugins/scrollbar/jquery.mCustomScrollbar.js"></script>

<!----------- spinner ------------------------------------------------------------------>
<script type="text/javascript" src="js/plugins/spinner/spinner.js"></script>

<!----------- plupload // upload file -------------------------------------------------->
<script src="js/plugins/plupload/plupload.full.min.js"></script>
<!---------------- geocomplete ---------------------------------------------------------->
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script src="js/plugins/geocomplete/jquery.geocomplete.min.js"></script>
<link rel="stylesheet" href="js/plugins/geocomplete/style.css" type="text/css" media="screen" charset="utf-8" />

<!----------- Select2 ---------------------------------------------------------->
<script src="js/plugins/select2/select2.js"></script>
<link rel="stylesheet" href="js/plugins/select2/style.css" type="text/css" media="screen" charset="utf-8" />
<!----------- addthis // finestra share ------------------------------------------------>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-522dd258579a55ca"></script>

<!----------- rating ------------------------------------------------------------------->
<script type="text/javascript" src='js/plugins/rating/jquery.rating.js'></script>
<script type="text/javascript" src='js/plugins/rating/jquery.barrating.js'></script>

<!------------------------------------- JAMYOURSELF ------------------------------------------>
<script type="text/javascript" src="js/customs/layout.js"></script> 
<script type="text/javascript" src="js/customs/utils.js"></script>
<script type="text/javascript" src="js/customs/player.js"></script>
<script type="text/javascript" src="js/customs/header.js"></script>
<script type="text/javascript" src="js/customs/share.js"></script>
<script type="text/javascript" src="js/customs/access.js"></script>
<script type="text/javascript" src="js/customs/relation.js"></script>

<?php
switch (basename($_SERVER['PHP_SELF'])) {
    case "signup.php":
	?>
	<!-- recatpcha -->
	<script src="http://www.google.com/recaptcha/api/js/recaptcha_ajax.js"></script> 
	<script type="text/javascript" src="js/customs/signup.js"></script>
	<?php
	break;
    case "login.php":
	?>

	<?php
	break;
    case "profile.php":
	?>
	<script type="text/javascript" src="js/customs/profile.js"></script>
	<script type="text/javascript" src="js/customs/post.js"></script>
	<script type="text/javascript" src="js/customs/love.js"></script>
	<script type="text/javascript" src="js/customs/opinion.js"></script>
	<?php
	break;
    case "stream.php":
	?>
	<script type="text/javascript" src="js/customs/stream.js"></script>
	<script type="text/javascript" src="js/customs/post.js"></script>
	<script type="text/javascript" src="js/customs/love.js"></script>
	<script type="text/javascript" src="js/customs/opinion.js"></script>
	<?php
	break;
    case "event.php":
	?>
	<script type="text/javascript" src="js/customs/profile.js"></script>
	<script type="text/javascript" src="js/customs/love.js"></script>
	<script type="text/javascript" src="js/customs/comment.js"></script>
	<script type="text/javascript" src="js/customs/opinion.js"></script>
	<?php
	break;
    case "record.php":
	?>
	<script type="text/javascript" src="js/customs/profile.js"></script>
	<script type="text/javascript" src="js/customs/love.js"></script>
	<script type="text/javascript" src="js/customs/comment.js"></script>
	<?php
	break;
    case "message.php":
	?>
	<script type="text/javascript" src="js/customs/message.js"></script>
	<?php
	break;
    case "uploadRecord.php":
	?>
	<script type="text/javascript" src="js/customs/uploadRecord.js"></script>
	<?php
	break;
    case "uploadReview.php":
	?>
	<script type="text/javascript" src="js/customs/uploadReview.js"></script>
	<?php
	break;
    case "uploadEvent.php":
	?>
	<script type="text/javascript" src="js/customs/uploadEvent.js"></script>
	<?php
	break;
    case "uploadAlbum.php":
	?>
	<script type="text/javascript" src="js/customs/uploadAlbum.js"></script>
	<?php
	break;
}
?>
