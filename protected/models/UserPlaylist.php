<?php

/**
 * This is the model class for table "user_playlist".
 *
 * The followings are the available columns in table 'user_playlist':
 * @property string $id_user
 * @property string $id_playlist
 *
 * The followings are the available model relations:
 * @property Playlist $idPlaylist
 * @property User $idUser
 */
class UserPlaylist extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_playlist';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, id_playlist', 'required', 'message'=>'{attribute} field is missing'),
			array('id_user, id_playlist', 'length', 'max'=>11, 'message'=>'Invalid {attribute} format'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_user, id_playlist', 'safe', 'on'=>'search'),
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
			'idPlaylist' => array(self::BELONGS_TO, 'Playlist', 'id_playlist'),
			'idUser' => array(self::BELONGS_TO, 'User', 'id_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_user'=>Yii::t('string','model.id_user'),
			'id_playlist'=>Yii::t('string','model.id_playlist'),
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

		$criteria->compare('id_user',$this->id_user,true);
		$criteria->compare('id_playlist',$this->id_playlist,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserPlaylist the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
