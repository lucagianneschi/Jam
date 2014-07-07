<?php

/**
 * This is the model class for table "playlist".
 *
 * The followings are the available columns in table 'playlist':
 * @property string $id
 * @property integer $active
 * @property string $fromuser
 * @property string $name
 * @property integer $songcounter
 * @property integer $unlimited
 * @property string $createdat
 * @property string $updatedat
 *
 * The followings are the available model relations:
 * @property User $fromuser0
 * @property PlaylistSong[] $playlistSongs
 * @property UserPlaylist[] $userPlaylists
 */
class Playlist extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'playlist';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, active, fromuser, updatedat', 'required','message'=>'{attribute} field is missing'),
		    	array('active, unlimited', 'boolean', 'message'=>'Invalid {attribute} format'),
			array('songcounter', 'numerical', 'integerOnly'=>true, 'message'=>'Invalid {attribute} format'),
			array('fromuser', 'length', 'max'=>11, 'message'=>'Invalid {attribute} format'),
		    	array('name', 'length', 'max'=>80,'tooLong'=>'{attribute} must be at most 80 characters'),
		        array('name', 'length', 'min'=>2,'tooShort'=>'{attribute} must be at least 2 characters'),
			array('createdat', 'safe'),
		    	array('songcounter', 'default', 'value'=>0),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, active, fromuser, name, songcounter, unlimited, createdat, updatedat', 'safe', 'on'=>'search'),
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
			'playlistSongs' => array(self::HAS_MANY, 'PlaylistSong', 'id_playlist'),
			'userPlaylists' => array(self::HAS_MANY, 'UserPlaylist', 'id_playlist'),
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
			'fromuser' => 'Fromuser',
			'name' => 'Name',
			'songcounter' => 'Songcounter',
			'unlimited' => 'Unlimited',
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
		$criteria->compare('fromuser',$this->fromuser,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('songcounter',$this->songcounter);
		$criteria->compare('unlimited',$this->unlimited);
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
	 * @return Playlist the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
