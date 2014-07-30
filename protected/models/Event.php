<?php

/**
 * This is the model class for table "event".
 *
 * The followings are the available columns in table 'event':
 * @property string $id
 * @property integer $active
 * @property string $address
 * @property integer $attendeecounter
 * @property integer $cancelledcounter
 * @property string $city
 * @property integer $commentcounter
 * @property string $cover
 * @property string $description
 * @property string $eventdate
 * @property string $fromuser
 * @property integer $invitedcounter
 * @property double $latitude
 * @property string $locationname
 * @property double $longitude
 * @property integer $lovecounter
 * @property integer $refusedcounter
 * @property integer $reviewcounter
 * @property integer $sharecounter
 * @property string $thumbnail
 * @property string $title
 * @property string $createdat
 * @property string $updatedat
 *
 * The followings are the available model relations:
 * @property Comment[] $comments
 * @property User $fromuser0
 * @property EventGenre[] $eventGenres
 * @property EventTag $eventTag
 * @property EventType[] $eventTypes
 * @property ReviewEvent[] $reviewEvents
 * @property UserEvent[] $userEvents
 * 
 * The followings are the public variables
 * @property integer $eventtype
 * @property integer $genre
 * 
 * @property string $image
 * @property integer $cropID
 * @property double $cropX
 * @property double $cropY
 * @property double $cropW
 * @property double $cropH
 */
class Event extends CActiveRecord {

    public $image;
    public $cropID;
    public $cropX;
    public $cropY;
    public $cropW;
    public $cropH;
    public $eventtype;
    public $genre;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
	return 'event';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
	    array('address, city, cover, createdat, description, eventdate, fromuser, image, latitude, locationname, longitude, thumbnail, title, updatedat', 'required'),
	    array('active', 'boolean', 'message' => 'Invalid {attribute} format'),
	    array('attendeecounter, cancelledcounter, commentcounter, invitedcounter, lovecounter, refusedcounter, reviewcounter, sharecounter', 'numerical', 'integerOnly' => true),
	    array('latitude, longitude', 'numerical'),
	    array('eventtype, genre', 'required', 'message' => 'Please enter a {attribute}'),
	    array('image', 'file', 'types' => 'jpg, gif, png', 'allowEmpty' => true, 'on' => 'update'),
	    array('image', 'length', 'max' => 255, 'on' => 'insert,update'),
	    array('address, city, cover, thumbnail', 'length', 'max' => 100),
	    array('title, address, city', 'length', 'max' => 100, 'tooLong' => '{attribute} must be at most 100 characters'),
	    array('title, address, city', 'length', 'min' => 2, 'tooShort' => '{attribute} must be at least 2 characters'),
	    array('fromuser', 'length', 'max' => 11),
	    array('description', 'length', 'max' => 3000, 'tooLong' => '{attribute} must be at most 3000 characters'),
	    array('description', 'length', 'min' => 2, 'tooShort' => '{attribute} must be at least 2 characters'),
	    array('locationname', 'length', 'max' => 80, 'tooLong' => '{attribute} must be at most 80 characters'),
	    array('locationname', 'length', 'min' => 2, 'tooShort' => '{attribute} must be at least 2 characters'),
	    array('createdat, updatedat', 'date', 'format' => 'yyyy-M-d H:m:s'),
	    array('eventdate', 'date', 'format' => 'yyyy-M-d H:m'),
	    array('eventdate', 'dateValid'),
	    array('commentcounter, lovecounter,reviewcounter, sharecounter', 'default', 'value' => 0),
	    array('attendeecounter, cancelledcounter,invitedcounter, refusedcounter', 'default', 'value' => 0),
	    array('active', 'default', 'value' => 1),
	    array('city, description, locationname, title', 'match', 'pattern' => '/^([a-zA-Z\xE0\xE8\xE9\xF9\xF2\xEC\x27]\s?)+$/', 'message' => 'Invalid {attribute}. No special characters allowed'),
	    // The following rule is used by search().
	    // @todo Please remove those attributes that should not be searched.
	    array('id, active, address, attendeecounter, cancelledcounter, city, commentcounter, cover, description, eventdate, fromuser, image, invitedcounter, latitude, locationname, longitude, lovecounter, refusedcounter, reviewcounter, sharecounter, thumbnail, title, createdat, updatedat', 'safe', 'on' => 'search'),
	);
    }

    public function dateValid($attribute) {
	$eventDate = strtotime($this->eventdate);
	if ($eventDate < strtotime('now'))
	    $this->addError($attribute, 'Please enter a correct date');
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
	// NOTE: you may need to adjust the relation name and the related
	// class name for the relations automatically generated below.
	return array(
	    'comments' => array(self::HAS_MANY, 'Comment', 'event'),
	    'fromuser0' => array(self::BELONGS_TO, 'User', 'fromuser'),
	    'eventGenres' => array(self::HAS_MANY, 'EventGenre', 'id_event'),
	    'eventTag' => array(self::HAS_ONE, 'EventTag', 'id_event'),
	    'eventTypes' => array(self::HAS_MANY, 'EventType', 'id_event'),
	    'reviewEvents' => array(self::HAS_MANY, 'ReviewEvent', 'event'),
	    'userEvents' => array(self::HAS_MANY, 'UserEvent', 'id_event'),
	);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
	return array(
	    'id' => Yii::t('string', 'model.id'),
	    'active' => Yii::t('string', 'model.active'),
	    'address' => Yii::t('string', 'model.address'),
	    'attendeecounter' => Yii::t('string', 'model.event.attendeecounter'),
	    'cancelledcounter' => Yii::t('string', 'model.event.cancelledcounter'),
	    'city' => Yii::t('string', 'model.city'),
	    'commentcounter' => Yii::t('string', 'model.commentcounter'),
	    'cover' => Yii::t('string', 'model.cover'),
	    'description' => Yii::t('string', 'model.description'),
	    'eventdate' => Yii::t('string', 'model.event.eventdate'),
	    'eventtype' => Yii::t('string', 'model.type'),
	    'fromuser' => Yii::t('string', 'model.fromuser'),
	    'image' => Yii::t('string', 'view.uploadevent.upload_image'),
	    'genre' => Yii::t('string', 'model.genre'),
	    'invitedcounter' => Yii::t('string', 'model.event.invitedcounter'),
	    'latitude' => Yii::t('string', 'model.latitude'),
	    'locationname' => Yii::t('string', 'model.event.locationname'),
	    'longitude' => Yii::t('string', 'model.longitude'),
	    'lovecounter' => Yii::t('string', 'model.lovecounter'),
	    'refusedcounter' => Yii::t('string', 'model.event.refusedcounter'),
	    'reviewcounter' => Yii::t('string', 'model.reviewcounter'),
	    'sharecounter' => Yii::t('string', 'model.sharecounter'),
	    'thumbnail' => Yii::t('string', 'model.thumbnail'),
	    'title' => Yii::t('string', 'view.uploadevent.event_title'),
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
	$criteria->compare('address', $this->address, true);
	$criteria->compare('attendeecounter', $this->attendeecounter);
	$criteria->compare('cancelledcounter', $this->cancelledcounter);
	$criteria->compare('city', $this->city, true);
	$criteria->compare('commentcounter', $this->commentcounter);
	$criteria->compare('cover', $this->cover, true);
	$criteria->compare('description', $this->description, true);
	$criteria->compare('eventdate', $this->eventdate, true);
	$criteria->compare('fromuser', $this->fromuser, true);
	$criteria->compare('invitedcounter', $this->invitedcounter);
	$criteria->compare('latitude', $this->latitude);
	$criteria->compare('locationname', $this->locationname, true);
	$criteria->compare('longitude', $this->longitude);
	$criteria->compare('lovecounter', $this->lovecounter);
	$criteria->compare('refusedcounter', $this->refusedcounter);
	$criteria->compare('reviewcounter', $this->reviewcounter);
	$criteria->compare('sharecounter', $this->sharecounter);
	$criteria->compare('thumbnail', $this->thumbnail, true);
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
     * @return Event the static model class
     */
    public static function model($className = __CLASS__) {
	return parent::model($className);
    }

    /*
     *  crop before save
     */

    protected function beforeSave() {
	if ($this->image != $this->cover) {
	    $cropImage = new CropImage($this);
	    $dir_corver = Yii::app()->params['users_dir']['users'] . '/' . Yii::app()->session['id'] . '/' . Yii::app()->params['users_dir']['eventcover'];
	    $dir_thumb = Yii::app()->params['users_dir']['users'] . '/' . Yii::app()->session['id'] . '/' . Yii::app()->params['users_dir']['eventcoverthumb'];
	    $image = $cropImage->crop(300, $dir_corver, 100, $dir_thumb);
	    $this->cover = $image;
	    $this->thumbnail = $image;
	}
	return parent::beforeSave(); // don't forget this line!
    }

    /**
     * Increment counters of Event instance, return false in case of error
     * @param integer $id id of the album to increment the counter
     * @param string counter to be incremented
     */
    public function incrementCounter($id, $counter) {
	$dbConnection = new DBConnection();
	$connection = $dbConnection->connect();
	if ($connection === false) {
	    return false;
	}
	$sql = "UPDATE event
	          SET " . $counter . " = " . $counter . " + 1
		WHERE id = " . $id;
	$results = mysqli_query($connection, $sql);
	return (!$results) ? false : true;
    }

    /**
     * Set to 0 active field of Event instance, return false in case of error
     * @param integer $id id of the event
     */
    public function logicalDelete($id) {
	$dbConnection = new DBConnection();
	$connection = $dbConnection->connect();
	if ($connection === false) {
	    return false;
	}
	$sql = "UPDATE event
	          SET active = 0
		WHERE id = " . $id;
	$results = mysqli_query($connection, $sql);
	return (!$results) ? false : true;
    }

    /**
     * Returns an array of event for the the event page: Just one to be displayed
     * @param integer $id id of the event
     * @return array $images array of events to be displayed on the profile page, false in case of error
     */
    public function eventPage($id) {
	$dbConnection = new DBConnection();
	$connection = $dbConnection->connect();
	if ($connection === false) {
	    return false;
	}
	$events = array();
	$sql = "SELECT e.id id_e,
	           e.address address_e,
		   e.city city_e,
		   e.cover,
                   e.commentcounter,
		   e.description,
		   e.eventdate,
		   e.fromuser,
		   e.latitude latitude_e,
                   e.locationname,
		   e.longitude longitude_e,
                   e.lovecounter,
		   e.reviewcounter,
                   e.sharecounter,
                   e.title,
		   u.id id_u,
		   u.username,
		   u.type,
		   u.thumbnail thumbnail_u
              FROM event e, user u
             WHERE e.active = 1
	       AND u.active = 1
               AND e.id = " . $id;
	$results = mysqli_query($connection, $sql);
	if (!$results) {
	    return false;
	}
	while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC))
	    $rows_event[] = $row;
	if (!is_array($rows_event)) {
	    return $events;
	}
	foreach ($rows_event as $row) {
	    $fromuser = array();
	    $fromuser['id'] = $row['id_u'];
	    $fromuser['thumbnail'] = $row['thumbnail_u'];
	    $fromuser['type'] = $row['type'];
	    $fromuser['username'] = $row['username'];
	    $event = array();
	    $event['id'] = $row['id_e'];
	    $event['address'] = $row['address_e'];
	    $event['city'] = $row['city_e'];
	    $event['cover'] = $row['cover'];
	    $event['commentcounter'] = $row['commentcounter'];
	    $event['description'] = $row['description'];
	    $event['eventdate'] = new DateTime($row['eventdate']);
	    $event['fromuser'] = $fromuser;
	    $sql_genre = "SELECT g.genre
		            FROM event_genre eg, genre g
		           WHERE eg.id_event = " . $row['id_e'] .
		    " AND g.id = eg.id_genre";
	    $results_genre_event = mysqli_query($connection, $sql_genre);
	    if (!$results_genre_event) {
		return false;
	    }
	    $genres = array();
	    $rows_genre = array();
	    while ($row_genre = mysqli_fetch_array($results_genre_event, MYSQLI_ASSOC))
		$rows_genre[] = $row_genre;
	    foreach ($rows_genre as $row_genre) {
		$genres[] = $row_genre;
	    }
	    $event['genres'] = $genres;
	    $event['latitude'] = $row['latitude_e'];
	    $event['locationname'] = $row['locationname'];
	    $event['longitude'] = $row['longitude_e'];
	    $event['lovecounter'] = $row['lovecounter'];
	    $event['reviewcounter'] = $row['reviewcounter'];
	    $event['sharecounter'] = $row['sharecounter'];
	    $event['thumbnail_e'] = $row['thumbnail_e'];
	    $event['title'] = $row['title'];
	    $sql_tag = "SELECT u.username, u.thumbnail, u.id, u.type
		          FROM event_tag et, user u
		         WHERE et.id_event = " . $row['id_e'] .
		    " AND et.id_user = u.id";
	    $results_tag = mysqli_query($connection, $sql_tag);
	    if (!$results_tag) {
		return false;
	    }
	    $tags_event = array();
	    $rows_tag_event = array();
	    while ($row_tag_event = mysqli_fetch_array($results_tag, MYSQLI_ASSOC))
		$rows_tag_event[] = $row_tag_event;
	    foreach ($rows_tag_event as $row_tag_event) {
		$user = array();
		$user['id'] = $row_tag_event['id'];
		$user['username'] = $row_tag_event['username'];
		$user['thumbnail'] = $row_tag_event['thumbnail'];
		$user['type'] = $row_tag_event['type'];
		$tags_event[] = $user;
	    }
	    $event['tags'] = $tags_event;
	    $sql_type = "SELECT type
		           FROM event_type et, eventtypes t
		          WHERE et.id_event = " . $row['id_e'] .
		    " AND et.id_type = t.type";
	    $results_type = mysqli_query($connection, $sql_type);
	    if (!$results_type) {
		return false;
	    }
	    $types_event = array();
	    $rows_type_event = array();
	    while ($row_type_event = mysqli_fetch_array($results_type, MYSQLI_ASSOC))
		$rows_type_event[] = $row_type_event;
	    foreach ($rows_type_event as $row_type_event) {
		$types_event[] = $row_type_event;
	    }
	    $event['eventtypes'] = $types_event;
	    $events[$row['id_e']] = $event;
	}
	return $events;
    }

    /**
     * Returns an array of events (non instances of the model event) for the the profile page
     * @param integer $id id of the user that owns the page
     * @param integer $limit number of album to be displayed
     * @param integer $skip number of album to be skipped
     * @return array $events array of events to be displayed on the profile page, false in case of error
     */
    public function profile($id, $limit = 3, $skip = 0) {
	$dbConnection = new DBConnection();
	$connection = $dbConnection->connect();
	if ($connection === false) {
	    return false;
	}
	$events = array();
	$sql = "SELECT id,
	           address,
		   city,
                   commentcounter,
		   eventdate,
                   locationname,
                   lovecounter,
		   reviewcounter,
                   sharecounter,
                   thumbnail,
                   title,
                   createdat
              FROM event  
             WHERE active = 1
               AND fromuser = " . $id .
		" ORDER BY eventdate DESC";
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
	    $rows_event[] = $row;
	if (!is_array($rows_event)) {
	    return $events;
	}
	foreach ($rows_event as $row) {
	    $event['id'] = $row['id'];
	    $event['address'] = $row['address'];
	    $event['city'] = $row['city'];
	    $event['commentcounter'] = $row['commentcounter'];
	    $event['eventdate'] = new DateTime($row['eventdate']);
	    $event['locationname'] = $row['locationname'];
	    $event['lovecounter'] = $row['lovecounter'];
	    $event['reviewcounter'] = $row['reviewcounter'];
	    $event['sharecounter'] = $row['sharecounter'];
	    $sql_tag = "SELECT id_user
		          FROM event_tag
		         WHERE id_event = " . $row['id'];
	    $results_tag = mysqli_query($connection, $sql_tag);
	    if (!$results_tag) {
		return false;
	    }
	    $tags_event = array();
	    $rows_tag_event = array();
	    while ($row_tag_event = mysqli_fetch_array($results_tag, MYSQLI_ASSOC))
		$rows_tag_event[] = $row_tag_event;
	    foreach ($rows_tag_event as $row_tag_event) {
		$tags_event[] = $row_tag_event;
	    }
	    $event['tags'] = $tags_event;
	    $event['thumbnail'] = $row['thumbnail'];
	    $event['title'] = $row['title'];
	    $events[$row['id']] = $event;
	}
	return $events;
    }

}