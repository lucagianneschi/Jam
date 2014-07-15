        
<?php $previewWidth = 100; $previewHeight = 100;?>
<?php $this->widget('ext.yii-jcrop.jCropWidget',array(
        'imageUrl'=>$imageUrl,
        'formElementX'=>'JcropForm_cropX',
        'formElementY'=>'JcropForm_cropY',
        'formElementWidth'=>'JcropForm_cropW',
        'formElementHeight'=>'JcropForm_cropH',
        'previewId'=>'avatar-preview', //optional preview image ID, see preview div below
        'previewWidth'=>$previewWidth,
        'previewHeight'=>$previewHeight,
        'jCropOptions'=>array(
                'aspectRatio'=>1, 
                'boxWidth'=>400,
                'boxHeight'=>400,
                'setSelect'=>array(0, 0, 100, 100),
        ),
        
        )
);


?>
