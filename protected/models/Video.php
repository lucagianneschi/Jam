<?php

/**
 * This is the model class for table "video".
 *
 * The followings are the available columns in table 'video':
 * @property string $id
 * @property integer $active
 * @property string $author
 * @property string $cover
 * @property string $description
 * @property integer $duration
 * @property integer $fromuser
 * @property integer $lovecounter
 * @property string $thumbnail
 * @property string $title
 * @property string $url
 * @property string $createdat
 * @property string $updatedat
 */
class Video extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
	return 'video';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
	    array('id, active, author, fromuser, lovecounter, thumbnail, title, url, createdat, updatedat, cover', 'required', 'message' => '{attribute} field is missing'),
	    array('active', 'boolean', 'message' => 'Invalid {attribute} format'),
	    array('duration, fromuser, lovecounter', 'numerical', 'integerOnly' => true, 'message' => 'Invalid {attribute} format'),
	    array('author, thumbnail, title, url, cover', 'length', 'max' => 100, 'tooLong' => '{attribute} must be at most 100 characters'),
	    array('description', 'length', 'max' => 3000, 'tooLong' => '{attribute} must be at most 3000 characters'),
	    array('createdat, updatedat', 'date', 'format' => 'Y-m-d H:m:s'),
	    array('commentcounter, lovecounter', 'default', 'value' => 0),
	    array('active', 'default', 'value' => 1),
	    array('author, description, title', 'match', 'pattern' => '/^([a-zA-Z\xE0\xE8\xE9\xF9\xF2\xEC\x27]\s?)+$/', 'message' => 'Invalid {attribute}. No special characters allowed'),
	    // The following rule is used by search().
	    // @todo Please remove those attributes that should not be searched.
	    array('id, active, author, description, duration, fromuser, lovecounter, thumbnail, title, url, createdat, updatedat, cover', 'safe', 'on' => 'search'),
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
	    'author' => Yii::t('string', 'model.video.author'),
	    'cover' => Yii::t('string', 'model.cover'),
	    'description' => Yii::t('string', 'model.description'),
	    'duration' => Yii::t('string', 'model.video.duration'),
	    'fromuser' => Yii::t('string', 'model.fromuser'),
	    'lovecounter' => Yii::t('string', 'model.lovecounter'),
	    'thumbnail' => Yii::t('string', 'model.thumbnail'),
	    'title' => Yii::t('string', 'model.title'),
	    'url' => Yii::t('string', 'model.video.url'),
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
	$criteria->compare('author', $this->author, true);
	$criteria->compare('cover', $this->cover, true);
	$criteria->compare('description', $this->description, true);
	$criteria->compare('duration', $this->duration);
	$criteria->compare('fromuser', $this->fromuser);
	$criteria->compare('lovecounter', $this->lovecounter);
	$criteria->compare('thumbnail', $this->thumbnail, true);
	$criteria->compare('title', $this->title, true);
	$criteria->compare('url', $this->url, true);
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
     * @return Video the static model class
     */
    public static function model($className = __CLASS__) {
	return parent::model($className);
    }

    /**
     * Increment counters of Video instance, return false in case of error
     * @param integer $id id of the video to increment the counter
     * @param string counter to be incremented
     */
    public function decrementCounter($id, $counter) {
	$dbConnection = new DBConnection();
	$connection = $dbConnection->connect();
	if ($connection === false) {
	    return false;
	}
	$sql = "UPDATE video
	          SET " . $counter . " = " . $counter . " - 1
		WHERE id = " . $id;
	$results = mysqli_query($connection, $sql);
	return (!$results) ? false : true;
    }

    /**
     * Increment counters of Video instance, return false in case of error
     * @param integer $id id of the album to increment the counter
     * @param string counter to be incremented
     */
    public function incrementCounter($id, $counter) {
	$dbConnection = new DBConnection();
	$connection = $dbConnection->connect();
	if ($connection === false) {
	    return false;
	}
	$sql = "UPDATE video
	          SET " . $counter . " = " . $counter . " + 1
		WHERE id = " . $id;
	$results = mysqli_query($connection, $sql);
	return (!$results) ? false : true;
    }

    /**
     * Set to 0 active field of Video instance, return false in case of error
     * @param integer $id id of the video
     */
    public function logicalDelete($id) {
	$dbConnection = new DBConnection();
	$connection = $dbConnection->connect();
	if ($connection === false) {
	    return false;
	}
	$sql = "UPDATE video
	          SET active = 0
		WHERE id = " . $id;
	$results = mysqli_query($connection, $sql);
	return (!$results) ? false : true;
    }

}