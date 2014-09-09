<?php
$messages = Message::model()->messagePage($id, $limit, $skip);

$cssNewMessage = "no-display";
if (isset($user)) {
    $cssNewMessage = "";
}
if ($messages) {
    ?>
    <form class="formWhite" data-abide >
        <div class="row bg-white" style="padding-top: 3%;">
    	<div class="box-message large-12 columns">
    	    <h3>Messages</h3>
    	    <div class="box">    				
    		<div class="row">
    		    <!--BOX LISTA UTENTI-->
    		    <div class="large-4 columns">
    			<div class="sidebar">
    			    <div class="row ">							
    				<div class="large-12 columns ">
    				    <div class="sottotitle grey"><?php echo Yii::t('string', 'views.message.talked_to'); ?></div>
    				</div>	
    			    </div>
    			    <div class="row">
    				<div class="large-12 columns"><div class="line"></div></div>
    			    </div>
    			    <div class="row">
    				<div class="large-12 columns ">	
    				    <!--box per far aprarire il box del nuovo messaggio-->	
    				    <div class="box-membre <?php echo $cssNewMessage ?>" id="newmessage" >
    					<div class="box-msg" onClick="showNewMsg()">
    					    <div class="row">
    						<div class="small-2 columns ">
    						    <div class="icon-header">
							    <?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/icon/messages/newmessage.jpg', ''); ?>
    						    </div>
    						</div>
    						<div class="small-10 columns" style="padding-top: 8px;">
    						    <div class="text orange breakOffTest"><?php echo Yii::t('string', 'views.message.new_msg'); ?></div>
    						</div>		
    					    </div>
    					</div>
    				    </div>
    				    <div id="box-listMsg">
    					<!--lista utenti-->
					    <?php require_once Yii::getPathOfAlias('application') . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'messagePage' . DIRECTORY_SEPARATOR . 'box-listUsers.php'; ?>
    				    </div>                                        
    				</div>
    			    </div>                                              
    			</div>
    		    </div>
    		    <!--BOX PER INVIO MESSAGGI-->
    		    <div class="large-8 columns">
    			<div id="box-messageSingle">						
    			    <div class="row">
    				<div class="large-12 columns">
    				    <div id="spinner"></div>
					<?php
					if (!isset($user))
					    $user = 'newmessage';
					?>
    				    <!-- messaggi utente-->
    				    <div id="msgUser">
    					<input type="hidden" id="user" value="<?php echo $user ?>"/>										
    					<input type="hidden" id="limit" value="<?php echo 10 ?>"/>
    					<input type="hidden" id="skip" value="<?php echo 0 ?>"/>
    				    </div>										

    				</div>
    			    </div>	
    			</div>    					                                           
    		    </div>
    		    <!--FINE BOX INVIO MESSAGGI-->
    		</div>
    	    </div>
    	</div>
        </div>       
    </form>
<?php } else {
    ?>
    <div class="row">
        <div class="large-12 columns">Error</div>
    </div>
<?php } ?>