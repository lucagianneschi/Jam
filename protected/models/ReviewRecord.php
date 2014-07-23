<?php

/**
 * This is the model class for table "review_rrcord".
 *
 * The followings are the available columns in table 'review_rrcord':
 * @property string $id
 * @property integer $active
 * @property integer $commentcounter
 * @property string $fromuser
 * @property double $latitude
 * @property double $longitude
 * @property string $record
 * @property integer $sharecounter
 * @property string $text
 * @property string $touser
 * @property integer $vote
 * @property string $createdat
 * @property string $updatedat
 *
 * The followings are the available model relations:
 * @property User $fromuser0
 * @property User $touser0
 * @property Record $record0
 */
class ReviewRecord extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
	return 'review_record';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
	    array('id, active, fromuser, record, text, touser, createdat, updatedat, vote', 'required', 'message' => '{attribute} field is missing'),
	    array('active', 'boolean', 'message' => 'Invalid {attribute} format'),
	    array('vote, commentcounter, lovecounter, sharecounter', 'numerical', 'integerOnly' => true, 'message' => 'Invalid {attribute} format'),
	    array('fromuser, record, touser', 'length', 'max' => 11, 'message' => 'Invalid {attribute} format'),
	    array('latitude, longitude', 'numerical', 'message' => 'Invalid {attribute} format'),
	    array('createdat', 'safe'),
	    array('text', 'length', 'max' => 3000, 'tooLong' => '{attribute} must be at most 3000 characters'),
	    array('text', 'length', 'min' => 2, 'tooShort' => '{attribute} must be at least 2 characters'),
	    array('vote', 'numerical', 'max' => 5, 'tooBig' => '{attribute} can be at most 5'),
	    array('vote', 'numerical', 'min' => 1, 'tooSmall' => '{attribute} can be at least 1'),
	    array('active', 'default', 'value' => 1),
	    array('active', 'default', 'value' => 1),
	    array('commentcounter, lovecounter, sharecounter', 'default', 'value' => 0),
	    array('text', 'match', 'pattern' => '/^([a-zA-Z\xE0\xE8\xE9\xF9\xF2\xEC\x27]\s?)+$/', 'message' => 'Invalid {attribute}. No special characters allowed'),
	    // The following rule is used by search().
	    // @todo Please remove those attributes that should not be searched.
	    array('id, active, fromuser, latitude, longitude, record, text, touser, vote, createdat, updatedat', 'safe', 'on' => 'search'),
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
	    'touser0' => array(self::BELONGS_TO, 'User', 'touser'),
	    'record0' => array(self::BELONGS_TO, 'Record', 'record'),
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
	    'fromuser' => Yii::t('string', 'model.fromuser'),
	    'latitude' => Yii::t('string', 'model.latitude'),
	    'longitude' => Yii::t('string', 'model.longitude'),
	    'lovecounter' => Yii::t('string', 'model.lovecounter'),
	    'record' => Yii::t('string', 'model.record'),
	    'sharecounter' => Yii::t('string', 'model.sharecounter'),
	    'text' => Yii::t('string', 'model.review.text'),
	    'touser' => Yii::t('string', 'model.touser'),
	    'vote' => Yii::t('string', 'model.vote'),
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
	$criteria->compare('latitude', $this->latitude);
	$criteria->compare('longitude', $this->longitude);
	$criteria->compare('record', $this->record, true);
	$criteria->compare('text', $this->text, true);
	$criteria->compare('touser', $this->touser, true);
	$criteria->compare('vote', $this->vote);
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
     * @return ReviewRecord the static model class
     */
    public static function model($className = __CLASS__) {
	return parent::model($className);
    }

    /**
     * Returns an array of reviewrecord for the the event page
     * @param integer $id id of the event
     * @return array $reviewrecord array of reviewrecords to be displayed on the event page, false in case of error
     */
    public function recordPage($id) {
	$dbConnection = new DBConnection();
	$connection = $dbConnection->connect();
	if ($connection === false) {
	    return false;
	}
	$reviews = array();
	$sql = "SELECT rr.id id_rr,
                   rr.commentcounter,
		   rr.createdat createdat_rr,
                   rr.lovecounter lovecounter_rr,
		   rr.record record_rr,
                   rr.sharecounter sharecounter_rr,
		   rr.text text_rr,
		   rr.vote vote_rr,
		   u.id id_u,
		   u.username username_u,
		   u.type type_u,
		   u.thumbnail thumbnail_u
              FROM review_record rr, user u
             WHERE rr.active = 1
               AND rr.record =" . $id;
	$results = mysqli_query($connection, $sql);
	if (!$results) {
	    return false;
	}
	while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC))
	    $rows_event_rrview[] = $row;
	if (!is_array($rows_event_rrview)) {
	    return $reviews;
	}
	foreach ($rows_event_rrview as $row) {
	    $fromuser = array();
	    $fromuser['id'] = $row['id_u'];
	    $fromuser['thumbnail'] = $row['thumbnail_u'];
	    $fromuser['type'] = $row['type_u'];
	    $fromuser['username'] = $row['username_u'];
	    $review = array();
	    $review['id'] = $row['id_rr'];
	    $review['commentcounter'] = $row['commentcounter_rr'];
	    $review['fromuser'] = $fromuser;
	    $review['lovecounter'] = $row['lovecounter_rr'];
	    $review['sharecounter'] = $row['sharecounter_rr'];
	    $review['text'] = $row['text_rr'];
	    $review['vote'] = $row['vote_rr'];
	    $reviews[$row['id_rr']] = $review;
	}
	return $reviews;
    }

    /**
     * Returns an array of reviewrecord for the the record page
     * @param integer $id id of the record
     * @param integer $limit number of review to display
     * @param integer $skip number of review to skip
     * @param string $type of the user (SPOTTER/JAMMER/VENUE)
     * @return array $reviewrecord array of reviewrecords to be displayed on the record page, false in case of error
     */
    public function profile($id, $type, $limit = 3, $skip = 0) {
	$dbConnection = new DBConnection();
	$connection = $dbConnection->connect();
	if ($connection === false) {
	    return false;
	}
	$reviews = array();
	$sql = "SELECT rr.id id_rr,
                   rr.commentcounter,
		   rr.createdat createdat_rr,
                   rr.lovecounter lovecounter_rr,
		   rr.record record_rr,
                   rr.sharecounter sharecounter_rr,
		   rr.text text_rr,
		   rr.vote vote_rr,
		   r.title title_r,
		   r.thumbnail thumbnail_r,
		   u.id id_u,
		   u.username username_u,
		   u.type type_u,
		   u.thumbnail thumbnail_u
              FROM review_record rr, user u, record r
             WHERE rr.active = 1";
	if ($type == 'SPOTTER') {
	    $sql .= " AND rr.fromuser = " . $id . "";
	} else {
	    $sql .= " AND rr.touser = " . $id . "";
	}
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
	    $rows_event_rrview[] = $row;
	if (!is_array($rows_event_rrview)) {
	    return $reviews;
	}
	foreach ($rows_event_rrview as $row) {
	    $record = array();
	    $record['title'] = $row['title_r'];
	    $record['thumbnail'] = $row['thumbnail_r'];
	    $fromuser = array();
	    $fromuser['id'] = $row['id_u'];
	    $fromuser['thumbnail'] = $row['thumbnail_u'];
	    $fromuser['type'] = $row['type_u'];
	    $fromuser['username'] = $row['username_u'];
	    $review = array();
	    $review['id'] = $row['id_rr'];
	    $review['commentcounter'] = $row['commentcounter_rr'];
	    $review['fromuser'] = $fromuser;
	    $review['lovecounter'] = $row['lovecounter_rr'];
	    $review['record'] = $record;
	    $review['sharecounter'] = $row['sharecounter_rr'];
	    $review['text'] = $row['text_rr'];
	    $review['vote'] = $row['vote_rr'];
	    $reviews[$row['id_rr']] = $review;
	}
	return $reviews;
    }

}
