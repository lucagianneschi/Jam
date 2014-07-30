<?php

/**
 * 
 * servizio di gestione delle cartelle, valido in fase di creazione e reperimento path e URL
 * 
 * @author		Luca Gianneschi
 * @version		0.1
 * @since		2014
 * @copyright		Jamyourself.com 2013	
 * @warning
 * @bug
 * @todo                
 */

/**
 * Classe dedicata alla realizzazione delle cartelle, a reperire path di immagini e mp3
 */
class FileManagerService {

    /**
     * get album cover path or thumb
     * 
     * @param int $userId user id
     * @param int $photoId photo id
     * @param bool no to get the cover path, yes to get the thumbnail
     * @return  path if found
     */
    public function getAlbumCoverPath($userId, $photoId, $thumb = false) {
	$pathInnerString = ($thumb == false) ? Yii::app()->params['users_dir']['albumcover'] : Yii::app()->params['users_dir']['albumcoverthumb'];
	$path = Yii::app()->params['users_dir'] . DIRECTORY_SEPARATOR . $userId . DIRECTORY_SEPARATOR . $pathInnerString . DIRECTORY_SEPARATOR . $photoId;
	if (!file_exists($path)) {
	    return false;
	}
	return $path;
    }

    /**
     * get event cover path
     * 
     * @param int $userId user id
     * @param int $photoId photo id
     * @return  path if found
     */
    public function getEventCoverPath($userId, $photoId, $thumb = false) {
	$pathInnerString = ($thumb == false) ? Yii::app()->params['users_dir']['eventcover'] : Yii::app()->params['users_dir']['eventcoverthumb'];
	$path = Yii::app()->params['users_dir'] . DIRECTORY_SEPARATOR . $userId . DIRECTORY_SEPARATOR . $pathInnerString . DIRECTORY_SEPARATOR . $photoId;
	if (!file_exists($path)) {
	    return false;
	}
	return $path;
    }

    /**
     * get photo path
     * 
     * @param int $userId user id
     * @param int $photoId photo id
     * @return  path if found
     */
    public function getPhotoPath($userId, $photoId) {
	$path = Yii::app()->params['users_dir'] . $userId . DIRECTORY_SEPARATOR . Yii::app()->params['users_dir']['photos'] . DIRECTORY_SEPARATOR . $photoId;
	if (!file_exists($path)) {
	    return false;
	}
	return $path;
    }

    /**
     * get record cover path
     * 
     * @param int $userId user id
     * @param int $photoId photo id
     * @return  path if found
     */
    public function getRecordCoverPath($userId, $photoId, $thumb = false) {
	$pathInnerString = ($thumb == false) ? Yii::app()->params['users_dir']['recordcover'] : Yii::app()->params['users_dir']['recordcoverthumb'];
	$path = Yii::app()->params['users_dir'] . DIRECTORY_SEPARATOR . $userId . DIRECTORY_SEPARATOR . $pathInnerString . DIRECTORY_SEPARATOR . $photoId;
	if (!file_exists($path)) {
	    return false;
	}
	return $path;
    }

        /**
     * get record cover path
     * 
     * @param int $userId user id
     * @param int $photoId photo id
     * @return  path if found
     */
    public function getUserAvatarPath($userId, $photoId, $thumb = false) {
	$pathInnerString = ($thumb == false) ? Yii::app()->params['users_dir']['avatar'] : Yii::app()->params['users_dir']['thumbnail'];
	$path = Yii::app()->params['users_dir'] . DIRECTORY_SEPARATOR . $userId . DIRECTORY_SEPARATOR . $pathInnerString . DIRECTORY_SEPARATOR . $photoId;
	if (!file_exists($path)) {
	    return false;
	}
	return $path;
    }
    
    /**
     * get song path
     * 
     * @param int $userId user id
     * @param int $songId photo id
     * @return  path if found
     */
    public function getSongPath($userId, $songId) {
	$path = Yii::app()->params['users_dir'] . DIRECTORY_SEPARATOR . $userId . DIRECTORY_SEPARATOR . Yii::app()->params['users_dir']['songs'] . DIRECTORY_SEPARATOR . $songId;
	if (!file_exists($path)) {
	    return false;
	}
	return $path;
    }

    /**
     * get domain name
     * 
     * @param int $userId user id
     * @param int $photoId photo id
     * @return  domain name
     */
    public function getDomainName() {
	return $_SERVER['SERVER_NAME'];
    }

}

?>