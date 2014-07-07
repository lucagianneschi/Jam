<?php

/**
 * This is the model class for table "post".
 *
 * The followings are the available columns in table 'post':
 * @property string $id
 * @property integer $active
 * @property integer $commentcounter
 * @property string $fromuser
 * @property integer $lovecounter
 * @property integer $sharecounter
 * @property integer $imagecounter
 * @property double $latitude
 * @property double $longitude
 * @property string $text
 * @property string $touser
 * @property string $createdat
 * @property string $updatedat
 *
 * The followings are the available model relations:
 * @property User $fromuser0
 * @property User $touser0
 * @property PostTag $postTag
 */
class Post extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'post';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fromuser, lovecounter, text, touser, updatedat', 'required', 'message'=>'{attribute} field is missing'),
		    	array('active', 'boolean', 'message'=>'Invalid {attribute} format'),
			array('commentcounter, lovecounter, sharecounter', 'numerical', 'integerOnly'=>true, 'message'=>'Invalid {attribute} format'),
			array('fromuser, touser', 'length', 'max'=>11,'message'=>'Invalid {attribute} format'),
		    	array('latitude, longitude', 'numerical','message'=>'Invalid {attribute} format'),
		        array('text', 'length', 'max'=>80,'tooLong'=>'{attribute} must be at most 80 characters'),
		        array('text', 'length', 'min'=>2,'tooShort'=>'{attribute} must be at least 2 characters'),
			array('createdat', 'safe'),
		    	array('commentcounter, lovecounter, sharecounter', 'default', 'value'=>0),
		        array('active', 'default', 'value'=>1),
		    	array('text', 'match', 'pattern'=>'/^([a-zA-Z\xE0\xE8\xE9\xF9\xF2\xEC\x27]\s?)+$/', 'message' => 'Invalid {attribute}. No special characters allowed'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, active, commentcounter, fromuser,latitude, longitude, lovecounter, sharecounter, text, touser, createdat, updatedat', 'safe', 'on'=>'search'),
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
			'postTag' => array(self::HAS_ONE, 'PostTag', 'id_post'),
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
			'fromuser' => 'Fromuser',
		    	'latitude' => 'Latitude',
			'longitude' => 'Longitude',
			'lovecounter' => 'Lovecounter',
			'sharecounter' => 'Sharecounter',
			'text' => 'Text',
			'touser' => 'Touser',
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
		$criteria->compare('fromuser',$this->fromuser,true);
		$criteria->compare('latitude',$this->latitude);
		$criteria->compare('longitude',$this->longitude);
		$criteria->compare('lovecounter',$this->lovecounter);
		$criteria->compare('sharecounter',$this->sharecounter);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('touser',$this->touser,true);
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
	 * @return Post the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
