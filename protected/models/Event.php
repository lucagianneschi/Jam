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
 */
class Event extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'event';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('address, city, description, fromuser, locationname, title, updatedat', 'required'),
			array('active, attendeecounter, cancelledcounter, commentcounter, invitedcounter, lovecounter, refusedcounter, reviewcounter, sharecounter', 'numerical', 'integerOnly'=>true),
			array('latitude, longitude', 'numerical'),
			array('address, city, cover, thumbnail, title', 'length', 'max'=>100),
			array('fromuser', 'length', 'max'=>11),
			array('locationname', 'length', 'max'=>80),
			array('eventdate, createdat', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, active, address, attendeecounter, cancelledcounter, city, commentcounter, cover, description, eventdate, fromuser, invitedcounter, latitude, locationname, longitude, lovecounter, refusedcounter, reviewcounter, sharecounter, thumbnail, title, createdat, updatedat', 'safe', 'on'=>'search'),
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
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'active' => 'Active',
			'address' => 'Address',
			'attendeecounter' => 'Attendeecounter',
			'cancelledcounter' => 'Cancelledcounter',
			'city' => 'City',
			'commentcounter' => 'Commentcounter',
			'cover' => 'Cover',
			'description' => 'Description',
			'eventdate' => 'Eventdate',
			'fromuser' => 'Fromuser',
			'invitedcounter' => 'Invitedcounter',
			'latitude' => 'Latitude',
			'locationname' => 'Locationname',
			'longitude' => 'Longitude',
			'lovecounter' => 'Lovecounter',
			'refusedcounter' => 'Refusedcounter',
			'reviewcounter' => 'Reviewcounter',
			'sharecounter' => 'Sharecounter',
			'thumbnail' => 'Thumbnail',
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
		$criteria->compare('address',$this->address,true);
		$criteria->compare('attendeecounter',$this->attendeecounter);
		$criteria->compare('cancelledcounter',$this->cancelledcounter);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('commentcounter',$this->commentcounter);
		$criteria->compare('cover',$this->cover,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('eventdate',$this->eventdate,true);
		$criteria->compare('fromuser',$this->fromuser,true);
		$criteria->compare('invitedcounter',$this->invitedcounter);
		$criteria->compare('latitude',$this->latitude);
		$criteria->compare('locationname',$this->locationname,true);
		$criteria->compare('longitude',$this->longitude);
		$criteria->compare('lovecounter',$this->lovecounter);
		$criteria->compare('refusedcounter',$this->refusedcounter);
		$criteria->compare('reviewcounter',$this->reviewcounter);
		$criteria->compare('sharecounter',$this->sharecounter);
		$criteria->compare('thumbnail',$this->thumbnail,true);
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
	 * @return Event the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
