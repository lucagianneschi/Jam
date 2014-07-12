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
	public $eventtype;
	public $genre;
	public $image;
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
			array('address, city, cover, createdat, description, eventdate, fromuser, latitude, locationname, longitude, thumbnail, title, updatedat', 'required'),
		    array('active', 'boolean', 'message'=>'Invalid {attribute} format'),
			array('attendeecounter, cancelledcounter, commentcounter, invitedcounter, lovecounter, refusedcounter, reviewcounter, sharecounter', 'numerical', 'integerOnly'=>true),
			array('latitude, longitude', 'numerical'),
			array('eventtype, genre','required', 'message' => 'Please enter a {attribute}'),
			array('image', 'file','types'=>'jpg, gif, png', 'allowEmpty'=>true, 'on'=>'update'),
			array('image', 'length', 'max'=>255, 'on'=>'insert,update'),
			array('address, city, cover, thumbnail', 'length', 'max'=>100),
		    array('title, address, city', 'length', 'max'=>100,'tooLong'=>'{attribute} must be at most 100 characters'),
		    array('title, address, city', 'length', 'min'=>2,'tooShort'=>'{attribute} must be at least 2 characters'),
			array('fromuser', 'length', 'max'=>11),
	    	array('description', 'length', 'max'=>3000,'tooLong'=>'{attribute} must be at most 3000 characters'),
	        array('description', 'length', 'min'=>2,'tooShort'=>'{attribute} must be at least 2 characters'),
	    	array('locationname', 'length', 'max'=>80,'tooLong'=>'{attribute} must be at most 80 characters'),
	        array('locationname', 'length', 'min'=>2,'tooShort'=>'{attribute} must be at least 2 characters'),
	    	array('createdat, updatedat', 'date', 'format' =>  'yyyy-M-d H:m:s'),
	    	array('eventdate', 'date', 'format' =>  'yyyy-M-d H:m'),
	    	array('commentcounter, lovecounter,reviewcounter, sharecounter', 'default', 'value'=>0),
	    	array('attendeecounter, cancelledcounter,invitedcounter, refusedcounter', 'default', 'value'=>0),
	        array('active', 'default', 'value'=>1),
	    	array('city, description, locationname, title', 'match', 'pattern'=>'/^([a-zA-Z\xE0\xE8\xE9\xF9\xF2\xEC\x27]\s?)+$/', 'message' => 'Invalid {attribute}. No special characters allowed'),
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
		        'id'=>Yii::t('string','model.id'),
		        'active'=>Yii::t('string','model.active'),
		        'address'=>Yii::t('string','model.address'),
		        'attendeecounter'=>Yii::t('string','model.event.attendeecounter'),
				'cancelledcounter'=>Yii::t('string','model.event.cancelledcounter'),
		        'city'=>Yii::t('string','model.city'),
		        'commentcounter'=>Yii::t('string','model.commentcounter'),
				'cover'=>Yii::t('string','model.cover'),
				'description'=>Yii::t('string','model.description'),
		        'eventdate'=>Yii::t('string','model.event.eventdate'),
		        'eventtype'=>Yii::t('string','model.type'),
				'fromuser'=>Yii::t('string','model.fromuser'),
				'genre'=>Yii::t('string','model.genre'),
		        'invitedcounter'=>Yii::t('string','model.event.invitedcounter'),
				'latitude'=>Yii::t('string','model.latitude'),
		        'locationname'=>Yii::t('string','model.event.locationname'),
		        'longitude'=>Yii::t('string','model.longitude'),
				'lovecounter'=>Yii::t('string','model.lovecounter'),
		        'refusedcounter'=>Yii::t('string','model.event.refusedcounter'),
				'reviewcounter'=>Yii::t('string','model.reviewcounter'),
				'sharecounter'=>Yii::t('string','model.sharecounter'),
				'thumbnail'=>Yii::t('string','model.thumbnail'),
				'title'=>Yii::t('string','view.uploadevent.event_title'),
				'createdat'=>Yii::t('string','model.createdat'),
		        'updatedat'=>Yii::t('string','model.updatedat'),
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
