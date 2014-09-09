<?php
/* box followers
 * box chiamato tramite load con:
 * data: {data,typeuser}
 *
 */

//fare questa query
$followersCounter = $_POST['followersCounter'];
$followersBox = new FollowersBox();
$followersBox->init($_POST['id'], 4, 0);

if (is_null($followersBox->error)) {
    $followers = $followersBox->followersArray;
    ?>
    <div class="row" id="social-followers">
        <div  class="large-12 columns">
    	<h3 style="cursor: pointer" onclick="loadBoxRelation('followers', 21, 0,<?php echo $followersCounter; ?>)"><?php echo Yii::t('string', 'view.profile.followers.title'); ?> <span class="orange">[<?php echo $followersCounter ?>]</span></h3>
    	<div class="row  ">
    	    <div  class="large-12 columns ">
    		<div class="box">					
			<?php
			if ($followersCounter > 0 && count($followers) > 0) {
			    $i = 0;
			    foreach ($followers as $key => $value) {
				if ($i % 2 == 0) {
				    ?> <div class="row">  <?php
				}
				$fileManagerService = new FileManagerService();
				$pathPicture = $fileManagerService->getUserAvatarPath($value['id'], $value['thumbnail'], true);
				?>
	    			<div  class="small-6 columns">
	    			    <a href="profile.php?user=<?php echo $value['id']; ?>">
	    				<div class="box-membre">
	    				    <div class="row " id="followers_<?php echo $value['id']; ?>">
	    					<div  class="small-3 columns ">
	    					    <div class="icon-header">
	    						<img src="<?php echo $pathPicture; ?>" onerror="this.src='<?php echo Yii::app()->params['defaultImages']['DEFTHUMBSPOTTER']; ?>'" alt="<?php echo $value['username']; ?>">
	    					    </div>
	    					</div>
	    					<div  class="small-9 columns ">
	    					    <div class="text grey-dark"><strong><?php echo $value['username']; ?></strong></div>
	    					</div>		
	    				    </div>	
	    				</div>
	    			    </a>
	    			</div>
				    <?php if (($i + 1) % 2 == 0 || count($followers) == ($i + 1)) { ?>  </div>  <?php
				}
				$i++;
			    }
			    ?>
			<?php } else { ?>	
			    <div class="row  ">
				<div  class="large-12 columns ">
				    <p class="grey"><?php echo Yii::t('string', 'view.profile.followers.nodata'); ?></p>
				</div>
			    </div>
			<?php } ?>	
    		</div>	
    	    </div>
    	</div>
        </div>
    </div>
    <?php
}
?>