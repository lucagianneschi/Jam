<?php
/*
 * box userinfo
 * chiamato tramite load con:
 * data: {data: data} 
 * @data: array contenente le informazioni relative al box userInfo.box
 * 
 * box per tutti gli utenti
 */


$title = $record['title'];
$genre = $record['genre'];
$fromUserObjectId = $record['fromuser']['id'];
$fileManagerService = new FileManagerService();
$pathCoverRecord = $fileManagerService->getRecordCoverPathPath($fromUserObjectId, $record['cover']);
$arrayGenre = explode(",", $genre);
$stringGenre = '';
foreach ($arrayGenre as $key => $value) {
    if ($key == 0)
	$stringGenre = Yii::t('string', 'tag.music.'.$value);
    else
	$stringGenre = $stringGenre . ', ' . Yii::t('string', 'tag.music.'.$value);
}
//$stringGenre = $views['tag']['music'][$arrayGenre[0]];
?>
<div class="row" id="profile-userInfo">
    <div class="large-12 columns">
        <h2><?php echo $title ?></h2>			
        <div class="row">
            <div class="small-12 columns">				
                <a class="ico-label _tag"><?php echo $stringGenre ?></a>
            </div>				
        </div>		
    </div>
</div>
<div class="row">
    <div  class="large-12 columns"><div class="line"></div></div>
</div>	

<div class="row">
    <div class="large-12 columns">
        <img class="background" src="<?php echo $pathCoverRecord; ?>"  onerror="this.src='<?php echo Yii::app()->params['defaultImages']['DEFRECORDCOVER']; ?>'" alt ="<?php echo $title; ?> " >						
    </div>
</div> 