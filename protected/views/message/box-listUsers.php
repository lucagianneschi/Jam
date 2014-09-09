<?php
$messages = Message::model()->messagePage($_SESSION['id']);
$users = array();
for ($i = 0; $i < count($messages); $i = $i + 1) {
    if ($_SESSION['id'] != $messages['fromuser']['id']) {
	array_push($users, $messages['fromuser']);
    }
}
array_unique($users);
$cssNewMessage = "no-display";

foreach ($users as $key => $value) {
    switch ($value['type']) {
	case 'SPOTTER':
	    $tumb = Yii::app()->params['defaultImages']['DEFTHUMBSPOTTER'];
	    break;
	case 'JAMMER':
	    $tumb = Yii::app()->params['defaultImages']['DEFTHUMBJAMMER'];
	    break;
	case 'VENUE':
	    $tumb = Yii::app()->params['defaultImages']['DEFTHUMBVENUE'];
	    break;
    }
    $readCss = '';
    $activeCss = '';
    //controlla se il messaggio e' segnato come letto oppure se 
    //l'utente e' lo stesso del messaggio che vogliamo visualizzare
    if ($value->read == true || (isset($user) && $user == $key))
	$readCss = 'no-display';
    if (isset($user) && $user == $key)
	$activeCss = 'active';
    ?>		
    <div class="box-membre <?php echo $activeCss ?>" id="<?php echo $key ?>">
        <div class="unread <?php echo $readCss ?>"></div>
        <div class="delete" onClick="deleteMsg('<?php echo $key ?>')"></div>
        <div class="box-msg" onClick="showMsg('<?php echo $key ?>')">
    	<div class="row">
    	    <div class="small-2 columns ">
    		<div class="icon-header">
			<?php
			$fileManagerService = new FileManagerService();
			$thumbPath = $fileManagerService->getUserAvatarPath($value->userInfo->id, $value->userInfo->thumbnail, true);
			?>
    		    <img src="<?php echo $thumbPath; ?>" onerror="this.src='<?php echo $tumb; ?>'" alt="<?php echo $value->userInfo->username; ?>">
    		    <input type="hidden" name="type" value="<?php echo $value->userInfo->type ?>"/>
    		</div>
    	    </div>
    	    <div class="small-10 columns" style="padding-top: 8px;">
    		<div id="a1to" class="text grey-dark breakOffTest"><?php echo $value->userInfo->username ?></div>
    	    </div>		
    	</div>
        </div>
    </div>
    <?php
}
/*
  if (count($messageBox->userInfoArray) >= LIMITLISTMSG && count($messageBox->userInfoArray) > 0) {
  ?>

  <div class="box-other" onclick="viewOtherListMsg('<?php echo $user ?>',<?php echo $limit ?>,<?php echo ($limit + $skip) ?>)">
  <a><?php echo $views['message']['view_other']; ?></a>
  </div>
  <?php
  } */
?>
<div id='userTmp'></div>