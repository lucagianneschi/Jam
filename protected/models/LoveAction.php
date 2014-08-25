<?php

/**
 * This is the model class for table "loveaction".
 *
 * The followings are the available columns in table 'loveaction':
 * @property string $id
 * @property string $id_user
 * @property string $classname
 * @property string $id_object
 * @property string $createdat
 *
 * The followings are the available model relations:
 * @property User $idUser
 */
class LoveAction extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
	return 'loveaction';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
	    array('id_user, classname, id_object', 'required', 'message' => '{attribute} field is missing'),
	    array('id_user, id_object', 'length', 'max' => 11, 'message' => 'Invalid {attribute} format'),
	    array('createdat', 'date', 'format' => 'Y-m-d H:m:s', 'message' => '{attribute}: invalid date format'),
	    // The following rule is used by search().
	    // @todo Please remove those attributes that should not be searched.
	    array('id, id_user, classname, id_object, createdat', 'safe', 'on' => 'search'),
	);
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
	// NOTE: you may need to adjust the relation name and the related
	// class name for the relations automatically generated below.
	return array(
	    'idUser' => array(self::BELONGS_TO, 'User', 'id_user'),
	);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
	return array(
	    'id' => 'ID',
	    'id_user' => 'Id User',
	    'classname' => 'Classname',
	    'id_object' => 'Id Object',
	    'createdat' => 'Createdat',
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
	$criteria->compare('id_user', $this->id_user, true);
	$criteria->compare('classname', $this->classname, true);
	$criteria->compare('id_object', $this->id_object, true);
	$criteria->compare('createdat', $this->createdat, true);

	return new CActiveDataProvider($this, array(
	    'criteria' => $criteria,
	));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return LoveAction the static model class
     */
    public static function model($className = __CLASS__) {
	return parent::model($className);
    }

}
