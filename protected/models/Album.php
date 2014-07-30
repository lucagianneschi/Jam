<?php

/**
 * This is the model class for table "album".
 *
 * The followings are the available columns in table 'album':
 * @property string $id
 * @property integer $active
 * @property integer $commentcounter
 * @property string $cover
 * @property string $description
 * @property string $fromuser
 * @property integer $imagecounter
 * @property double $latitude
 * @property double $longitude
 * @property integer $lovecounter
 * @property integer $sharecounter
 * @property string $thumbnail
 * @property string $title
 * @property string $createdat
 * @property string $updatedat
 *
 * The followings are the available model relations:
 * @property User $fromuser0
 * @property AlbumTag $albumTag
 * @property Comment[] $comments
 * @property Image[] $images
 * @property UserAlbum[] $userAlbums
 */
class Album extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
	return 'album';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
	    array('id, active, fromuser, title, createdat, updatedat', 'required', 'message' => '{attribute} field is missing'),
	    array('active', 'boolean', 'message' => 'Invalid {attribute} format'),
	    array('commentcounter, imagecounter, lovecounter, sharecounter', 'numerical', 'integerOnly' => true, 'message' => 'Invalid {attribute} format'),
	    array('latitude, longitude', 'numerical', 'message' => 'Invalid {attribute} format'),
	    array('cover, thumbnail', 'length', 'max' => 100, 'tooLong' => '{attribute} must be at most 100 characters'),
	    array('fromuser', 'length', 'max' => 11, 'message' => 'Invalid {attribute} format'),
	    array('title', 'length', 'max' => 80, 'tooLong' => '{attribute} must be at most 80 characters'),
	    array('title', 'length', 'min' => 2, 'tooShort' => '{attribute} must be at least 2 characters'),
	    array('description', 'length', 'max' => 3000, 'tooLong' => '{attribute} must be at most 3000 characters'),
	    array('description', 'length', 'min' => 2, 'tooShort' => '{attribute} must be at least 2 characters'),
	    array('createdat, updatedat', 'date', 'format' => 'Y-m-d H:m:s'),
	    array('commentcounter, imagecounter, lovecounter, sharecounter', 'default', 'value' => 0),
	    array('active', 'default', 'value' => 1),
	    array('title, description', 'match', 'pattern' => '/^([a-zA-Z\xE0\xE8\xE9\xF9\xF2\xEC\x27]\s?)+$/', 'message' => 'Invalid {attribute}. No special characters allowed'),
	    // The following rule is used by search().
	    // @todo Please remove those attributes that should not be searched.
	    array('id, active, commentcounter, description, fromuser, imagecounter, latitude, longitude, lovecounter, sharecounter, title, createdat, updatedat', 'safe', 'on' => 'search'),
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
	    'albumTag' => array(self::HAS_ONE, 'AlbumTag', 'id_album'),
	    'comments' => array(self::HAS_MANY, 'Comment', 'album'),
	    'images' => array(self::HAS_MANY, 'Image', 'album'),
	    'userAlbums' => array(self::HAS_MANY, 'UserAlbum', 'id_album'),
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
	    'cover' => Yii::t('string', 'model.cover'),
	    'description' => Yii::t('string', 'model.description'),
	    'fromuser' => Yii::t('string', 'model.fromuser'),
	    'imagecounter' => Yii::t('string', 'model.album.imagecounter'),
	    'latitude' => Yii::t('string', 'model.latitude'),
	    'longitude' => Yii::t('string', 'model.longitude'),
	    'lovecounter' => Yii::t('string', 'model.lovecounter'),
	    'sharecounter' => Yii::t('string', 'model.sharecounter'),
	    'thumbnail' => Yii::t('string', 'model.thumbnail'),
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
	$criteria->compare('description', $this->description, true);
	$criteria->compare('fromuser', $this->fromuser, true);
	$criteria->compare('imagecounter', $this->imagecounter);
	$criteria->compare('latitude', $this->latitude);
	$criteria->compare('longitude', $this->longitude);
	$criteria->compare('lovecounter', $this->lovecounter);
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
     * @return Album the static model class
     */
    public static function model($className = __CLASS__) {
	return parent::model($className);
    }

    /**
     * Increment counters of Album instance, return false in case of error
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
     * Set to 0 active field of Album instance, return false in case of error
     * @param integer $id id of the album 
     */
    public function logicalDelete($id) {
	$dbConnection = new DBConnection();
	$connection = $dbConnection->connect();
	if ($connection === false) {
	    return false;
	}
	$sql = "UPDATE album
	          SET active = 0
		WHERE id = " . $id;
	$results = mysqli_query($connection, $sql);
	return (!$results) ? false : true;
    }

    /**
     * Returns an array of album info (no album model) for the the profile page or uploadAlbum page
     * @param integer $id id of the user who own the page
     * @param integer $limit number of album to be displayed
     * @param integer $skip number of album to be skipped
     * @return array $albums array of info to be displayed on the profile page or uploadAlbum page, false in case of error
     */
    public function profileOrUpload($id, $limit = 3, $skip = 0) {
	$dbConnection = new DBConnection();
	$connection = $dbConnection->connect();
	if ($connection === false) {
	    return false;
	}
	$albums = array();
	$sql = "SELECT id,
                   commentcounter,
		   fromuser,
                   imagecounter,
                   lovecounter,
                   sharecounter,
                   thumbnail,
                   title,
                   createdat
              FROM album 
             WHERE active = 1
               AND fromuser = " . $id .
		" ORDER BY createdat DESC";
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
	    $rows_album[] = $row;
	if (!is_array($rows_album)) {
	    return $albums;
	}
	foreach ($rows_album as $row) {
	    $album['id'] = $row['id'];
	    $album['commentcounter'] = $row['commentcounter'];
	    $album['imagecounter'] = $row['imagecounter'];
	    $album['lovecounter'] = $row['lovecounter'];
	    $album['sharecounter'] = $row['sharecounter'];
	    $album['thumbnail'] = $row['thumbnail'];
	    $album['title'] = $row['title'];
	    $albums[$row['id']] = $album;
	}
	return $albums;
    }

}
