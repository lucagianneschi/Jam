<?php

/**
 * This is the model class for table "image".
 *
 * The followings are the available columns in table 'image':
 * @property string $id
 * @property integer $active
 * @property string $album
 * @property integer $commentcounter
 * @property string $description
 * @property string $fromuser
 * @property double $latitude
 * @property double $longitude
 * @property integer $lovecounter
 * @property string $path
 * @property integer $sharecounter
 * @property string $thumbnail
 * @property string $createdat
 * @property string $updatedat
 *
 * The followings are the available model relations:
 * @property Comment[] $comments
 * @property Album $album0
 * @property User $fromuser0
 * @property ImageTag $imageTag
 * @property UserImage[] $userImages
 */
class Image extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'image';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('album, fromuser, path', 'required'),
		    	array('active', 'boolean', 'message'=>'Invalid {attribute} format'),
			array('commentcounter, lovecounter, sharecounter', 'numerical', 'integerOnly'=>true),
			array('latitude, longitude', 'numerical', 'message'=>'Invalid {attribute} format'),
		    	array('createdat, updatedat', 'date', 'format' =>  'Y-m-d H:m:s'),
			array('album, fromuser', 'length', 'max'=>11, 'message'=>'Invalid {attribute} format'),
			array('path, thumbnail', 'length', 'max'=>100),
		    	array('description', 'length', 'max'=>3000,'tooLong'=>'{attribute} must be at most 3000 characters'),
		        array('description', 'length', 'min'=>2,'tooShort'=>'{attribute} must be at least 2 characters'),
			array('description, createdat, updatedat', 'safe'),
		    	array('commentcounter, lovecounter, sharecounter', 'default', 'value'=>0),
		        array('active', 'default', 'value'=>1),
		    	array('description', 'match', 'pattern'=>'/^([a-zA-Z\xE0\xE8\xE9\xF9\xF2\xEC\x27]\s?)+$/', 'message' => 'Invalid {attribute}. No special characters allowed'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, active, album, commentcounter, description, fromuser, latitude, longitude, lovecounter, path, sharecounter, thumbnail, createdat, updatedat', 'safe', 'on'=>'search'),
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
			'comments' => array(self::HAS_MANY, 'Comment', 'image'),
			'album0' => array(self::BELONGS_TO, 'Album', 'album'),
			'fromuser0' => array(self::BELONGS_TO, 'User', 'fromuser'),
			'imageTag' => array(self::HAS_ONE, 'ImageTag', 'id_image'),
			'userImages' => array(self::HAS_MANY, 'UserImage', 'id_image'),
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
		        'album'=>Yii::t('string','model.album'),
		        'commentcounter'=>Yii::t('string','model.commentcounter'),
			'description'=>Yii::t('string','model.description'),
			'fromuser'=>Yii::t('string','model.fromuser'),
			'latitude'=>Yii::t('string','model.latitude'),
		        'longitude'=>Yii::t('string','model.longitude'),
			'lovecounter'=>Yii::t('string','model.lovecounter'),
		    	'path'=>Yii::t('string','model.path'),
		        'sharecounter'=>Yii::t('string','model.sharecounter'),
			'thumbnail'=>Yii::t('string','model.thumbnail'),
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
		$criteria->compare('album',$this->album,true);
		$criteria->compare('commentcounter',$this->commentcounter);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('fromuser',$this->fromuser,true);
		$criteria->compare('latitude',$this->latitude);
		$criteria->compare('longitude',$this->longitude);
		$criteria->compare('lovecounter',$this->lovecounter);
		$criteria->compare('path',$this->path,true);
		$criteria->compare('sharecounter',$this->sharecounter);
		$criteria->compare('thumbnail',$this->thumbnail,true);
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
	 * @return Image the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
