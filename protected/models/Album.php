<?php

/**
 * This is the model class for table "album".
 *
 * The followings are the available columns in table 'album':
 * @property string $id
 * @property integer $active
 * @property integer $commentcounter
 * @property string $cover
 * @property string $description
 * @property string $fromuser
 * @property integer $imagecounter
 * @property double $latitude
 * @property double $longitude
 * @property integer $lovecounter
 * @property integer $sharecounter
 * @property string $thumbnail
 * @property string $title
 * @property string $createdat
 * @property string $updatedat
 *
 * The followings are the available model relations:
 * @property User $fromuser0
 * @property AlbumTag $albumTag
 * @property Comment[] $comments
 * @property Image[] $images
 * @property UserAlbum[] $userAlbums
 */
class Album extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'album';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fromuser, title, updatedat', 'required','message'=>'{attribute} field is missing'),
			array('active, commentcounter, imagecounter, lovecounter, sharecounter', 'numerical', 'integerOnly'=>true,'message'=>'Invalid {attribute} format'),
			array('latitude, longitude', 'numerical','message'=>'Invalid {attribute} format'),
			array('cover, thumbnail', 'length', 'max'=>100,'tooLong'=>'{attribute} must be at most 100 characters'),
			array('fromuser', 'length', 'max'=>11),
			array('title', 'length', 'max'=>80,'tooLong'=>'{attribute} must be at most 80 characters'),
		        array('title', 'length', 'min'=>2,'tooShort'=>'{attribute} must be at least 2 characters'),
		    	array('description', 'length', 'max'=>3000,'tooLong'=>'{attribute} must be at most 3000 characters'),
		        array('description', 'length', 'min'=>2,'tooShort'=>'{attribute} must be at least 2 characters'),
			array('description, createdat', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, active, commentcounter, description, fromuser, imagecounter, latitude, longitude, lovecounter, sharecounter, title, createdat, updatedat', 'safe', 'on'=>'search'),
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
			'albumTag' => array(self::HAS_ONE, 'AlbumTag', 'id_album'),
			'comments' => array(self::HAS_MANY, 'Comment', 'album'),
			'images' => array(self::HAS_MANY, 'Image', 'album'),
			'userAlbums' => array(self::HAS_MANY, 'UserAlbum', 'id_album'),
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
			'cover' => 'Cover',
			'description' => 'Description',
			'fromuser' => 'Fromuser',
			'imagecounter' => 'Imagecounter',
			'latitude' => 'Latitude',
			'longitude' => 'Longitude',
			'lovecounter' => 'Lovecounter',
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
		$criteria->compare('commentcounter',$this->commentcounter);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('fromuser',$this->fromuser,true);
		$criteria->compare('imagecounter',$this->imagecounter);
		$criteria->compare('latitude',$this->latitude);
		$criteria->compare('longitude',$this->longitude);
		$criteria->compare('lovecounter',$this->lovecounter);
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
	 * @return Album the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
