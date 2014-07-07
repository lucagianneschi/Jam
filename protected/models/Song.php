<?php

/**
 * This is the model class for table "song".
 *
 * The followings are the available columns in table 'song':
 * @property string $id
 * @property integer $active
 * @property integer $commentcounter
 * @property integer $counter
 * @property integer $duration
 * @property integer $fromuser
 * @property double $latitude
 * @property double $longitude
 * @property integer $lovecounter
 * @property string $path
 * @property integer $position
 * @property integer $record
 * @property integer $sharecounter
 * @property string $title
 * @property string $createdat
 * @property string $updatedat
 */
class Song extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'song';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		    	array('id, active, fromuser, path, record, title, updatedat', 'required','message'=>'{attribute} field is missing'),
		        array('active', 'boolean', 'message'=>'Invalid {attribute} format'),
			array('id, commentcounter, counter, duration, fromuser, lovecounter, position, record, sharecounter', 'numerical', 'integerOnly'=>true, 'message'=>'Invalid {attribute} format'),
			array('latitude, longitude', 'numerical', 'message'=>'Invalid {attribute} format'),
			array('path, title', 'length', 'max'=>100, 'message'=>'Invalid {attribute} format'),
			array('createdat, updatedat', 'safe'),
		    	array('title', 'length', 'max'=>80,'tooLong'=>'{attribute} must be at most 80 characters'),
		        array('title', 'length', 'min'=>2,'tooShort'=>'{attribute} must be at least 2 characters'),
		    	array('commentcounter, lovecounter', 'default', 'value'=>0),
		        array('active', 'default', 'value'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, active, commentcounter, duration, fromuser, latitude, longitude, lovecounter, path, position, record, sharecounter, title, createdat, updatedat', 'safe', 'on'=>'search'),
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
			'commentcounter' => 'Commentcounter',
			'duration' => 'Duration',
			'fromuser' => 'Fromuser',
			'latitude' => 'Latitude',
			'longitude' => 'Longitude',
			'lovecounter' => 'Lovecounter',
			'path' => 'Path',
			'position' => 'Position',
			'record' => 'Record',
			'sharecounter' => 'Sharecounter',
			'title' => 'Title',
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
		$criteria->compare('commentcounter',$this->commentcounter);
		$criteria->compare('duration',$this->duration);
		$criteria->compare('fromuser',$this->fromuser);
		$criteria->compare('latitude',$this->latitude);
		$criteria->compare('longitude',$this->longitude);
		$criteria->compare('lovecounter',$this->lovecounter);
		$criteria->compare('path',$this->path,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('record',$this->record);
		$criteria->compare('sharecounter',$this->sharecounter);
		$criteria->compare('title',$this->title,true);
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
	 * @return Song the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
