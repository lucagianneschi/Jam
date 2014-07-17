<?php

/**
 * This is the model class for table "review_event".
 *
 * The followings are the available columns in table 'review_event':
 * @property string $id
 * @property integer $active
 * @property integer $commentcounter
 * @property string $review
 * @property string $fromuser
 * @property double $latitude
 * @property double $longitude
 * @property integer $reviewcounter
 * @property integer $sharecounter
 * @property string $text
 * @property string $touser
 * @property integer $vote
 * @property string $createdat
 * @property string $updatedat
 *
 * The followings are the available model relations:
 * @property User $fromuser0
 * @property Event $review0
 * @property User $touser0
 */
class ReviewEvent extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
	return 'review_event';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.

	return array(
	    array('active, event, fromuser, text, touser, createdat, updatedat, vote', 'required', 'message' => '{attribute} field is missing'),
	    array('active', 'boolean', 'message' => 'Invalid {attribute} format'),
	    array('vote, commentcounter, lovecounter, sharecounter', 'numerical', 'integerOnly' => true, 'message' => 'Invalid {attribute} format'),
	    array('event, fromuser, touser', 'length', 'max' => 11, 'message' => 'Invalid {attribute} format'),
	    array('latitude, longitude', 'numerical', 'message' => 'Invalid {attribute} format'),
	    array('createdat', 'safe'),
	    array('text', 'length', 'max' => 3000, 'tooLong' => '{attribute} must be at most 3000 characters'),
	    array('text', 'length', 'min' => 2, 'tooShort' => '{attribute} must be at least 2 characters'),
	    array('vote', 'numerical', 'max' => 5, 'tooBig' => '{attribute} can be at most 5'),
	    array('vote', 'numerical', 'min' => 1, 'tooSmall' => '{attribute} can be at least 1'),
	    array('active', 'default', 'value' => 1),
	    array('commentcounter, lovecounter, sharecounter', 'default', 'value' => 0),
	    array('text', 'match', 'pattern' => '/^([a-zA-Z\xE0\xE8\xE9\xF9\xF2\xEC\x27]\s?)+$/', 'message' => 'Invalid {attribute}. No special characters allowed'),
	    // The following rule is used by search().
	    // @todo Please remove those attributes that should not be searched.
	    array('id, active, commentcounter, event, fromuser,latitude, longitude, lovecounter, sharecounter, text, touser, vote, createdat, updatedat', 'safe', 'on' => 'search'),
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
	    'event0' => array(self::BELONGS_TO, 'Event', 'event'),
	    'touser0' => array(self::BELONGS_TO, 'User', 'touser'),
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
	    'event' => Yii::t('string', 'model.event'),
	    'fromuser' => Yii::t('string', 'model.fromuser'),
	    'latitude' => Yii::t('string', 'model.latitude'),
	    'longitude' => Yii::t('string', 'model.longitude'),
	    'lovecounter' => Yii::t('string', 'model.lovecounter'),
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
	$criteria->compare('event', $this->event, true);
	$criteria->compare('fromuser', $this->fromuser, true);
	$criteria->compare('latitude', $this->latitude);
	$criteria->compare('longitude', $this->longitude);
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
     * @return ReviewEvent the static model class
     */
    public static function model($className = __CLASS__) {
	return parent::model($className);
    }

    /**
     * Returns an array of reviewevent for the the event page
     * @param integer $id id of the event
     * @return array $reviewevent array of reviewevents to be displayed on the event page, false in case of error
     */
    public function eventPage($id) {
	$dbConnection = new DBConnection();
	$connection = $dbConnection->connect();
	if ($connection === false) {
	    return false;
	}
	$reviews = array();
	$sql = "SELECT re.id id_re,
                   re.commentcounter,
		   re.createdat createdat_re,
                   re.event event_re,
                   re.lovecounter lovecounter_re,
		   re.reviewcounter reviewcounter_re,
                   re.sharecounter sharecounter_re,
		   re.text text_re,
		   re.vote vote_re,
		   u.id id_u,
		   u.username username_u,
		   u.type type_u,
		   u.thumbnail thumbnail_u
              FROM review_event re, user u
             WHERE re.active = 1
               AND re.event =" . $id;
	$results = mysqli_query($connection, $sql);
	if (!$results) {
	    return false;
	}
	while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC))
	    $rows_event_review[] = $row;
	if (!is_array($rows_event_review)) {
	    return $reviews;
	}
	foreach ($rows_event_review as $row) {
	    $fromuser = array();
	    $fromuser['id'] = $row['id_u'];
	    $fromuser['thumbnail'] = $row['thumbnail_u'];
	    $fromuser['type'] = $row['type_u'];
	    $fromuser['username'] = $row['username_u'];
	    $review = array();
	    $review['id'] = $row['id_re'];
	    $review['commentcounter'] = $row['commentcounter_re'];
	    $review['fromuser'] = $fromuser;
	    $review['lovecounter'] = $row['lovecounter_re'];
	    $review['reviewcounter'] = $row['reviewcounter_re'];
	    $review['sharecounter'] = $row['sharecounter_re'];
	    $review['text'] = $row['text_re'];
	    $review['vote'] = $row['vote_re'];
	    $reviews[$row['id_re']] = $review;
	}
	return $reviews;
    }

    /**
     * Returns an array of reviewevent for the the event page
     * @param integer $id id of the event
     * @param string $type of the user (SPOTTER/JAMMER/VENUE)
     * @return array $reviewevent array of reviewevents to be displayed on the event page, false in case of error
     */
    public function profile($id, $type) {
	$dbConnection = new DBConnection();
	$connection = $dbConnection->connect();
	if ($connection === false) {
	    return false;
	}
	$reviews = array();
	$sql = "SELECT re.id id_re,
                   re.commentcounter,
		   re.createdat createdat_re,
                   re.event event_re,
                   re.lovecounter lovecounter_re,
		   re.reviewcounter reviewcounter_re,
                   re.sharecounter sharecounter_re,
		   re.text text_re,
		   re.vote vote_re,
		   e.title title_e,
		   e.thumbnail thumbnail_e,
		   u.id id_u,
		   u.username username_u,
		   u.type type_u,
		   u.thumbnail thumbnail_u
              FROM review_event re, user u, event e
             WHERE re.active = 1";
	if ($type == 'SPOTTER') {
	    $sql .= " AND re.fromuser = " . $id . "";
	} else {
	    $sql .= " AND re.touser = " . $id . "";
	}
	$results = mysqli_query($connection, $sql);
	if (!$results) {
	    return false;
	}
	while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC))
	    $rows_event_review[] = $row;
	if (!is_array($rows_event_review)) {
	    return $reviews;
	}
	foreach ($rows_event_review as $row) {
	    //@todo fare check sulle property richieste per l'event
	    $event = array();
	    $event['title'] = $row['title_e'];
	    $event['thumbnail'] = $row['thumbnail_e'];
	    $fromuser = array();
	    $fromuser['id'] = $row['id_u'];
	    $fromuser['thumbnail'] = $row['thumbnail_u'];
	    $fromuser['type'] = $row['type_u'];
	    $fromuser['username'] = $row['username_u'];
	    $review = array();
	    $review['id'] = $row['id_re'];
	    $review['commentcounter'] = $row['commentcounter_re'];
	    $review['fromuser'] = $fromuser;
	    $review['event'] = $event;
	    $review['lovecounter'] = $row['lovecounter_re'];
	    $review['reviewcounter'] = $row['reviewcounter_re'];
	    $review['sharecounter'] = $row['sharecounter_re'];
	    $review['text'] = $row['text_re'];
	    $review['vote'] = $row['vote_re'];
	    $reviews[$row['id_re']] = $review;
	}
	return $reviews;
    }

}
