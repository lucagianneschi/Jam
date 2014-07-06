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
 * @property Song $song0
 * @property Video $video0
 * @property Comment $comment0
 * @property Comment[] $comments
 * @property CommentTag $commentTag
 */
class Comment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, active, fromuser, text, touser, updatedat', 'required','message'=>'{attribute} field is missing'),
			array('active, commentcounter, lovecounter, sharecounter', 'numerical', 'integerOnly'=>true, 'message'=>'Invalid {attribute} format'),
			array('latitude, longitude', 'numerical','message'=>'Invalid {attribute} format'),
			array('album, comment, event, fromuser, image, record, song, touser, video', 'length', 'max'=>11,'message'=>'Invalid {attribute} format'),
			array('createdat', 'safe'),
		        array('text', 'length', 'max'=>3000,'tooLong'=>'{attribute} must be at most 3000 characters'),
		        array('text', 'length', 'min'=>2,'tooShort'=>'{attribute} must be at least 2 characters'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, active, album, comment, commentcounter, event, fromuser, image, latitude, longitude, lovecounter, record, sharecounter, song, text, touser, video, createdat, updatedat', 'safe', 'on'=>'search'),
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
			'album0' => array(self::BELONGS_TO, 'Album', 'album'),
			'fromuser0' => array(self::BELONGS_TO, 'User', 'fromuser'),
			'touser0' => array(self::BELONGS_TO, 'User', 'touser'),
			'event0' => array(self::BELONGS_TO, 'Event', 'event'),
			'image0' => array(self::BELONGS_TO, 'Image', 'image'),
			'record0' => array(self::BELONGS_TO, 'Record', 'record'),
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
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'active' => 'Active',
			'album' => 'Album',
			'comment' => 'Comment',
			'commentcounter' => 'Commentcounter',
			'event' => 'Event',
			'fromuser' => 'Fromuser',
			'image' => 'Image',
			'latitude' => 'Latitude',
			'longitude' => 'Longitude',
			'lovecounter' => 'Lovecounter',
			'record' => 'Record',
			'sharecounter' => 'Sharecounter',
			'song' => 'Song',
			'text' => 'Text',
			'touser' => 'Touser',
			'video' => 'Video',
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
		$criteria->compare('album',$this->album,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('commentcounter',$this->commentcounter);
		$criteria->compare('event',$this->event,true);
		$criteria->compare('fromuser',$this->fromuser,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('latitude',$this->latitude);
		$criteria->compare('longitude',$this->longitude);
		$criteria->compare('lovecounter',$this->lovecounter);
		$criteria->compare('record',$this->record,true);
		$criteria->compare('sharecounter',$this->sharecounter);
		$criteria->compare('song',$this->song,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('touser',$this->touser,true);
		$criteria->compare('video',$this->video,true);
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
	 * @return Comment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
