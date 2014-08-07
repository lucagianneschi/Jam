
<!DOCTYPE HTML>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js"><!--<![endif]-->
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale = 1.0, user-scalable = no">
	<title><?php echo Yii::t('string', 'metatag.home.title') ?></title>
	<meta name="description" content="<?php echo Yii::t('string', 'metatag.home.description') ?>">
	<meta name="keywords" content="<?php echo Yii::t('string', 'metatag.home.keywords') ?>">
	<!-- <link rel="stylesheet" href="css/style.min.css" type="text/css" media="screen"> -->
	<!--[if IE]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    </head>
    <body>
	<div id="logo" onclick="scrollto('top');"><?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/home/logo.png', 'Jamyourself: Meritocratic Social Music Discovering', array("width" => "150px", "height" => "118px")); ?></div>
	<div class="menu">
	    <div class="facebook" onclick="window.open('<?php echo Yii::t('string', 'view.home.facebook'); ?>');"></div>
	    <div class="twitter" onclick="window.open('<?php echo Yii::t('string', 'view.home.twitter'); ?>');"></div>
        <!-- div class="blog" onclick="window.open('<?php echo Yii::t('string', 'view.home.blog'); ?>')" ><?php echo Yii::t('string', 'view.home.blog'); ?></div -->
	    <div class="subscribe" onclick="scrollto('subscribe');"><?php echo Yii::t('string', 'view.home.subscribe'); ?></div>
	    <div class="login"><a class="loginLB" href="#login_content"><?php echo Yii::t('string', 'view.home.login'); ?></a></div>

	</div>
	<div style="display: none">
	    <div id="login_content">
		<div id="title">LOGIN</div>
		<form action="javascript:access($('#user').val(), $('#pass').val(), 'login', null)">
		    <div class="loginInput">
			<input type="text" id="user" placeholder="username" /><br />
			<input type="password" id="pass" placeholder="password" /><br />
			<input type="submit" id="login" value="Login" style="width: 205px;"/>
		    </div>	
		</form>
	    </div>
	</div>
	<div id="private-beta">
	    <?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/home/privatebeta.png', 'Private Beta', array("width" => "147px", "height" => "145px", "style" => "margin-bottom: -7px;")); ?>	    
            <!--<img src="/images/home/privatebeta.png" alt ="Private Beta" style="margin-bottom: -7px;" width="147" height="145">-->
	</div>
	<div id="top" class="slide top" data-stellar-background-ratio="0.7">
	    <div class="container clearfix">		
		<div class="grid_12">
		    <?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/home/logo-big.png', 'Jamyourself: Meritocratic Social Music Discovering', array("width" => "280px", "height" => "280px")); ?>
		    <!--<img src="/images/home/logo-big.png" alt ="Jamyourself: Meritocratic Social Music Discovering" width="280" height="280">-->
		    <h1><?php echo Yii::t('string', 'view.home.stand_out'); ?></h1>
		    <h2><?php echo Yii::t('string', 'view.home.be_the_first'); ?><br><?php echo Yii::t('string', 'view.home.and_take'); ?></h2>
		</div>
	    </div>
	</div>

	<div id="start" class="slide spot-slide" data-stellar-background-ratio="0.3">
	    <div class="container clearfix">
		<div class="grid_1">&nbsp;</div>
		<div class="grid_5">
		    <?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/home/rank-spot.png', '', array("width" => "180px", "height" => "120px")); ?>
		    <!--<img src="/images/home/rank-spot.png" alt width="180" height="120">-->
		    <h2><?php echo Yii::t('string', 'view.home.top'); ?></h2>
		    <p><?php echo Yii::t('string', 'view.home.points'); ?><br><?php echo Yii::t('string', 'view.home.best'); ?></p>
		</div>
		<div class="grid_5">
		    <?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/home/badge-spot.png', '', array("width" => "180px", "height" => "120px")); ?>
		    <!--<img src="/images/home/badge-spot.png" alt width="180" height="120">-->
		    <h2><?php echo Yii::t('string', 'view.home.talents'); ?></h2>
		    <p><?php echo Yii::t('string', 'view.home.badge'); ?><br><?php echo Yii::t('string', 'view.home.worth'); ?></p>
		</div>
		<div class="grid_1 omega">&nbsp;</div>
	    </div>
	</div>

	<div class="slide spot-link" data-stellar-background-ratio="0.7">
	    <div class="container clearfix">
		<div class="grid_4">
		    <div class="spot" onclick="scrollto('spotter');">
			<?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/home/spotter-spot.png', '', array("width" => "94px", "height" => "150px")); ?>
			<!--<img src="/images/home/spotter-spot.png" alt width="94" height="150">-->
			<h2><?php echo Yii::t('string', 'view.home.are_you'); ?><br><?php echo Yii::t('string', 'view.home.music_lover'); ?></h2>
		    </div>
		</div>
		<div class="grid_4">
		    <div class="spot" onclick="scrollto('jammer');">
			<?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/home/jammer-spot.png', '', array("width" => "94px", "height" => "150px")); ?>
			<!--<img src="/images/home/jammer-spot.png" alt width="94" height="150">-->
			<h2><?php echo Yii::t('string', 'view.home.are_you'); ?><br><?php echo Yii::t('string', 'view.home.emerging_artist'); ?></h2>
		    </div>
		</div>
		<div class="grid_4 omega">
		    <div class="spot" onclick="scrollto('venue');">
			<?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/home/venue-spot.png', '', array("width" => "94px", "height" => "150px")); ?>
			<!--<img src="/images/home/venue-spot.png" alt width="94" height="150">-->
			<h2><?php echo Yii::t('string', 'view.home.own'); ?><br><?php echo Yii::t('string', 'view.home.venue'); ?></h2>
		    </div>
		</div>
	    </div>
	</div>
	<div class="slide slide-img" style="background-image: url(/images/home/1.jpg)" data-slide="2" data-stellar-background-ratio="0.5"></div>
	<div class="slide" id="jammer" data-stellar-background-ratio="0.7">
	    <div class="container clearfix">
		<div class="grid_5 jam-user">
		    <?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/home/jammer.png', '', array("width" => "200px", "height" => "350px")); ?>
		    <!--<img src="/images/home/jammer.png" alt width="220" height="350">-->
		</div>
		<div class="grid_6 omega">
		    <h1><?php echo Yii::t('string', 'view.home.cool'); ?><br><?php echo Yii::t('string', 'view.home.sing'); ?></h1>
		    <h2><?php echo Yii::t('string', 'view.home.star'); ?></h2>
		    <p><?php echo Yii::t('string', 'view.home.start_sharing1'); ?><br><?php echo Yii::t('string', 'view.home.start_sharing2'); ?></p>
		</div>
	    </div>
	</div>
	<div class="slide slide-img" style="background-image: url(/images/home/2.jpg)" data-slide="2" data-stellar-background-ratio="0.5"></div>
	<div class="slide" id="spotter" data-stellar-background-ratio="0.7">
	    <div class="container clearfix">
		<div class="grid_5 jam-user">
		    <?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/home/spotter.png', '', array("width" => "200px", "height" => "350px")); ?>
		    <!--<img src="/images/home/spotter.png" alt width="220" height="350">-->
		</div>
		<div class="grid_6 omega">
		    <h1><?php echo Yii::t('string', 'view.home.you_told'); ?><br><?php echo Yii::t('string', 'view.home.before'); ?></h1>
		    <h2><?php echo Yii::t('string', 'view.home.talent_scout'); ?></h2>
		    <p><?php echo Yii::t('string', 'view.home.next_star'); ?></p>
		</div>

	    </div>
	</div>
	<div class="slide slide-img" style="background-image: url(/images/home/3.jpg)" data-slide="2" data-stellar-background-ratio="0.5"></div>
	<div class="slide" id="venue" data-stellar-background-ratio="0.7">
	    <div class="container clearfix">
		<div class="grid_5 jam-user">
		    <?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/home/venue.png', '', array("width" => "200px", "height" => "350px")); ?>
		    <!--<img src="/images/home/venue.png" alt width="220" height="350">-->
		</div>
		<div class="grid_6 omega">
		    <h1><?php echo Yii::t('string', 'view.home.tomorrow'); ?><br><?php echo Yii::t('string', 'view.home.remember'); ?></h1>
		    <h2><?php echo Yii::t('string', 'view.home.venue_start'); ?></h2>
		    <p><?php echo Yii::t('string', 'view.home.find_next'); ?></p>
		</div>
	    </div>
	</div>
	<div class="slide footer" id="subscribe" data-stellar-background-ratio="0.5">
	    <div class="container clearfix">
		<div class="grid_1">&nbsp;</div>
		<div class="grid_5">
		    <h2><?php echo Yii::t('string', 'view.home.subscribe_lc'); ?></h2>
		    <p><?php echo Yii::t('string', 'view.home.private_beta1'); ?><br><?php echo Yii::t('string', 'view.home.private_beta2'); ?><br>
			<!--a href="#"><?php echo Yii::t('string', 'view.home.key'); ?></a-->
		    </p>
		</div>
		<div class="grid_5">
		    <form action="javascript:subscribe()">
			<input placeholder="yourname@mail.com" type="email" id="mail"/>
			<input type="submit" name="submit" value="<?php echo Yii::t('string', 'view.send'); ?>" id="submit" />
		    </form>
		</div>
		<div class="grid_1 omega">&nbsp;</div>
	    </div>
	</div>

	<div class="slide footer" data-stellar-background-ratio="0.5">
	    <div class="container clearfix">
		<div class="grid_1">&nbsp;</div>
		<div class="grid_10" style="text-align: center">
		    <p>Jamyourself &copy; 2014 &middot; <a href="mailto:info@jamyourself.com">info@jamyourself.com</a><br>
		    </p>
		</div>
		<div class="grid_1 omega">&nbsp;</div>
	    </div>
	</div>
	<script>
	    function scrollto(id)
	    {
		$('html,body').animate({scrollTop: $('#' + id).offset().top - 140}, 800);
	    }
	    ;

	    $(window).scroll(function() {
		scrollPosition = $(window).scrollTop();
		if (scrollPosition <= 590) {
		    //$("#logo").animate({ top: "-120" }, 800 );
		    $("#logo").fadeOut('fast');
		} else {
		    //$("#logo").animate({ top: "0" }, 800 );
		    $("#logo").fadeIn();
		}


	    });
	    $(document).ready(function() {
		$(".loginLB").colorbox({inline: true, width: "30%"});
<?php if (isset($_GET['login'])) { ?>
    		$(".loginLB").colorbox({inline: true, width: "30%", open: true});
<?php } ?>
	    });
	</script>

    </body>
</html>