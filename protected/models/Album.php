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
			array('fromuser, updatedat', 'required'),
			array('active, commentcounter, imagecounter, lovecounter, sharecounter', 'numerical', 'integerOnly'=>true),
			array('latitude, longitude', 'numerical'),
			array('cover, thumbnail', 'length', 'max'=>100),
			array('fromuser', 'length', 'max'=>11),
			array('title', 'length', 'max'=>80),
			array('description, createdat', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, active, commentcounter, cover, description, fromuser, imagecounter, latitude, longitude, lovecounter, sharecounter, thumbnail, title, createdat, updatedat', 'safe', 'on'=>'search'),
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
		$criteria->compare('cover',$this->cover,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('fromuser',$this->fromuser,true);
		$criteria->compare('imagecounter',$this->imagecounter);
		$criteria->compare('latitude',$this->latitude);
		$criteria->compare('longitude',$this->longitude);
		$criteria->compare('lovecounter',$this->lovecounter);
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
	 * @return Album the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
