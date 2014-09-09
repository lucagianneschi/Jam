<?php
/* box per elenco following
 * box chiamato tramite ajax con:
 * data: {user: id}, 
 * data-type: html,
 * type: POST o GET
 * 
 * box solo per spotter
 */

$followingCounter = $_POST['followingCounter'];

if ($followingCounter != 0) {
    $followings = array(); //qui eseguire la query che trova se si segue qualcu
    $venuesFollowings = $followings['venue'];
    $jammersFollowings = $followings['jammer'];
//    $venuesFollowingsCounter = $_POST['venueCounter'];
//    $jammersFollowingsCounter = $_POST['jammerCounter'];
    $venuesFollowingsCounter = count($venuesFollowings);
    $jammersFollowingsCounter = count($jammersFollowings);
    $totFollowings = $followingCounter;
    ?>
    <!--FOLLOWING-->
    <div class="row" id="profile-following">
        <div class="large-12 columns ">
    	<h3 style="cursor: pointer" onclick="loadBoxRelation('following', 21, 0,<?php echo $followingCounter; ?>)"><?php echo Yii::t('string', 'view.profile.following.title'); ?><span class="orange"> [<?php echo $followingCounter; ?>]</span></h3>
    	<div class="box" id="following-list">
		<?php
		if ($totFollowings > 0) {
		    if ($venuesFollowingsCounter > 0) {
			?>
	    	    <div class="row">
	    		<div class="large-12 columns" style="padding-bottom: 10px;">
	    		    <div class="text orange">Venue <span class="white">[<?php echo $venuesFollowingsCounter ?>]</span></div>
	    		</div>
	    	    </div>
			<?php
			$i = 0;
			foreach ($venuesFollowings as $key => $value) {
			    switch ($value->getType()) {
				case 'JAMMER':
				    $defaultThum = Yii::app()->params['defaultImages']['DEFTHUMBJAMMER'];
				    break;
				case 'VENUE':
				    $defaultThum = Yii::app()->params['defaultImages']['DEFTHUMBVENUE'];
				    break;
			    }
			    $fileManagerService = new FileManagerService();
			    $pathPicture = $fileManagerService->getUserAvatarPath($value['id'], $value['thumbnail'], true);
			    if ($i % 2 == 0) {
				?> <div class="row">  <?php }
			    ?>	
				<div  class="small-6 columns">
				    <a href="profile.php?user=<?php echo $value['id']; ?>">
					<div class="box-membre">
					    <div class="row " id="collaborator_<?php echo $value['id']; ?>">
						<div  class="small-3 columns ">
						    <div class="icon-header">
							<img src="<?php echo $pathPicture; ?>" onerror="this.src='<?php echo $defaultThum; ?>'" alt="<?php echo $value['username']; ?>">
						    </div>
						</div>
						<div  class="small-9 columns ">
						    <div class="text grey-light breakOffTest"><strong><?php echo $value['username']; ?></strong></div>
						</div>	
					    </div>
					</div>
				    </a>
				</div>
				<?php if (($i + 1) % 2 == 0 || count($venuesFollowings) == ($i + 1)) { ?>  </div>  <?php
			    }
			    $i++;
			    if ($i == 4)
				break;
			}
			?>	
	    	    <div class="row">
	    		<div  class="large-12 columns"><div class="line"></div></div>
	    	    </div>
			<?php
		    }
		    if ($jammersFollowingsCounter > 0) {
			?>
	    	    <!--JAMMER-->
	    	    <div class="row">
	    		<div class="large-12 columns" style="padding-bottom: 10px;">
	    		    <div class="text orange">Jammer <span class="white">[<?php echo $jammersFollowingsCounter ?>]</span></div>
	    		</div>
	    	    </div>
			<?php
			$i = 0;
			foreach ($jammersFollowings as $key => $value) {
			    switch ($value->getType()) {
				case 'JAMMER':
				    $defaultThum = Yii::app()->params['defaultImages']['DEFTHUMBJAMMER'];
				    break;
				case 'VENUE':
				    $defaultThum = Yii::app()->params['defaultImages']['DEFTHUMBVENUE'];
				    break;
			    }
			    $fileManagerService = new FileManagerService();
			    $pathPicture = $fileManagerService->getUserAvatarPath($value['id'], $value['thumbnail'], true);
			    if ($i % 2 == 0) {
				?> <div class="row">  <?php } ?>
				<div  class="small-6 columns">
				    <a href="profile.php?user=<?php echo $value['id']; ?>">
					<div class="box-membre">
					    <div class="row " id="collaborator_<?php echo $value['id']; ?>">
						<div  class="small-3 columns ">
						    <div class="icon-header">
							<img src="<?php echo $pathPicture; ?>" onerror="this.src='<?php echo $defaultThum; ?>'" alt="<?php echo $value['username']; ?>">
						    </div>
						</div>
						<div  class="small-9 columns ">
						    <div class="text grey-light breakOffTest"><strong><?php echo $value['username']; ?></strong></div>
						</div>		
					    </div>	
					</div>
				    </a>
				</div>
				<?php if (($i + 1) % 2 == 0 || count($jammersFollowings) == ($i + 1)) { ?>  </div>  <?php
			    }
			    $i++;
			    if ($i == 4)
				break;
			}
			?>
			<?php
		    }
		} else {
		    ?>	
		    <div class="row  ">
			<div  class="large-12 columns ">
			    <p class="grey"><?php echo Yii::t('string', 'view.profile.following.nodata'); ?></p>
			</div>
		    </div>
		    <?php
		}
		?>
    	</div>
        </div>
    </div>
    <?php
}
?>