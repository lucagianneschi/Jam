<?php
/*
 * box userinfo
 * chiamato tramite load con:
 * data: {data: data} 
 * @data: array contenente le informazioni relative al box userInfo.box
 * 
 * box per tutti gli utenti
 */

$title = $event['title'];
$genre = '';
$space = '';
foreach ($event['genre'] as $key => $value) {
    $genre = $genre . $space . Yii::t('string', 'tag.localtype.'.$value);
    $space = ', ';
}
$fileManagerService = new FileManagerService();
$pathImage = $fileManagerService->getEventCoverPath($event['fromuser']['id'], $event['cover']);
?>
<div class="row" id="profile-userInfo">
    <div class="large-12 columns">
	<h2><?php echo $title ?></h2>			
	<div class="row">
	    <div class="small-12 columns">				
		<a class="ico-label _tag"><?php echo $genre ?></a>
	    </div>				
	</div>		
    </div>
</div>
<div class="row">
    <div  class="large-12 columns"><div class="line"></div></div>
</div>	
<div class="row">
    <div class="large-12 columns">
	<img class="background" src="<?php echo $pathImage; ?>"  onerror="this.src='<?php echo Yii::app()->params['defaultImages']['DEFEVENTIMAGE']; ?>'" alt ="<?php echo $title; ?> " >						
    </div>
</div> 