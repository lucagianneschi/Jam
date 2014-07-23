<?php

/**
 * This is the model class for table "message".
 *
 * The followings are the available columns in table 'message':
 * @property string $id
 * @property integer $id_user
 * @property integer $active
 * @property string $fromuser
 * @property string $text
 * @property string $touser
 * @property string $type
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
	    array('active, id_user, fromuser, text, touser, type, updatedat', 'required', 'message' => '{attribute} field is missing'),
	    array('active', 'boolean', 'message' => 'Invalid {attribute} format'),
	    array('type', 'length', 'max'=>10),
	    array('fromuser, touser', 'length', 'max' => 11, 'message' => 'Invalid {attribute} format'),
	    array('createdat', 'safe'),
	    array('text', 'length', 'max' => 3000, 'tooLong' => '{attribute} must be at most 3000 characters'),
	    array('text', 'length', 'min' => 2, 'tooShort' => '{attribute} must be at least 2 characters'),
	    array('active', 'default', 'value' => 1),
	    array('createdat, updatedat', 'date', 'format' => 'yyyy-M-d H:m:s'),
//	    array('text', 'match', 'pattern' => '/^([a-zA-Z\xE0\xE8\xE9\xF9\xF2\xEC\x27]\s?)+$/', 'message' => 'Invalid {attribute}. No special characters allowed'),
	    // The following rule is used by search().
	    // @todo Please remove those attributes that should not be searched.
	    array('id,id_user, active, fromuser, text, touser, type, createdat, updatedat', 'safe', 'on' => 'search'),
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
	    'id_user' => Yii::t('string', 'model.id_user'),
	    'active' => Yii::t('string', 'model.active'),
	    'fromuser' => Yii::t('string', 'model.fromuser'),
	    'text' => Yii::t('string', 'model.text'),
	    'touser' => Yii::t('string', 'model.touser'),
	    'type' => Yii::t('string', 'model.type'),
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
	$criteria->compare('id_user', $this->id_user,true);
	$criteria->compare('active', $this->active);
	$criteria->compare('fromuser', $this->fromuser, true);
	$criteria->compare('text', $this->text, true);
	$criteria->compare('touser', $this->touser, true);
	$criteria->compare('type', $this->type,true);
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
    public function messagePage($id, $limit = 10, $skip = 0) {
	$dbConnection = new DBConnection();
	$connection = $dbConnection->connect();
	if ($connection === false) {
	    return false;
	}
	$list = array();
	$messages = array();
	$users = array();
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
              FROM message m, user fu, user tu
             WHERE active = 1
               AND fromuser = " . $id .
		" OR =" . $id .
		" ORDER BY createdat_m";
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
	    $rows_message[] = $row;
	if (!is_array($rows_message)) {
	    return $messages;
	}
	foreach ($rows_message as $row) {
	    $fromuser = array();
	    $fromuser['id'] = $row['id_fu'];
	    $fromuser['thumbnail'] = $row['thumbnail_fu'];
	    $fromuser['type'] = $row['type_fu'];
	    $fromuser['username'] = $row['username_fu'];
	    $touser = array();
	    $touser['id'] = $row['id_tu'];
	    $touser['thumbnail'] = $row['thumbnail_tu'];
	    $touser['type'] = $row['type_tu'];
	    $touser['username'] = $row['username_tu'];
	    $fromuser['id'] == $id ? array_push($users, $touser) : array_push($users, $fromuser);
	    $message = array();
	    $message['id'] = $row['id_m'];
	    $message['createdat'] = $row['createdat_m'];
	    $message['fromuser'] = $fromuser;
	    $message['text'] = $row['text'];
	    $message['touser'] = $touser;
	    $messages[$row['id_m']] = $message;
	}
	$list['messages'] = $messages;
	$list['users'] = array_unique($users);
	return $list;
    }

}
