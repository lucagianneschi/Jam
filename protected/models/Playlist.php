<?php

/**
 * This is the model class for table "playlist".
 *
 * The followings are the available columns in table 'playlist':
 * @property string $id
 * @property integer $active
 * @property string $fromuser
 * @property string $name
 * @property integer $songcounter
 * @property integer $unlimited
 * @property string $createdat
 * @property string $updatedat
 *
 * The followings are the available model relations:
 * @property User $fromuser0
 * @property PlaylistSong[] $playlistSongs
 * @property UserPlaylist[] $userPlaylists
 */
class Playlist extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
	return 'playlist';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
	    array('id, active, fromuser, updatedat', 'required', 'message' => '{attribute} field is missing'),
	    array('active, unlimited', 'boolean', 'message' => 'Invalid {attribute} format'),
	    array('songcounter', 'numerical', 'integerOnly' => true, 'message' => 'Invalid {attribute} format'),
	    array('fromuser', 'length', 'max' => 11, 'message' => 'Invalid {attribute} format'),
	    array('name', 'length', 'max' => 80, 'tooLong' => '{attribute} must be at most 80 characters'),
	    array('name', 'length', 'min' => 2, 'tooShort' => '{attribute} must be at least 2 characters'),
	    array('createdat, updatedat', 'date', 'format' => 'Y-m-d H:m:s'),
	    array('songcounter', 'default', 'value' => 0),
	    array('active', 'default', 'value' => 1),
	    array('name', 'match', 'pattern' => '/^([a-zA-Z\xE0\xE8\xE9\xF9\xF2\xEC\x27]\s?)+$/', 'message' => 'Invalid {attribute}. No special characters allowed'),
	    // The following rule is used by search().
	    // @todo Please remove those attributes that should not be searched.
	    array('id, active, fromuser, name, songcounter, unlimited, createdat, updatedat', 'safe', 'on' => 'search'),
	);
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
	// NOTE: you may need to adjust the relation name and the related
	// class name for the relations automatically generated below.
	return array(
	    'fromuser0' => array(self::BELONGS_TO, 'User', 'fromuser'),
	    'playlistSongs' => array(self::HAS_MANY, 'PlaylistSong', 'id_playlist'),
	    'userPlaylists' => array(self::HAS_MANY, 'UserPlaylist', 'id_playlist'),
	);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
	return array(
	    'id' => Yii::t('string', 'model.id'),
	    'active' => Yii::t('string', 'model.active'),
	    'fromuser' => Yii::t('string', 'model.fromuser'),
	    'name' => Yii::t('string', 'model.member.name'),
	    'songcounter' => Yii::t('string', 'model.playlist.songcounter'),
	    'unlimited' => Yii::t('string', 'model.playlist.unlimited'),
	    'createdat' => Yii::t('string', 'model.createdat'),
	    'updatedat' => Yii::t('string', 'model.updatedat'),
	);
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
	// @todo Please modify the following code to remove attributes that should not be searched.

	$criteria = new CDbCriteria;

	$criteria->compare('id', $this->id, true);
	$criteria->compare('active', $this->active);
	$criteria->compare('fromuser', $this->fromuser, true);
	$criteria->compare('name', $this->name, true);
	$criteria->compare('songcounter', $this->songcounter);
	$criteria->compare('unlimited', $this->unlimited);
	$criteria->compare('createdat', $this->createdat, true);
	$criteria->compare('updatedat', $this->updatedat, true);

	return new CActiveDataProvider($this, array(
	    'criteria' => $criteria,
	));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Playlist the static model class
     */
    public static function model($className = __CLASS__) {
	return parent::model($className);
    }

        /**
     * Set to 0 active field of Playlist instance, return false in case of error
     * @param integer $id id of the playlist
     */
    public function logicalDelete($id) {
	$dbConnection = new DBConnection();
	$connection = $dbConnection->connect();
	if ($connection === false) {
	    return false;
	}
	$sql = "UPDATE playlist
	          SET active = 0
		WHERE id = " . $id;
	$results = mysqli_query($connection, $sql);
	return (!$results) ? false : true;
    }
    
    /**
     * Increment counters of Playlist instance, return false in case of error
     * @param integer $id id of the album to increment the counter
     * @param string counter to be incremented
     */
    public function incrementCounter($id, $counter) {
	$dbConnection = new DBConnection();
	$connection = $dbConnection->connect();
	if ($connection === false) {
	    return false;
	}
	$sql = "UPDATE album
	          SET " . $counter . " = " . $counter . " + 1
		WHERE id = " . $id;
	$results = mysqli_query($connection, $sql);
	return (!$results) ? false : true;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Playlist the static model class
     */
    public function header($id) {
	$dbConnection = new DBConnection();
	$connection = $dbConnection->connect();
	if ($connection === false) {
	    return false;
	}
	$sql = "SELECT s.id id_s,
		       s.updatedat,
		       s.active,
		       s.duration,
		       s.fromuser,
		       s.path,
		       s.record,
		       s.title title_s,
		       u.id id_u,
		       u.username,
		       r.id id_r,
		       r.thumbnail thumbnail_r,
		       r.title title_r,
		       pl.fromuser fromuser_pl,
		       pl.id pl_id,
		       pl.name name_pl
		  FROM playlist pl, playlist_song ps, record r, song s, user u
		 WHERE pl.fromuser = " . $id .
		" AND s.id = ps.id_song 
		   AND pl.fromuser = u.id 
		   AND s.record = r.id 
		   AND ps.id_playlist = pl.id
		   AND s.active = 1
		 LIMIT 15";
	$results = mysqli_query($connection, $sql);
	if (!$results) {
	    return false;
	}
	while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC))
	    $rows[] = $row;
	$playlist = array();
	$songs = array();
	$info = array();
	foreach ($rows as $row) {
	    $info['id'] = $row['pl_id'];
	    $info['name'] = $row['name'];
	    $song['artist'] = $row['username'];
	    $song['duration'] = $row['duration'];
	    $song['path'] = $row['path'];
	    $song['title_record'] = $row['title_r'];
	    $song['title_song'] = $row['title_s'];
	    $song['thumbnail'] = $row['thumbnail_r'];
	    $songs[$row['id_s']] = $song;
	}
	$playlist['info'] = $info;
	$playlist['songs'] = $songs;
	return $playlist;
    }

}
