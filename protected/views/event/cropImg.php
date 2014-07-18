        
<?php $previewWidth = 100; $previewHeight = 100;?>
<?php $this->widget('ext.yii-jcrop.jCropWidget',array(
        'imageUrl'=>$imageUrl,
        'formElementX'=>'Event_cropX',
        'formElementY'=>'Event_cropY',
        'formElementWidth'=>'Event_cropW',
        'formElementHeight'=>'Event_cropH',
        'previewId'=>'avatar-preview', //optional preview image ID, see preview div below
        'previewWidth'=>$previewWidth,
        'previewHeight'=>$previewHeight,
        'jCropOptions'=>array(
                'aspectRatio'=>1, 
                'boxWidth'=>700,
                'boxHeight'=>500,
                'setSelect'=>array(0, 0, 100, 100),
        ),
        
        )
);


?>
