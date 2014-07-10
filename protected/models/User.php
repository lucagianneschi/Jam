<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $username
 * @property string $password
 * @property integer $active
 * @property string $address
 * @property string $avatar
 * @property string $background
 * @property string $birthday
 * @property string $city
 * @property integer $collaborationcounter
 * @property string $country
 * @property string $description
 * @property string $email
 * @property string $facebookid
 * @property string $facebookpage
 * @property string $firstname
 * @property integer $followerscounter
 * @property integer $followingcounter
 * @property integer $friendshipcounter
 * @property string $googlepluspage
 * @property integer $jammercounter
 * @property string $jammertype
 * @property string $lang
 * @property string $lastname
 * @property double $latitude
 * @property integer $level
 * @property integer $levelvalue
 * @property double $longitude
 * @property integer $premium
 * @property string $premiumexpirationdate
 * @property string $sex
 * @property string $thumbnail
 * @property string $twitterpage
 * @property string $type
 * @property integer $venuecounter
 * @property string $website
 * @property string $youtubechannel
 * @property string $createdat
 * @property string $updatedat
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		        array('id, username, password, active, collaborationcounter, email, followerscounter, followingcounter, friendshipcounter, jammercounter, jammertype, lang, level, levelvalue, premium, premiumexpirationdate, sex, type, venuecounter, createdat, updatedat', 'required','message'=>'{attribute} field is missing'),
			array('collaborationcounter, followerscounter, followingcounter, friendshipcounter, jammercounter, level, levelvalue, premium, venuecounter', 'numerical', 'integerOnly'=>true,'message'=>'Invalid {attribute} format'),
		        array('active, premium', 'boolean', 'message'=>'Invalid {attribute} format'),
			array('latitude, longitude', 'numerical','message'=>'Invalid {attribute} format'),
		        array('username, email', 'unique','message'=>'{attribute} is already in use. Pick another {attribute}'),
			array('username, password, address, avatar, background, city, country, email, facebookid, facebookpage, firstname, googlepluspage, jammertype, lastname, sex, thumbnail, twitterpage, type, website, youtubechannel', 'length', 'max'=>100, 'tooLong'=>'{attribute} must be at most 1000 characters'),
		    	array('password', 'length', 'min'=>8, 'tooShort'=>'{attribute} must be at least 8 characters'),
			array('lang', 'length', 'max'=>2, 'tooLong'=>'{attribute} must be at most 2 characters'),
			array('createdat, updatedat', 'date', 'format' =>  'Y-m-d H:m:s'),
		        array('type','in','range'=>array('SPOTTER','JAMMER','VENUE'),'allowEmpty'=>false,'message'=>'Invalid {attribute} value'),
		        array('sex','in','range'=>array('M','F','ND'),'allowEmpty'=>false,'message'=>'Invalid {attribute} value'),
		        array('email','email','message'=>'Invalid {attribute}'),
		        array('premiumexpirationdate, birthday, createdat','date','message'=>'Invalid {attribute}'),
		        array('facebookid, facebookpage, googlepluspage, twitterpage, website, youtubechannel','url','message'=>'{attribute} has to be a valid URL'),
		        array('levelvalue', 'max'=>5,'tooBig'=>'{attribute} can be at most 5'),
		        array('levelvalue', 'min'=>1,'tooSmall'=>'{attribute} can be at least 1'),
		        array('description', 'length', 'min'=>2, 'tooShort'=>'{attribute} must be at least 2 characters'),
			array('description', 'length', 'max'=>3000, 'tooLong'=>'{attribute} must be at most 3000 characters'),
		        array('followerscounter, followingcounter, friendshipcounter, premium, jammercounter, venuecounter', 'default', 'value'=>0),
		        array('active, level, levelvalue', 'default', 'value'=>1),
		        array('sex', 'default', 'value'=>'ND'),
		        array('lang', 'default', 'value'=>'en'),
		        array('active', 'default', 'value'=>1),
		        array('username, address, city, country, description, firstname, lastname', 'match', 'pattern'=>'/^([a-zA-Z\xE0\xE8\xE9\xF9\xF2\xEC\x27]\s?)+$/', 'message' => 'Invalid {attribute}. No special characters allowed'),
		        array('password', 'match', 'pattern'=>'/^[a-zA-Z0-9\_\*\-\+\!\?\,\:\;\.\xE0\xE8\xE9\xF9\xF2\xEC\x27]{8,12}/', 'message' => 'Invalid {attribute}'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, active, address, avatar, background, birthday, city, collaborationcounter, country, description, email, facebookid, facebookpage, firstname, followerscounter, followingcounter, friendshipcounter, googlepluspage, jammercounter, jammertype, lang, lastname, latitude, level, levelvalue, longitude, premium, premiumexpirationdate, sex, thumbnail, twitterpage, type, venuecounter, website, youtubechannel, createdat, updatedat', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
		    	'id'=>Yii::t('string','model.id'),
		        'username'=>Yii::t('string','model.user.username'),
		        'password'=>Yii::t('string','model.user.password'),
			'active'=>Yii::t('string','model.active'),
			'address'=>Yii::t('string','model.address'),
		        'avatar'=>Yii::t('string','model.user.avatar'),
		        'background'=>Yii::t('string','model.user.background'),
		        'birthday'=>Yii::t('string','model.user.birthday'),
			'city'=>Yii::t('string','model.city'),
			'collaborationcounter' => 'Collaborationcounter',
		        'country'=>Yii::t('string','model.user.country'),
			'description'=>Yii::t('string','model.description'),
		        'email'=>Yii::t('string','model.user.email'),
		        'facebookid'=>Yii::t('string','model.user.facebookid'),
		        'facebookpage'=>Yii::t('string','model.user.facebookpage'),
		        'firstname'=>Yii::t('string','model.user.firstname'),
		        'followerscounter'=>Yii::t('string','model.user.followerscounter'),
		        'followingcounter'=>Yii::t('string','model.user.followingcounter'),
		        'friendshipcounter'=>Yii::t('string','model.user.friendshipcounter'),
			'googlepluspage'=>Yii::t('string','model.user.googlepluspage'),
		        'jammercounter'=>Yii::t('string','model.user.jammercounter'),
		        'jammertype'=>Yii::t('string','model.user.jammertype'),
		        'lang'=>Yii::t('string','model.user.lang'),
		        'lastname'=>Yii::t('string','model.user.lastname'),
			'latitude'=>Yii::t('string','model.latitude'),
		        'level'=>Yii::t('string','model.user.level'),
		        'levelvalue'=>Yii::t('string','model.user.levelvalue'),
			'longitude'=>Yii::t('string','model.longitude'),
		        'premium'=>Yii::t('string','model.user.premium'),
		        'premiumexpirationdate'=>Yii::t('string','model.user.premiumexpirationdate'),
		        'sex'=>Yii::t('string','model.user.sex'),
		        'thumbnail'=>Yii::t('string','model.thumbnail'),
		        'twitterpage'=>Yii::t('string','model.user.twitterpage'),
		        'type'=>Yii::t('string','model.type'),
		        'venuecounter'=>Yii::t('string','model.user.venuecounter'),
		        'website'=>Yii::t('string','model.user.website'),
		        'youtubechannel'=>Yii::t('string','model.user.youtubechannel'),
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('background',$this->background,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('collaborationcounter',$this->collaborationcounter);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('facebookid',$this->facebookid,true);
		$criteria->compare('facebookpage',$this->facebookpage,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('followerscounter',$this->followerscounter);
		$criteria->compare('followingcounter',$this->followingcounter);
		$criteria->compare('friendshipcounter',$this->friendshipcounter);
		$criteria->compare('googlepluspage',$this->googlepluspage,true);
		$criteria->compare('jammercounter',$this->jammercounter);
		$criteria->compare('jammertype',$this->jammertype,true);
		$criteria->compare('lang',$this->lang,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('latitude',$this->latitude);
		$criteria->compare('level',$this->level);
		$criteria->compare('levelvalue',$this->levelvalue);
		$criteria->compare('longitude',$this->longitude);
		$criteria->compare('premium',$this->premium);
		$criteria->compare('premiumexpirationdate',$this->premiumexpirationdate,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('thumbnail',$this->thumbnail,true);
		$criteria->compare('twitterpage',$this->twitterpage,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('venuecounter',$this->venuecounter);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('youtubechannel',$this->youtubechannel,true);
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
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
