<?php
/* box post
 * box chiamato tramite load con:
 * data: {data,typeuser}
 *
 */
$baseUrl = Yii::app()->baseUrl;
if (isset($_SESSION['id'])) {
    $currentUserId = $_SESSION['id'];
    $posts = Post::model()->profile($_POST['id']);
    $postCounter = count($posts);
    ?>
    <!-- Post -->
    <div class="row" id="social-Post" style='margin-bottom: 40px;'>
        <div  class="large-12 columns">
    	<h3><?php echo Yii::t('string', 'view.profile.post.title'); ?></h3>
    	<div class="row ">
    	    <div  class="large-12 columns ">
    		<div class="row  ">
    		    <div  class="large-12 columns ">
    			  <form action="" class="box-write" onsubmit="sendPost('<?php echo $_POST['id']; ?>', $('#post').val());
    				return false;">    			    
    			    <div class="row">
    				<div class="small-9 columns ">
    				    <input id="post" type="text" class="post inline" placeholder="<?php echo Yii::t('string', 'view.profile.post.write'); ?>" />
    				</div>
    				<div class="small-3 columns ">
    				    <input type="button" id="button-post" class="post-button inline" value="<?php echo Yii::t('string', 'view.post_button'); ?>" onclick="sendPost('<?php echo $_POST['id']; ?>', $('#post').val())" />
    				</div>
    			    </div>
    			</form>
    		    </div>
    		</div>
    		<div class="row">
    		    <div  class="large-12 columns ">
    			<div id="post-error" onClick="postError()"><img src=<?php echo $baseUrl . "./images/error/error-post.png"; ?> alt/></div>
    		    </div>
    		</div>
		    <?php
		    if ($postCounter > 0) {
			foreach ($posts as $key => $value) {
			    $post_objectId = $value['id'];
			    $post_createdAt = ucwords(strftime("%A %d %B %Y - %H:%M", $value['createdat']));
			    $post_fromUser_objectId = $value['fromuser']['id'];
			    $post_fromUser_profileThumbnail = $value['fromuser']['thumbnail'];
			    $post_fromUser_username = $value['fromuser']['username'];
			    $post_fromUser_type = $value['fromuser']['type'];
			    $post_text = $value['text'];
			    $post_loveCounter = $value['lovecounter'];
			    $post_commentCounter = $value['commentcounter'];

			    if (existsRelation($connectionService, 'user', $currentUserId, 'comment', $post_objectId, 'LOVE')) {
				$css_love = '_love orange';
				$text_love = Yii::t('string', 'view.unlove');
			    } else {
				$css_love = '_unlove grey';
				$text_love = Yii::t('string', 'view.love');
			    }
			    switch ($post_fromUser_type) {
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
			    $pathPicture = $fileManagerService->getUserAvatarPath($post_fromUser_objectId, $post_fromUser_profileThumbnail, true);
			    ?>
	    		<div id='<?php echo $post_objectId; ?>'>
	    		    <div class="box" style="padding: 15px !important;padding-bottom: 10px !important;">
	    			<a href="profile.php?user=<?php echo $post_fromUser_objectId ?>">
	    			    <div class="row  line" style="padding-bottom: 10px !important;padding-right: 20px !important;">
	    				<div  class="small-1 columns ">
	    				    <div class="icon-header">
	    					<img src="<?php echo $pathPicture; ?>" onerror="this.src='<?php echo $defaultThum; ?>'" alt="<?php echo $post_fromUser_username; ?>">
	    				    </div>
	    				</div>
	    				<div  class="small-5 columns" style="padding-left: 20px;">
	    				    <div class="text grey" style="margin-bottom: 0px;">
	    					<strong><?php echo $post_fromUser_username; ?></strong>
	    				    </div>
	    				    <div class="note orange">
	    					<strong><?php echo $post_fromUser_type; ?></strong>
	    				    </div>
	    				</div>
	    				<div  class="small-6 columns propriety">
	    				    <div class="note grey-light">
						    <?php echo $post_createdAt; ?>
	    				    </div>
	    				</div>
	    			    </div>
	    			</a>
	    			<div class="row  line">
	    			    <div  class="small-12 columns ">
	    				<div class="row ">
	    				    <div  class="small-12 columns ">
	    					<div class="text grey" style="padding-top: 10px;">
							<?php echo $post_text; ?>	
	    					</div>
	    				    </div>
	    				</div>
	    			    </div>
	    			</div>
	    			<div class="row">
	    			    <div class="box-propriety">
	    				<div class="small-5 columns ">
	    				    <a class="note grey " onclick="love(this, 'Comment', '<?php echo $post_objectId; ?>', '<?php echo $currentUserId; ?>')"><?php echo $text_love; ?></a>
	    				    <a class="note grey" onclick="loadBoxOpinion('<?php echo $post_objectId; ?>', '<?php echo $post_fromUser_objectId; ?>', 'Comment', '#<?php echo $post_objectId; ?> .box-opinion', 10, 0)"><?php echo Yii::t('string', 'view.comment'); ?></a>
	    				</div>
	    				<div class="small-5 columns propriety ">
	    				    <a class="icon-propriety <?php echo $css_love ?>"><?php echo $post_loveCounter; ?></a>
	    				    <a class="icon-propriety _comment"><?php echo $post_commentCounter; ?></a>
	    				</div>
	    			    </div>
	    			</div>
	    		    </div> <!--BOX-->	
	    		    <!--COMMENT-->
	    		    <div class="box-opinion no-display" ></div>
	    		</div>
			    <?php
			}
		    } else {
			?>
			<div class="box">
			    <div class="row">
				<div  class="large-12 columns ">
				    <p class="grey"><?php echo Yii::t('string', 'view.profile.post.nodata'); ?></p>
				</div>
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