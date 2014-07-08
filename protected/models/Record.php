<?php

/**
 * This is the model class for table "record".
 *
 * The followings are the available columns in table 'record':
 * @property string $id
 * @property integer $active
 * @property string $buylink
 * @property string $city
 * @property integer $commentcounter
 * @property string $cover
 * @property string $description
 * @property integer $duration
 * @property string $fromuser
 * @property string $label
 * @property double $latitude
 * @property double $longitude
 * @property integer $lovecounter
 * @property integer $reviewcounter
 * @property integer $sharecounter
 * @property integer $songcounter
 * @property string $thumbnail
 * @property string $title
 * @property integer $year
 * @property string $createdat
 * @property string $updatedat
 *
 * The followings are the available model relations:
 * @property Comment[] $comments
 * @property User $fromuser0
 * @property RecordGenre[] $recordGenres
 * @property RecordTag $recordTag
 * @property ReviewRecord[] $reviewRecords
 * @property Song[] $songs
 * @property UserRecord[] $userRecords
 */
class Record extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'record';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, active, fromuser, title, updatedat', 'required','message'=>'{attribute} field is missing'),
		    	array('active', 'boolean', 'message'=>'Invalid {attribute} format'),
			array('commentcounter, duration, lovecounter, reviewcounter, sharecounter, songcounter, year', 'numerical', 'integerOnly'=>true, 'message'=>'Invalid {attribute} format'),
			array('latitude, longitude', 'numerical', 'message'=>'Invalid {attribute} format'),
		        array('buylink', 'url', 'message'=>'Invalid URL for {attribute}'),
			array('buylink, city, cover, label, thumbnail', 'length', 'max'=>100, 'message'=>'Invalid {attribute} format'),
			array('fromuser', 'length', 'max'=>11,'message'=>'Invalid {attribute} format'),
		        array('description', 'length', 'max'=>3000,'tooLong'=>'{attribute} must be at most 3000 characters'),
		        array('description', 'length', 'min'=>2,'tooShort'=>'{attribute} must be at least 2 characters'),
		    	array('title', 'length', 'max'=>80,'tooLong'=>'{attribute} must be at most 80 characters'),
		        array('title', 'length', 'min'=>2,'tooShort'=>'{attribute} must be at least 2 characters'),
			array('description, createdat', 'safe'),
		    	array('commentcounter, lovecounter, reviewcounter, sharecounter', 'default', 'value'=>0),
		        array('active', 'default', 'value'=>1),
		    	array('city, description, title', 'match', 'pattern'=>'/^([a-zA-Z\xE0\xE8\xE9\xF9\xF2\xEC\x27]\s?)+$/', 'message' => 'Invalid {attribute}. No special characters allowed'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, active, buylink, city, commentcounter, cover, description, duration, fromuser, label, latitude, longitude, lovecounter, reviewcounter, sharecounter, songcounter, thumbnail, title, year, createdat, updatedat', 'safe', 'on'=>'search'),
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
			'comments' => array(self::HAS_MANY, 'Comment', 'record'),
			'fromuser0' => array(self::BELONGS_TO, 'User', 'fromuser'),
			'recordGenres' => array(self::HAS_MANY, 'RecordGenre', 'id_record'),
			'recordTag' => array(self::HAS_ONE, 'RecordTag', 'id_record'),
			'reviewRecords' => array(self::HAS_MANY, 'ReviewRecord', 'record'),
			'songs' => array(self::HAS_MANY, 'Song', 'record'),
			'userRecords' => array(self::HAS_MANY, 'UserRecord', 'id_record'),
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
			'buylink' => 'Buylink',
			'city' => 'City',
			'commentcounter' => 'Commentcounter',
			'cover' => 'Cover',
			'description' => 'Description',
			'duration' => 'Duration',
			'fromuser' => 'Fromuser',
			'label' => 'Label',
			'latitude' => 'Latitude',
			'longitude' => 'Longitude',
			'lovecounter' => 'Lovecounter',
			'reviewcounter' => 'Reviewcounter',
			'sharecounter' => 'Sharecounter',
			'songcounter' => 'Songcounter',
			'thumbnail' => 'Thumbnail',
			'title' => 'Title',
			'year' => 'Year',
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
		$criteria->compare('buylink',$this->buylink,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('commentcounter',$this->commentcounter);
		$criteria->compare('cover',$this->cover,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('duration',$this->duration);
		$criteria->compare('fromuser',$this->fromuser,true);
		$criteria->compare('label',$this->label,true);
		$criteria->compare('latitude',$this->latitude);
		$criteria->compare('longitude',$this->longitude);
		$criteria->compare('lovecounter',$this->lovecounter);
		$criteria->compare('reviewcounter',$this->reviewcounter);
		$criteria->compare('sharecounter',$this->sharecounter);
		$criteria->compare('songcounter',$this->songcounter);
		$criteria->compare('thumbnail',$this->thumbnail,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('year',$this->year);
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
	 * @return Record the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
