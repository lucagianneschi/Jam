<?php

$currentUserId = $_SESSION['id'];
$level = $user['level'];
$levelValue = $user['levelvalue'];
$type = $user['type'];
$id = $user['id'];
$currentUserType = $_SESSION['type'];
#TODO
//$badge = $user->getBadge();
$noBadge = 10 - count($badge);
$css_message = '';
$css_relation = 'no-display';
$connectionService = new ConnectionService();
if(!existsRelation($connectionService,'user', $currentUserId, 'user', $id, $relationType)) {
    $css_message = 'no-display';
    $css_relation = '';
}
?>
<!-- STATUS -->
<div id="social-status">
    <div class="row">
	<div class="small-12 columns status">			
	    <h3><strong><?php echo $level; ?><span class="text"><?php echo Yii::t('string', 'view.profile.status.pts'); ?></span></strong></h3>					
	</div>
	<!--div class="small-3 columns">			
	    <div class="row">
		<div  class="large-12 columns">
		    <div class="text orange livel-status"><?php echo $levelValue; ?></div>
		</div>
	    </div>
	    <-div class="row">
		<div  class="large-12 columns">
		    <img src="./resources/images/status/popolarity.png" alt/> 	
		</div>
	    </div>		
	</div-->
    </div>
    <div class="row">
	<div  class="large-12 columns"><div class="line"></div></div>
    </div>
    <!--ACHIEVEMENT-->
    <div class="row" id="social-badge">
	<div id="social_list_badge" class="touchcarousel grey-blue">
	    <ul class="touchcarousel-container">
		<?php
		if (!is_null($badge) && is_array($badge)) {
		    foreach ($badge as $value) {
			?>
			<li class="touchcarousel-item">			    	
			    <div data-tooltip class="item-block has-tip tip-left" title="<?php echo $views['status'][$value]; ?>"><img src="<?php echo constant($value); ?>" alt/></div>
			</li>
		    <?php }
		    ?>

		    <?php
		}
		if ($noBadge > 0) {
		    for ($i = 0; $i < $noBadge; $i++) {
			?>
			<li class="touchcarousel-item">
			    <div class="item-block has-tip tip-left"><img src="<?php echo Yii::t('string', 'view.profile.status.badge1'); ?>" alt/></div>
			</li>

			<?php
		    }
		}
		?>        
	    </ul>		
	</div>
    </div>
    <div class="row <?php echo $type . ' ' . $currentUserType ?>" >
	<div  class="large-12 columns"><div class="line"></div></div>
    </div>
    <?php if ($currentUser != $id) { ?>
        <div class="row">
    	<div  class="large-12 columns">
    	    <div class="status-button">
    		<a href="message.php?user=<?php echo $id ?>" class="button bg-grey <?php echo $css_message ?>"><div class="icon-button _message_status"> <?php echo Yii::t('string', 'view.profile.status.sendmsg'); ?></div></a>
		    <?php if ($currentUserType == "SPOTTER" && $type == "SPOTTER") { ?>
			<a href="#" class="button bg-orange"><div class="icon-button _friend_status <?php echo $css_relation ?>"><?php echo Yii::t('string', 'view.profile.status.addfriend'); ?></div></a>
		    <?php } elseif (($currentUserType == "JAMMER" || $currentUserType == "VENUE") && ($type == "JAMMER" || $type == "VENUE")) { ?>
			<a href="#" class="button bg-orange <?php echo $css_relation ?>" onclick="sendRelation('<?php echo $id ?>');">
			    <div class="icon-button _follower_status">
				<?php echo Yii::t('string', 'view.profile.status.coll'); ?>
			    </div>
			</a>
		    <?php } elseif ($currentUserType == "SPOTTER" && ($type == "JAMMER" || $type == "VENUE")) { ?>
			<a href="#" class="button bg-orange <?php echo $css_relation ?>"><div class="icon-button _follower_status"><?php Yii::t('string', 'view.profile.status.foll'); ?></div></a>    	
			<?php } ?>
    	    </div>
    	</div>
        </div>
    <?php } ?>
</div> 