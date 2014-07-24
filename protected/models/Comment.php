<?php

/**
 * This is the model class for table "comment".
 *
 * The followings are the available columns in table 'comment':
 * @property string $id
 * @property integer $active
 * @property string $album
 * @property string $comment
 * @property integer $commentcounter
 * @property string $event
 * @property string $fromuser
 * @property string $image
 * @property double $latitude
 * @property double $longitude
 * @property integer $lovecounter
 * @property string $record
 * @property string $reviewevent
 * @property string $reviewrecord
 * @property integer $sharecounter
 * @property string $song
 * @property string $text
 * @property string $touser
 * @property string $video
 * @property string $createdat
 * @property string $updatedat
 *
 * The followings are the available model relations:
 * @property Album $album0
 * @property User $fromuser0
 * @property User $touser0
 * @property Event $event0
 * @property Image $image0
 * @property Record $record0
 * @property ReviewEvent $reviewevent0
 * @property ReviewRecord $reviewrecord0
 * @property Song $song0
 * @property Video $video0
 * @property Comment $comment0
 * @property Comment[] $comments
 * @property CommentTag $commentTag
 */
class Comment extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
	return 'comment';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
	    array('active, createdat, fromuser, text, touser, updatedat', 'required', 'message' => '{attribute} field is missing'),
	    array('active', 'boolean', 'message' => 'Invalid {attribute} format'),
	    array('commentcounter, lovecounter, sharecounter', 'numerical', 'integerOnly' => true, 'message' => 'Invalid {attribute} format'),
	    array('latitude, longitude', 'numerical', 'message' => 'Invalid {attribute} format'),
	    array('album, comment, event, fromuser, image, record, reviewevent, reviewrecord, song, touser, video', 'length', 'max' => 11, 'message' => 'Invalid {attribute} format'),
	    array('createdat, updatedat', 'date', 'format' => 'yyyy-M-d H:m:s'),
	    array('text', 'length', 'max' => 3000, 'tooLong' => '{attribute} must be at most 3000 characters'),
	    array('text', 'length', 'min' => 2, 'tooShort' => '{attribute} must be at least 2 characters'),
	    array('commentcounter, lovecounter, sharecounter', 'default', 'value' => 0),
	    array('active', 'default', 'value' => 1),
	//    array('text', 'match', 'pattern' => '/^([a-zA-Z\xE0\xE8\xE9\xF9\xF2\xEC\x27]\s?)+$/', 'message' => 'Invalid {attribute}. No special characters allowed'),
	    // The following rule is used by search().
	    // @todo Please remove those attributes that should not be searched.
	    array('id, active, comment, comment, commentcounter, event, fromuser, image, latitude, longitude, lovecounter, record, reviewevent,reviewrecord, sharecounter, song, text, touser, video, createdat, updatedat', 'safe', 'on' => 'search'),
	);
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
	// NOTE: you may need to adjust the relation name and the related
	// class name for the relations automatically generated below.
	return array(
	    'album0' => array(self::BELONGS_TO, 'Album', 'comment'),
	    'fromuser0' => array(self::BELONGS_TO, 'User', 'fromuser'),
	    'touser0' => array(self::BELONGS_TO, 'User', 'touser'),
	    'event0' => array(self::BELONGS_TO, 'Event', 'event'),
	    'image0' => array(self::BELONGS_TO, 'Image', 'image'),
	    'record0' => array(self::BELONGS_TO, 'Record', 'record'),
	    'reviewevent0' => array(self::BELONGS_TO, 'ReviewEvent', 'reviewevent'),
	    'reviewrecord0' => array(self::BELONGS_TO, 'ReviewRecord', 'reviewrecord'),
	    'song0' => array(self::BELONGS_TO, 'Song', 'song'),
	    'video0' => array(self::BELONGS_TO, 'Video', 'video'),
	    'comment0' => array(self::BELONGS_TO, 'Comment', 'comment'),
	    'comments' => array(self::HAS_MANY, 'Comment', 'comment'),
	    'commentTag' => array(self::HAS_ONE, 'CommentTag', 'id_comment'),
	);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
	return array(
	    'id' => Yii::t('string', 'model.id'),
	    'active' => Yii::t('string', 'model.active'),
	    'album' => Yii::t('string', 'model.album'),
	    'comment' => Yii::t('string', 'model.comment'),
	    'commentcounter' => Yii::t('string', 'model.commentcounter'),
	    'event' => Yii::t('string', 'model.event'),
	    'fromuser' => Yii::t('string', 'model.fromuser'),
	    'image' => Yii::t('string', 'model.image'),
	    'latitude' => Yii::t('string', 'model.latitude'),
	    'longitude' => Yii::t('string', 'model.longitude'),
	    'lovecounter' => Yii::t('string', 'model.lovecounter'),
	    'record' => Yii::t('string', 'model.record'),
	    'reviewevent' => Yii::t('string', 'model.comment.reviewevent'),
	    'reviewrecord' => Yii::t('string', 'model.comment.reviewrecord'),
	    'sharecounter' => Yii::t('string', 'model.sharecounter'),
	    'song' => Yii::t('string', 'model.song'),
	    'text' => Yii::t('string', 'model.text'),
	    'touser' => Yii::t('string', 'model.touser'),
	    'video' => Yii::t('string', 'model.video'),
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
	$criteria->compare('album', $this->album, true);
	$criteria->compare('comment', $this->comment, true);
	$criteria->compare('commentcounter', $this->commentcounter);
	$criteria->compare('event', $this->event, true);
	$criteria->compare('fromuser', $this->fromuser, true);
	$criteria->compare('image', $this->image, true);
	$criteria->compare('latitude', $this->latitude);
	$criteria->compare('longitude', $this->longitude);
	$criteria->compare('lovecounter', $this->lovecounter);
	$criteria->compare('record', $this->record, true);
	$criteria->compare('reviewevent', $this->reviewevent, true);
	$criteria->compare('reviewrecord', $this->reviewrecord, true);
	$criteria->compare('sharecounter', $this->sharecounter);
	$criteria->compare('song', $this->song, true);
	$criteria->compare('text', $this->text, true);
	$criteria->compare('touser', $this->touser, true);
	$criteria->compare('video', $this->video, true);
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
     * @return Comment the static model class
     */
    public static function model($className = __CLASS__) {
	return parent::model($className);
    }

    /**
     * Returns an array of c info (no comment model) for the the profile page or uploadAlbum page
     * @param integer $id id of the user who own the page
     * @param integer $limit number of comment to be displayed
     * @param integer $skip number of comment to be skipped
     * @return array $comments array of info to be displayed on any page
     */
    public function anyPage($id, $classtype, $limit = 3, $skip = 0) {
	$dbConnection = new DBConnection();
	$connection = $dbConnection->connect();
	if ($connection === false) {
	    return false;
	}
	$comments = array();
	$sql = "SELECT c.id id_c,
                   c.commentcounter,
		   c.fromuser,
                   c.lovecounter,
                   c.sharecounter,
		   c.text,
		   u.id id_u,
                   u.thumbnail,
		   u.type,
                   u.username,
                   c.createdat createdat_c
              FROM comment c,user u
             WHERE c.active = 1
               AND " . $classtype . " = " . $id .
	" ORDER BY c.createdat DESC";
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
	    $rows_comment[] = $row;
	if (!is_array($rows_comment)) {
	    return $comments;
	}
	foreach ($rows_comment as $row) {
	    $fromuser = array();
	    $fromuser['id'] = $row['id_u'];
	    $fromuser['thumbnail'] = $row['thumbnail'];
	    $fromuser['type'] = $row['type'];
	    $fromuser['username'] = $row['username'];
	    $comment['id'] = $row['id_c'];
	    $comment['commentcounter'] = $row['commentcounter'];
	    $comment['fromuser'] = $fromuser;
	    $comment['lovecounter'] = $row['lovecounter'];
	    $comment['sharecounter'] = $row['sharecounter'];
	    $sql_tag = "SELECT id_user
		  FROM comment_tag
		 WHERE id_comment = " . $row['id_c'];
	    $results_comment_tag = mysqli_query($connection, $sql_tag);
	    if (!$results_comment_tag) {
		return false;
	    }
	    $tags_comment = array();
	    $rows_tag_comment = array();
	    while ($row_tag_comment = mysqli_fetch_array($results_comment_tag, MYSQLI_ASSOC))
		$rows_tag_comment[] = $row_tag_comment;
	    foreach ($rows_tag_comment as $row_tag_comment) {
		array_push($tags_comment, $rows_tag_comment['id_user']);
	    }
	    $comment['tags'] = $tags_comment;
	    $comment['text'] = $row['text'];
	    $comments[$row['id_c']] = $comment;
	}
	return $comments;
    }

}
