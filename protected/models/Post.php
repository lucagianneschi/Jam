<?php

/**
 * This is the model class for table "post".
 *
 * The followings are the available columns in table 'post':
 * @property string $id
 * @property integer $active
 * @property integer $commentcounter
 * @property string $fromuser
 * @property integer $lovecounter
 * @property integer $sharecounter
 * @property integer $imagecounter
 * @property double $latitude
 * @property double $longitude
 * @property string $text
 * @property string $touser
 * @property string $createdat
 * @property string $updatedat
 *
 * The followings are the available model relations:
 * @property User $fromuser0
 * @property User $touser0
 * @property PostTag $postTag
 */
class Post extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
	return 'post';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
	    array('createdat, fromuser, text, touser, updatedat', 'required', 'message' => '{attribute} field is missing'),
	    array('active', 'boolean', 'message' => 'Invalid {attribute} format'),
	    array('commentcounter, lovecounter, sharecounter', 'numerical', 'integerOnly' => true, 'message' => 'Invalid {attribute} format'),
	    array('fromuser, touser', 'length', 'max' => 11, 'message' => 'Invalid {attribute} format'),
	    array('latitude, longitude', 'numerical', 'message' => 'Invalid {attribute} format'),
	    array('text', 'length', 'max' => 80, 'tooLong' => '{attribute} must be at most 80 characters'),
	    array('text', 'length', 'min' => 2, 'tooShort' => '{attribute} must be at least 2 characters'),
	    array('createdat, updatedat', 'date', 'format' => 'yyyy-M-d H:m:s'),
	    array('commentcounter, lovecounter, sharecounter', 'default', 'value' => 0),
	    array('active', 'default', 'value' => 1),
	    //    array('text', 'match', 'pattern' => '/^([a-zA-Z\xE0\xE8\xE9\xF9\xF2\xEC\x27]\s?)+$/', 'message' => 'Invalid {attribute}. No special characters allowed'),
	    // The following rule is used by search().
	    // @todo Please remove those attributes that should not be searched.
	    array('id, active, commentcounter, fromuser,latitude, longitude, lovecounter, sharecounter, text, touser, createdat, updatedat', 'safe', 'on' => 'search'),
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
	    'postTag' => array(self::HAS_ONE, 'PostTag', 'id_post'),
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
	    'sharecounter' => Yii::t('string', 'model.sharecounter'),
	    'text' => Yii::t('string', 'model.text'),
	    'touser' => Yii::t('string', 'model.touser'),
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
	$criteria->compare('fromuser', $this->fromuser, true);
	$criteria->compare('latitude', $this->latitude);
	$criteria->compare('longitude', $this->longitude);
	$criteria->compare('lovecounter', $this->lovecounter);
	$criteria->compare('sharecounter', $this->sharecounter);
	$criteria->compare('text', $this->text, true);
	$criteria->compare('touser', $this->touser, true);
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
     * @return Post the static model class
     */
    public static function model($className = __CLASS__) {
	return parent::model($className);
    }

    /**
     * Decrement counters of Post instance, return false in case of error
     * @param integer $id id of the post to increment the counter
     * @param string counter to be incremented
     */
    public function decrementCounter($id, $counter) {
	$dbConnection = new DBConnection();
	$connection = $dbConnection->connect();
	if ($connection === false) {
	    return false;
	}
	$sql = "UPDATE post
	          SET " . $counter . " = " . $counter . " - 1
		WHERE id = " . $id;
	$results = mysqli_query($connection, $sql);
	return (!$results) ? false : true;
    }

    /**
     * Increment counters of Post instance, return false in case of error
     * @param integer $id id of the post to increment the counter
     * @param string counter to be incremented
     */
    public function incrementCounter($id, $counter) {
	$dbConnection = new DBConnection();
	$connection = $dbConnection->connect();
	if ($connection === false) {
	    return false;
	}
	$sql = "UPDATE post
	          SET " . $counter . " = " . $counter . " + 1
		WHERE id = " . $id;
	$results = mysqli_query($connection, $sql);
	return (!$results) ? false : true;
    }

    /**
     * Set to 0 active field of Post instance, return false in case of error
     * @param integer $id id of the post
     */
    public function logicalDelete($id) {
	$dbConnection = new DBConnection();
	$connection = $dbConnection->connect();
	if ($connection === false) {
	    return false;
	}
	$sql = "UPDATE post
	          SET active = 0
		WHERE id = " . $id;
	$results = mysqli_query($connection, $sql);
	return (!$results) ? false : true;
    }

    /**
     * Returns an array of posts (non instances of the model post) for the the profile page
     * @param integer $id id of the user that owns the page
     * @return array $posts array of posts to be displayed on the stream page, false in case of error
     */
    public function stream($id) {
	$dbConnection = new DBConnection();
	$connection = $dbConnection->connect();
	if ($connection === false) {
	    return false;
	}
	$posts = array();
	$sql = "SELECT id,
                   text,
                   createdat
              FROM post
             WHERE active = 1
               AND touser = " . $id .
		" AND fromuser = " . $id .
		"LIMIT 1";
	$results = mysqli_query($connection, $sql);
	if (!$results) {
	    return false;
	}
	while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC))
	    $rows_post[] = $row;
	if (!is_array($rows_post)) {
	    return $posts;
	}
	foreach ($rows_post as $row) {
	    $post['id'] = $row['id'];
	    $post['text'] = $row['text'];
	    $posts[$row['id']] = $post;
	}
	return $posts;
    }

    /**
     * Returns an array of posts (non instances of the model post) for the the profile page
     * @param integer $id id of the user that owns the page
     * @param integer $limit number of album to be displayed
     * @param integer $skip number of album to be skipped
     * @return array $posts array of posts to be displayed on the profile page, false in case of error
     */
    public function profile($id, $limit = 5, $skip = 0) {
	$dbConnection = new DBConnection();
	$connection = $dbConnection->connect();
	if ($connection === false) {
	    return false;
	}
	$posts = array();
	$sql = "SELECT p.id id_p,
                   p.commentcounter,
                   p.lovecounter,
                   p.sharecounter,
                   p.text,
                   p.createdat createdat_p,
		   fu.id id_fu,
		   fu.username username_fu,
		   fu.type type_fu,
		   fu.thumbnail thumbnail_fu,
		   tu.id id_tu,
		   tu.username username_tu,
		   tu.type type_tu,
		   tu.thumbnail thumbnail_tu
              FROM post p, user fu, user tu
             WHERE p.active = 1
               AND p.touser = " . $id .
		" AND p.touser = tu.id
	 ORDER BY p.createdat DESC";
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
	    $rows_post[] = $row;
	if (!is_array($rows_post)) {
	    return $posts;
	}
	foreach ($rows_post as $row) {
	    $fromuser = array();
	    $fromuser['id_fu'] = $row['id_fu'];
	    $fromuser['username_fu'] = $row['username_fu'];
	    $fromuser['type_fu'] = $row['type_fu'];
	    $fromuser['thumbnail_fu'] = $row['thumbnail_fu'];
	    $touser = array();
	    $touser['id_tu'] = $row['id_tu'];
	    $touser['username_tu'] = $row['username_tu'];
	    $touser['type_tu'] = $row['type_tu'];
	    $touser['thumbnail_tu'] = $row['thumbnail_tu'];
	    $post['id_p'] = $row['id_p'];
	    $post['fromuser'] = $fromuser;
	    $post['commentcounter'] = $row['commentcounter'];
	    $post['createdat'] = $row['createdat_p'];
	    $post['lovecounter'] = $row['lovecounter'];
	    $post['sharecounter'] = $row['sharecounter'];
	    $sql_tag = "SELECT u.username, u.type, u.thumbnail, u.id
		          FROM post_tag pt, user u
		         WHERE id_post = " . $row['id_p'] .
		    " AND pt.id_user = u.id";
	    $results_tag = mysqli_query($connection, $sql_tag);
	    if (!$results_tag) {
		return false;
	    }
	    $tags_post = array();
	    $rows_tag_post = array();
	    while ($row_tag_post = mysqli_fetch_array($results_tag, MYSQLI_ASSOC))
		$rows_tag_post[] = $row_tag_post;
	    foreach ($rows_tag_post as $row_tag_post) {
		$user = array();
		$user['id'] = $row_tag_post['id'];
		$user['username'] = $row_tag_post['username'];
		$user['thumbnail'] = $row_tag_post['thumbnail'];
		$user['type'] = $row_tag_post['type'];
		$tags_post[] = $user;
	    }
	    $post['tags'] = $tags_post;
	    $post['text'] = $row['text'];
	    $post['touser'] = $touser;
	    $posts[$row['id_p']] = $post;
	}
	return $posts;
    }

}
