<?php
/* @var $this AlbumController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Albums',
);

?>

<div class="bg-grey-dark">
    <div class="row formBlack" id="uploadAlbum">
		<div  class="large-12 columns">
		    <div class="row">
				<div  class="large-12 columns">
				    <h3><?php echo Yii::t('string','view.uploadalbum.upload') ?></h3>
				</div>				
		    </div>
		    <div class="row">
				<div  class="large-12 columns formBlack-box">		
				   <div class="row">
					    <div  class="large-12 columns formBlack-title">
					        <h2><?php echo Yii::t('string','view.uploadalbum.select'); ?></h2>										
					    </div>	
					</div>						
					<div class="row formBlack-body" id="uploadAlbum-listAlbum">
					    <div  class="large-12 columns ">
					    	<?php if(count($model) > 0){ ?>					
					        <div  id="uploadAlbum-listAlbumTouch" class="touchcarousel grey-blue">
					            <ul class="touchcarousel-container" id="albumList"> 
					            	<?php foreach ($model as $key => $value) { ?>			
									           
						            	<li class="touchcarousel-item">
										    <div class="item-block uploadAlbum-boxSingleAlbum" id="<?php echo $value->id?>">
											    <div class="row uploadAlbum-rowSingleAlbum">
												    <div  class="small-6 columns ">
												    	 <?php echo CHtml::image(Yii::app()->request->baseUrl.'/'.Yii::app()->params['users_dir']['users'] .'/'. $value->fromuser . '/'.Yii::app()->params['users_dir']['albumcoverthumb'].'/'.$value->thumbnail, $value->title, array('class'=>'coverAlbum','onerror'=>'this.src="'.Yii::app()->request->baseUrl.'/images/default/defaultAlbumThumb.jpg"'));  ?>
												    	
												    </div>
												    <div  class="small-6 columns title">
													    <div class="sottotitle white"><?php echo $value->title?></div>
													    <!--div class="text white"><?php //echo $images ?> photos</div-->
												    </div>
											    </div>
										    </div>
										 </li>
									 <?php } ?>
					            </ul>					
					        </div>
							<?php } ?>
					    </div>		
					</div>
					<div class="row">
					    <div  class="large-12 columns formBlack-title">
					        <!--a type="button" class="buttonOrange _add sottotitle" id="uploadAlbum-new"><?php echo Yii::t('string','view.uploadalbum.create'); ?></a-->									
					    	<?php echo CHtml::button( Yii::t('string','view.uploadalbum.create'), array('submit' => array('createAlbum'), 'class'=>"buttonOrange _add sottotitle",'style'=>'height: 44px;')); ?>
					    </div>	
					</div>
		
				</div>
		    </div>
		</div>
    </div>	
</div>
<script>
	$(function(){
		onCarouselReady("#uploadAlbum-listAlbumTouch");
		
		$('.uploadAlbum-boxSingleAlbum').click(function() {
			console.log(this);
            <?php //$this->redirect(array('image/create','id'=>$model->id));?>
        });
                  
	});
</script>