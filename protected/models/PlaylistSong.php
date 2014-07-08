<?php

/**
 * This is the model class for table "playlist_song".
 *
 * The followings are the available columns in table 'playlist_song':
 * @property string $id_playlist
 * @property string $id_song
 *
 * The followings are the available model relations:
 * @property Song $idSong
 * @property Playlist $idPlaylist
 */
class PlaylistSong extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'playlist_song';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_playlist, id_song', 'required', 'message'=>'{attribute} field is missing'),
			array('id_playlist, id_song', 'length', 'max'=>11, 'message'=>'Invalid {attribute} format'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_playlist, id_song', 'safe', 'on'=>'search'),
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
			'idSong' => array(self::BELONGS_TO, 'Song', 'id_song'),
			'idPlaylist' => array(self::BELONGS_TO, 'Playlist', 'id_playlist'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_playlist' => 'Id Playlist',
			'id_song' => 'Id Song',
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

		$criteria->compare('id_playlist',$this->id_playlist,true);
		$criteria->compare('id_song',$this->id_song,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PlaylistSong the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
