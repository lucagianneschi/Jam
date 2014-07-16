<?php

/**
 * This is the model class for table "record".
 *
 * The followings are the available columns in table 'record':
 * @property string $id
 * @property integer $active
 * @property string $buylink
 * @property string $city
 * @property integer $commentcounter
 * @property string $cover
 * @property string $description
 * @property integer $duration
 * @property string $fromuser
 * @property string $label
 * @property double $latitude
 * @property double $longitude
 * @property integer $lovecounter
 * @property integer $reviewcounter
 * @property integer $sharecounter
 * @property integer $songcounter
 * @property string $thumbnail
 * @property string $title
 * @property integer $year
 * @property string $createdat
 * @property string $updatedat
 *
 * The followings are the available model relations:
 * @property Comment[] $comments
 * @property User $fromuser0
 * @property RecordGenre[] $recordGenres
 * @property RecordTag $recordTag
 * @property ReviewRecord[] $reviewRecords
 * @property Song[] $songs
 * @property UserRecord[] $userRecords
 */
class Record extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
	return 'record';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
	    array('id, active, fromuser, title, updatedat', 'required', 'message' => '{attribute} field is missing'),
	    array('active', 'boolean', 'message' => 'Invalid {attribute} format'),
	    array('commentcounter, duration, lovecounter, reviewcounter, sharecounter, songcounter, year', 'numerical', 'integerOnly' => true, 'message' => 'Invalid {attribute} format'),
	    array('latitude, longitude', 'numerical', 'message' => 'Invalid {attribute} format'),
	    array('buylink', 'url', 'message' => 'Invalid URL for {attribute}'),
	    array('buylink, city, cover, label, thumbnail', 'length', 'max' => 100, 'message' => 'Invalid {attribute} format'),
	    array('fromuser', 'length', 'max' => 11, 'message' => 'Invalid {attribute} format'),
	    array('description', 'length', 'max' => 3000, 'tooLong' => '{attribute} must be at most 3000 characters'),
	    array('description', 'length', 'min' => 2, 'tooShort' => '{attribute} must be at least 2 characters'),
	    array('title', 'length', 'max' => 80, 'tooLong' => '{attribute} must be at most 80 characters'),
	    array('title', 'length', 'min' => 2, 'tooShort' => '{attribute} must be at least 2 characters'),
	    array('year', 'date', 'format' => 'Y'),
	    array('createdat, updatedat', 'date', 'format' => 'Y-m-d H:m:s'),
	    array('commentcounter, lovecounter, reviewcounter, sharecounter', 'default', 'value' => 0),
	    array('active', 'default', 'value' => 1),
	    array('city, description, title', 'match', 'pattern' => '/^([a-zA-Z\xE0\xE8\xE9\xF9\xF2\xEC\x27]\s?)+$/', 'message' => 'Invalid {attribute}. No special characters allowed'),
	    // The following rule is used by search().
	    // @todo Please remove those attributes that should not be searched.
	    array('id, active, buylink, city, commentcounter, cover, description, duration, fromuser, label, latitude, longitude, lovecounter, reviewcounter, sharecounter, songcounter, thumbnail, title, year, createdat, updatedat', 'safe', 'on' => 'search'),
	);
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
	// NOTE: you may need to adjust the relation name and the related
	// class name for the relations automatically generated below.
	return array(
	    'comments' => array(self::HAS_MANY, 'Comment', 'record'),
	    'fromuser0' => array(self::BELONGS_TO, 'User', 'fromuser'),
	    'recordGenres' => array(self::HAS_MANY, 'RecordGenre', 'id_record'),
	    'recordTag' => array(self::HAS_ONE, 'RecordTag', 'id_record'),
	    'reviewRecords' => array(self::HAS_MANY, 'ReviewRecord', 'record'),
	    'songs' => array(self::HAS_MANY, 'Song', 'record'),
	    'userRecords' => array(self::HAS_MANY, 'UserRecord', 'id_record'),
	);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
	return array(
	    'id' => Yii::t('string', 'model.id'),
	    'active' => Yii::t('string', 'model.active'),
	    'buylink' => Yii::t('string', 'model.record.buylink'),
	    'city' => Yii::t('string', 'model.city'),
	    'commentcounter' => Yii::t('string', 'model.commentcounter'),
	    'cover' => Yii::t('string', 'model.cover'),
	    'description' => Yii::t('string', 'model.description'),
	    'duration' => Yii::t('string', 'model.duration'),
	    'fromuser' => Yii::t('string', 'model.fromuser'),
	    'label' => Yii::t('string', 'model.record.label'),
	    'latitude' => Yii::t('string', 'model.latitude'),
	    'longitude' => Yii::t('string', 'model.longitude'),
	    'lovecounter' => Yii::t('string', 'model.lovecounter'),
	    'reviewcounter' => Yii::t('string', 'model.reviewcounter'),
	    'sharecounter' => Yii::t('string', 'model.sharecounter'),
	    'songcounter' => Yii::t('string', 'model.songcounter'),
	    'thumbnail' => Yii::t('string', 'model.thumbnail'),
	    'title' => Yii::t('string', 'model.title'),
	    'year' => Yii::t('string', 'model.record.year'),
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
	$criteria->compare('buylink', $this->buylink, true);
	$criteria->compare('city', $this->city, true);
	$criteria->compare('commentcounter', $this->commentcounter);
	$criteria->compare('cover', $this->cover, true);
	$criteria->compare('description', $this->description, true);
	$criteria->compare('duration', $this->duration);
	$criteria->compare('fromuser', $this->fromuser, true);
	$criteria->compare('label', $this->label, true);
	$criteria->compare('latitude', $this->latitude);
	$criteria->compare('longitude', $this->longitude);
	$criteria->compare('lovecounter', $this->lovecounter);
	$criteria->compare('reviewcounter', $this->reviewcounter);
	$criteria->compare('sharecounter', $this->sharecounter);
	$criteria->compare('songcounter', $this->songcounter);
	$criteria->compare('thumbnail', $this->thumbnail, true);
	$criteria->compare('title', $this->title, true);
	$criteria->compare('year', $this->year);
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
     * @return Record the static model class
     */
    public static function model($className = __CLASS__) {
	return parent::model($className);
    }

    /**
     * Returns an array of record for the the record page: Just one to be displayed
     * @param integer $id id of the 
     * @return array $images array of records to be displayed on the profile page, false in case of error
     */
    public function recordPage($id) {
	$dbConnection = new DBConnection();
	$connection = $dbConnection->connect();
	if ($connection === false) {
	    return false;
	}
	$records = array();
	$sql = "SELECT r.id id_r,
	           buylink,
		   city,
                   commentcounter,
		   cover,
		   fromuser,
                   lovecounter,
		   reviewcounter,
                   sharecounter,
                   title,
		   year,
                   createdat,
		   u.id id_u,
		   username,
		   type,
		   thumbnail
              FROM record r, user u
             WHERE active = 1
               AND r.id =" . $id;
	$results = mysqli_query($connection, $sql);
	if (!$results) {
	    return false;
	}
	while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC))
	    $rows_record[] = $row;
	if (!is_array($rows_record)) {
	    return $records;
	}
	foreach ($rows_record as $row) {
	    //vedere se tutti i campi dello user sono OK
	    $fromuser = array();
	    $fromuser['id'] = $row['id_u'];
	    $fromuser['thumbnail'] = $row['thumbnail'];
	    $fromuser['type'] = $row['type'];
	    $fromuser['username'] = $row['username'];
	    $record = array();
	    $record['id'] = $row['id_r'];
	    $record['buylink'] = $row['buylink'];
	    $record['city'] = $row['city'];
	    $record['commentcounter'] = $row['commentcounter'];
	    $record['fromuser'] = $fromuser;
	    //query sul genre
	    $sql_genre = "SELECT id_genre
		            FROM record_genre
		           WHERE id_record = " . $row['id_r'];
	    $results_genre_record = mysqli_query($connection, $sql_genre);
	    if (!$results_genre_record) {
		return false;
	    }
	    $genres = array();
	    $rows_genre = array();
	    while ($row_genre = mysqli_fetch_array($results_genre_record, MYSQLI_ASSOC))
		$rows_genre[] = $row_genre;
	    foreach ($rows_genre as $row_genre) {
		$genres[] = $row_genre;
	    }
	    $record['genres'] = $genres;
	    $record['label'] = $row['label'];
	    $record['lovecounter'] = $row['lovecounter'];
	    $record['reviewcounter'] = $row['reviewcounter'];
	    $record['sharecounter'] = $row['sharecounter'];
	    $record['title'] = $row['title'];
	    //query sul tag
	    $sql_tag = "SELECT id_user
		          FROM record_tag
		         WHERE id = " . $row['id_r'];
	    $results_tag = mysqli_query($connection, $sql_tag);
	    if (!$results_tag) {
		return false;
	    }
	    $tags_record = array();
	    $rows_tag_record = array();
	    while ($row_tag_record = mysqli_fetch_array($results_tag, MYSQLI_ASSOC))
		$rows_tag_record[] = $row_tag_record;
	    foreach ($rows_tag_record as $row_tag_record) {
		$tags_record[] = $row_tag_record;
	    }
	    $record['tags'] = $tags_record;
	    //query sul tag
	    $sql_type = "SELECT id_type
		           FROM record_type
		          WHERE id = " . $row['id_r'];
	    $results_type = mysqli_query($connection, $sql_type);
	    if (!$results_type) {
		return false;
	    }
	    $types_record = array();
	    $rows_type_record = array();
	    while ($row_type_record = mysqli_fetch_array($results_type, MYSQLI_ASSOC))
		$rows_type_record[] = $row_tag_record;
	    foreach ($rows_tag_record as $row_type_record) {
		$types_record[] = $row_type_record;
	    }
	    $record['recordtypes'] = $types_record;
	    $record['year'] = $row['year'];
	    $records[$row['id']] = $record;
	}
	return $records;
    }

    /**
     * Returns an array of record (non instances of the model record) for the the profile page
     * @param integer $id id of the user that owns the page
     * @param integer $limit number of album to be displayed
     * @param integer $skip number of album to be skipped
     * @return array $records array of records to be displayed on the profile page, false in case of error
     * @todo recuperare i featuring dalla recordTag
     */
    public function profileorUpload($id, $limit = 3, $skip = 0) {
	$dbConnection = new DBConnection();
	$connection = $dbConnection->connect();
	if ($connection === false) {
	    return false;
	}
	$records = array();
	$sql = "SELECT id,
                   commentcounter,
                   lovecounter,
		   reviewcounter,
                   sharecounter,
                   thumbnail,
                   title
              FROM record  
             WHERE active = 1
               AND fromuser =" . $id .
		"ORDER BY createdat DES
             LIMIT" . $limit .
		"SKIP" . $skip;
	$results = mysqli_query($connection, $sql);
	if (!$results) {
	    return false;
	}
	while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC))
	    $rows_record[] = $row;
	if (!is_array($rows_record)) {
	    return $records;
	}
	foreach ($rows_record as $row) {
	    $record['id'] = $row['id'];
	    $record['commentcounter'] = $row['commentcounter'];
	    $record['lovecounter'] = $row['lovecounter'];
	    $record['reviewcounter'] = $row['reviewcounter'];
	    $record['sharecounter'] = $row['sharecounter'];
	    $record['thumbnail'] = $row['thumbnail'];
	    $record['title'] = $row['title'];
	    $records[$row['id']] = $record;
	}
	return $records;
    }

}
