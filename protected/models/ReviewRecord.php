<?php

/**
 * This is the model class for table "review_record".
 *
 * The followings are the available columns in table 'review_record':
 * @property string $id
 * @property integer $active
 * @property string $fromuser
 * @property double $latitude
 * @property double $longitude
 * @property string $record
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
class ReviewRecord extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'review_record';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		    	array('id, active, fromuser, record, text, touser, createdat, updatedat, vote', 'required'),
		    	array('active', 'boolean', 'message'=>'Invalid {attribute} format'),
			array('vote', 'numerical', 'integerOnly'=>true,'message'=>'Invalid {attribute} format'),
			array('fromuser, record, touser', 'length', 'max'=>11,'message'=>'Invalid {attribute} format'),
		        array('latitude, longitude', 'numerical','message'=>'Invalid {attribute} format'),
			array('createdat', 'safe'),
		    	array('text', 'length', 'max'=>3000,'tooLong'=>'{attribute} must be at most 3000 characters'),
		        array('text', 'length', 'min'=>2,'tooShort'=>'{attribute} must be at least 2 characters'),
		        array('vote', 'max'=>5,'tooBig'=>'{attribute} can be at most 5'),
		        array('vote', 'min'=>1,'tooSmall'=>'{attribute} can be at least 1'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, active, fromuser, latitude, longitude, record, text, touser, vote, createdat, updatedat', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
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
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'active' => 'Active',
			'fromuser' => 'Fromuser',
		        'latitude' => 'Latitude',
			'longitude' => 'Longitude',
			'record' => 'Record',
			'text' => 'Text',
			'touser' => 'Touser',
			'vote' => 'Vote',
			'createdat' => 'Createdat',
			'updatedat' => 'Updatedat',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('fromuser',$this->fromuser,true);
		$criteria->compare('latitude',$this->latitude);
		$criteria->compare('longitude',$this->longitude);
		$criteria->compare('record',$this->record,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('touser',$this->touser,true);
		$criteria->compare('vote',$this->vote);
		$criteria->compare('createdat',$this->createdat,true);
		$criteria->compare('updatedat',$this->updatedat,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ReviewRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
