<?php
$baseUrl = Yii::app()->baseUrl;
$city = $user['city'];
switch ($user['type']) {
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
$music = '';
$space = '';
#TODO
/*
  foreach ($user->getMusic() as $key => $value) {
  $music = $music . $space . $views['tag']['music'][$value];
  $space = ', ';
  }
 */
$userinfo_pin = $city == '' ? '' : '_pin';
$userinfo_note = $music == '' ? '' : '_note';
$pathPicture = $baseUrl . "/" . $user['id'] . "/images/avatar/" . $user['avatar'];
$pathBackground = $baseUrl . "/" . $user['id'] . "/images/background/" . $user['background'];
?>
<div class="row" id="profile-userInfo">
    <div class="large-12 columns">
	<h2><?php echo $user['username']; ?></h2>
	<div class="row">
	    <div class="small-12 columns">				
		<a class="ico-label <?php echo $userinfo_pin ?>"><?php echo $city; ?></a>
		<a class="ico-label <?php echo $userinfo_note ?>"><?php echo $music; ?></a>
	    </div>				
	</div>		
    </div>
</div>
<div class="row">
    <div  class="large-12 columns"><div class="line"></div></div>
</div>	

<div class="row">
    <div class="large-12 columns">
        <img class="background" src="<?php echo $pathBackground; ?>"  onerror="this.src='<?php echo Yii::app()->params['defaultImages']['DEFBGD']; ?>'" alt="">
	<img class="picture" src="<?php echo $pathPicture; ?>" onerror="this.src='<?php echo $defaultImage; ?>'" width="150" height="150" alt="<?php echo $user['username']; ?>">							
    </div>
</div> 