<?php

/**
 * This is the model class for table "stream".
 *
 * The followings are the available columns in table 'stream':
 * @property string $id
 * @property string $fromuser
 * @property string $touser
 * @property string $type
 * @property string $createdat
 * @property string $updatedat
 *
 * The followings are the available model relations:
 * @property StreamType $type0
 * @property User $fromuser0
 * @property User $touser0
 */
class Stream extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'stream';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, fromuser, touser, type, updatedat', 'required', 'message'=>'{attribute} field is missing'),
			array('id, fromuser, touser, type', 'length', 'max'=>11, 'message'=>'Invalid {attribute} format'),
			array('createdat', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fromuser, touser, type, createdat, updatedat', 'safe', 'on'=>'search'),
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
			'type0' => array(self::BELONGS_TO, 'StreamType', 'type'),
			'fromuser0' => array(self::BELONGS_TO, 'User', 'fromuser'),
			'touser0' => array(self::BELONGS_TO, 'User', 'touser'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fromuser' => 'Fromuser',
			'touser' => 'Touser',
			'type' => 'Type',
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
		$criteria->compare('fromuser',$this->fromuser,true);
		$criteria->compare('touser',$this->touser,true);
		$criteria->compare('type',$this->type,true);
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
	 * @return Stream the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
