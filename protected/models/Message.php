<?php

/**
 * This is the model class for table "message".
 *
 * The followings are the available columns in table 'message':
 * @property string $id
 * @property integer $active
 * @property string $fromuser
 * @property string $text
 * @property string $touser
 * @property string $createdat
 * @property string $updatedat
 *
 * The followings are the available model relations:
 * @property User $fromuser0
 * @property User $touser0
 */
class Message extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
	return 'message';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
	    array('id, active, fromuser, text, touser, updatedat', 'required', 'message' => '{attribute} field is missing'),
	    array('active', 'boolean', 'message' => 'Invalid {attribute} format'),
	    array('fromuser, touser', 'length', 'max' => 11, 'message' => 'Invalid {attribute} format'),
	    array('createdat', 'safe'),
	    array('text', 'length', 'max' => 3000, 'tooLong' => '{attribute} must be at most 3000 characters'),
	    array('text', 'length', 'min' => 2, 'tooShort' => '{attribute} must be at least 2 characters'),
	    array('active', 'default', 'value' => 1),
	    array('createdat, updatedat', 'date', 'format' => 'Y-m-d H:m:s'),
	    array('text', 'match', 'pattern' => '/^([a-zA-Z\xE0\xE8\xE9\xF9\xF2\xEC\x27]\s?)+$/', 'message' => 'Invalid {attribute}. No special characters allowed'),
	    // The following rule is used by search().
	    // @todo Please remove those attributes that should not be searched.
	    array('id, active, fromuser, text, touser, createdat, updatedat', 'safe', 'on' => 'search'),
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
	$criteria->compare('fromuser', $this->fromuser, true);
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
     * @return Message the static model class
     */
    public static function model($className = __CLASS__) {
	return parent::model($className);
    }

    /**
     * Returns an array of message for the the message page
     * @param integer $id id of the touser or the fromuser
     * @return array $images array of messages to be displayed on the message page, false in case of error
     */
    public function messagePage($id) {
	$dbConnection = new DBConnection();
	$connection = $dbConnection->connect();
	if ($connection === false) {
	    return false;
	}
	$messages = array();
	$sql = "SELECT m.id id_m,
		       text, 
	               m.createdat createdat_m,
		       fu.id id_fu,
		       fu.type type_fu,
		       fu.thumbnail thumbnail_fu,
		       fu.username username_fu,
		       tu.id id_tu,
		       tu.type type_tu,
		       tu.thumbnail thumbnail_tu,
		       tu.username username_tu
              FROM message m, user fu
             WHERE active = 1
               AND fromuser =" . $id .
		"OR =". $id ;
	$results = mysqli_query($connection, $sql);
	if (!$results) {
	    return false;
	}
	while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC))
	    $rows_message[] = $row;
	if (!is_array($rows_message)) {
	    return $messages;
	}
	foreach ($rows_message as $row) {
	    $fromuser = array();
	    $fromuser['id_fu'] = $row['id_fu'];
	    $fromuser['thumbnail_fu'] = $row['thumbnail_fu'];
	    $fromuser['type_fu'] = $row['type_fu'];
	    $fromuser['username_fu'] = $row['username_fu'];
	    $touser = array();
	    $touser['id_tu'] = $row['id_tu'];
	    $touser['thumbnail_tu'] = $row['thumbnail_tu'];
	    $touser['type_tu'] = $row['type_tu'];
	    $touser['username_tu'] = $row['username_tu'];
	    $message = array();
	    $message['id'] = $row['id_m'];
	    $message['createdat'] = $row['createdat_m'];
	    $message['fromuser'] = $fromuser;    
	    $message['text'] = $row['text'];
	    $message['touser'] = $touser;
	    $messages[$row['id']] = $message;
	}
	return $messages;
    }

}
