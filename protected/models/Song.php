<?php

/**
 * This is the model class for table "song".
 *
 * The followings are the available columns in table 'song':
 * @property string $id
 * @property integer $active
 * @property integer $commentcounter
 * @property integer $counter
 * @property integer $duration
 * @property integer $fromuser
 * @property double $latitude
 * @property double $longitude
 * @property integer $lovecounter
 * @property string $path
 * @property integer $position
 * @property integer $record
 * @property integer $sharecounter
 * @property string $title
 * @property string $createdat
 * @property string $updatedat
 */
class Song extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
	return 'song';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
	    array('id, active, fromuser, path, record, title, updatedat', 'required', 'message' => '{attribute} field is missing'),
	    array('active', 'boolean', 'message' => 'Invalid {attribute} format'),
	    array('id, commentcounter, counter, duration, fromuser, lovecounter, position, record, sharecounter', 'numerical', 'integerOnly' => true, 'message' => 'Invalid {attribute} format'),
	    array('latitude, longitude', 'numerical', 'message' => 'Invalid {attribute} format'),
	    array('path, title', 'length', 'max' => 100, 'message' => 'Invalid {attribute} format'),
	    array('createdat, updatedat', 'date', 'format' => 'Y-m-d H:m:s'),
	    array('title', 'length', 'max' => 80, 'tooLong' => '{attribute} must be at most 80 characters'),
	    array('title', 'length', 'min' => 2, 'tooShort' => '{attribute} must be at least 2 characters'),
	    array('commentcounter, lovecounter', 'default', 'value' => 0),
	    array('active', 'default', 'value' => 1),
	    array('title', 'match', 'pattern' => '/^([a-zA-Z\xE0\xE8\xE9\xF9\xF2\xEC\x27]\s?)+$/', 'message' => 'Invalid {attribute}. No special characters allowed'),
	    // The following rule is used by search().
	    // @todo Please remove those attributes that should not be searched.
	    array('id, active, commentcounter, duration, fromuser, latitude, longitude, lovecounter, path, position, record, sharecounter, title, createdat, updatedat', 'safe', 'on' => 'search'),
	);
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
	// NOTE: you may need to adjust the relation name and the related
	// class name for the relations automatically generated below.
	return array(
	);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
	return array(
	    'id' => Yii::t('string', 'model.id'),
	    'active' => Yii::t('string', 'model.active'),
	    'commentcounter' => Yii::t('string', 'model.commentcounter'),
	    'duration' => Yii::t('string', 'model.duration'),
	    'fromuser' => Yii::t('string', 'model.fromuser'),
	    'latitude' => Yii::t('string', 'model.latitude'),
	    'longitude' => Yii::t('string', 'model.longitude'),
	    'lovecounter' => Yii::t('string', 'model.lovecounter'),
	    'path' => Yii::t('string', 'model.path'),
	    'position' => Yii::t('string', 'model.song.position'),
	    'record' => Yii::t('string', 'model.record'),
	    'sharecounter' => Yii::t('string', 'model.sharecounter'),
	    'title' => Yii::t('string', 'model.title'),
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
	$criteria->compare('commentcounter', $this->commentcounter);
	$criteria->compare('duration', $this->duration);
	$criteria->compare('fromuser', $this->fromuser);
	$criteria->compare('latitude', $this->latitude);
	$criteria->compare('longitude', $this->longitude);
	$criteria->compare('lovecounter', $this->lovecounter);
	$criteria->compare('path', $this->path, true);
	$criteria->compare('position', $this->position);
	$criteria->compare('record', $this->record);
	$criteria->compare('sharecounter', $this->sharecounter);
	$criteria->compare('title', $this->title, true);
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
     * @return Song the static model class
     */
    public static function model($className = __CLASS__) {
	return parent::model($className);
    }

    /**
     * Returns an array of song for the header, info to be displayed in the player
     * @param integer $id id of the album that contains the songs
     * @return array $songs array of songs to be displayed on the profile page, false in case of error
     */
    function selectSongsInPlaylist($id) {
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
		       pl.fromuser fromuser_pl
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
	$songs = array();
	foreach ($rows as $row) {
	    $song['artist'] = $row['username'];
	    $song['duration'] = $row['duration'];
	    $song['path'] = $row['path'];
	    $song['title_record'] = $row['title_r'];
	    $song['title_song'] = $row['title_s'];
	    $song['thumbnail'] = $row['thumbnail_r'];
	    $songs[$row['id_s']] = $song;
	}
	return $songs;
    }

    /**
     * Returns an array of song for the the profile page
     * @param integer $id id of the album that contains the songs
     * @param integer $limit number of album to be displayed
     * @return array $songs array of songs to be displayed on the profile page, false in case of error
     */
    public function profileOrRecordPage($id, $limit = 15, $skip = 0) {
	$dbConnection = new DBConnection();
	$connection = $dbConnection->connect();
	if ($connection === false) {
	    return false;
	}
	$songs = array();
	$sql = "SELECT id,
                   commentcounter,
		   duration,
                   lovecounter,
		   path,
		   position,
                   sharecounter,
		   title,
                   createdat
              FROM song 
             WHERE active = 1
               AND record =" . $id .
		" ORDER BY position ASC";
	if ($skip != 0) {
	    $sql .= " LIMIT " . $skip . ", " . $limit;
	} else {
	    $sql .= " LIMIT " . $limit;
	}
	$results = mysqli_query($connection, $sql);
	if (!$results) {
	    return false;
	}
	while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC))
	    $rows_song[] = $row;
	if (!is_array($rows_song)) {
	    return $songs;
	}
	foreach ($rows_song as $row) {
	    $song['id'] = $row['id'];
	    $song['commentcounter'] = $row['commentcounter'];
	    $song['duration'] = $row['duration'];
	    $song['lovecounter'] = $row['lovecounter'];
	    $song['path'] = $row['path'];
	    $song['position'] = $row['position'];
	    $song['sharecounter'] = $row['sharecounter'];
	    $song['title'] = $row['title'];
	    $songs[$row['id']] = $song;
	}
	return $songs;
    }

}
