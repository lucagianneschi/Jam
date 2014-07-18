<?php


class CropImage {
	
	public $image;
	public $cropID;
    public $cropX;
    public $cropY;
    public $cropW;
    public $cropH;


	public function __construct($model){ 
	  	$this->image = $model->image;
		$this->cropID = $model->cropID; 
		$this->cropX = $model->cropX; 
		$this->cropY = $model->cropY; 
		$this->cropW = $model->cropW; 
		$this->cropH = $model->cropH;  
	}
  
	 	
	public function crop($dim_image, $path_dest_image, $dim_thumb = null, $path_dest_thumb = null){
		$filename = $this->image;
		
		list($width, $height, $type, $attr) = getimagesize($filename);
	
		switch ($type) {
            case IMAGETYPE_GIF: 
                $image = imagecreatefromgif($filename); 
                break;   
            case IMAGETYPE_JPEG:  
                $image = imagecreatefromjpeg($filename); 
                break;   
            case IMAGETYPE_PNG:  
                $image = imagecreatefrompng($filename);
                break; 
            default:
                throw new CHttpException(405,'Errors upload image');
        }

        //cropping image
        $xCoord = $this->cropX; /* these two fields are the (x,y) coordinates */
        $yCoord = $this->cropY; /*  of the top left corner of our new image  */
        
        $width = $this->cropW; // width of the cropped area
        $height = $this->cropH; // height of the cropped area
		
		// CROP della cover
		$cover = ImageCreateTrueColor($dim_image, $dim_image);
		imagecopyresampled($cover, $image, 0, 0, $xCoord, $yCoord, $dim_image, $dim_image, $width, $height); 
		
		// creao thumbnail dalla cover
		if($dim_thumb != null){
			$thumbnail= ImageCreateTrueColor($dim_thumb, $dim_thumb);
			imagecopyresampled($thumbnail, $cover, 0, 0, 0, 0, $dim_thumb, $dim_thumb, $dim_image, $dim_image); 
		}
		
		
		//SALVO LE IMMAGINI NELLE RISPETTIVE CARTELLE:
		$cover_url = Yii::getPathOfAlias('webroot').'/'.$path_dest_image.'/';
		
		if($path_dest_thumb != null)
			$thumb_url= Yii::getPathOfAlias('webroot').'/'.$path_dest_thumb.'/';
		
		$new_file_name = md5(uniqid(microtime(), true)).'.jpg';
		
		if(!is_dir($cover_url)){
			mkdir($cover_url, 0777, TRUE);
		}
		
		if($path_dest_thumb != null && !is_dir($thumb_url)){
			mkdir($thumb_url, 0777, TRUE);
		}
		
		if(!imagejpeg($cover,$cover_url.$new_file_name,100)){			
			throw new CHttpException(405,'Errors imagejpeg cover');			
		}
				
		if($path_dest_thumb != null){
			if(!imagejpeg($thumbnail,$thumb_url.$new_file_name,100))
				throw new CHttpException(405,'Errors imagejpeg thumbnail');		
		}
		
		//elimino i file vecchi			
		imagedestroy($cover);
		
		if($path_dest_thumb != null) imagedestroy($thumbnail); 
		
		//elimino il file da temp
		unlink($filename);
		
		return $new_file_name;
	}
	

}





?>