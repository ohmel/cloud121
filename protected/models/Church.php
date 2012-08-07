<?php

/**
 * This is the model class for table "church".
 *
 * The followings are the available columns in table 'church':
 * @property integer $church_id
 * @property integer $profile_id
 * @property string $church_name
 * @property integer $address_id
 * @property string $tel_num
 * @property string $email
 * @property string $website
 * @property string $fb_account
 * @property string $twitter_account
 * @property string $youtube_account
 * @property string $latlng
 * @property integer $status
 * @property integer $type
 */
class Church extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Church the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'church';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('church_name, tel_num, email, type, status', 'required'),
			array('profile_id, address_id, status, type', 'numerical', 'integerOnly'=>true),
			array('church_name, email, website, fb_account, twitter_account', 'length', 'max'=>100),
			array('tel_num', 'length', 'max'=>15),
			array('youtube_account, latlng', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('church_id, profile_id, church_name, address_id, tel_num, email, website, fb_account, twitter_account, youtube_account, latlng, status, type', 'safe', 'on'=>'search'),
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
                    'news'=>array(self::HAS_MANY, 'News', 'church_id'),
                    'church_needs'=>array(self::HAS_MANY, 'ChurchNeeds', 'church_id'),
                    'comments'=>array(self::HAS_MANY, 'Comments', 'church_id'),
                    'events'=>array(self::HAS_MANY, 'Events', 'church_id'),
                    'address'=>array(self::HAS_ONE, 'ChurchAddress', 'church_id'),
                    'user'=>array(self::HAS_ONE, 'AppUsers', 'church_id'),
                    'aff'=>array(self::HAS_MANY, 'Affiliation', 'church_id'),
//                    'profile'=>array(self::HAS_ONE, 'Profile', 'owner_id'),
                );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'church_id' => 'Church',
			'profile_id' => 'Profile',
			'church_name' => 'Church Name',
			'address_id' => 'Address',
			'tel_num' => 'Telephone/Mobile Number',
			'email' => 'Email',
			'website' => 'Website',
			'fb_account' => 'Facebook Account',
			'twitter_account' => 'Twitter Account',
			'youtube_account' => 'Youtube Account',
			'latlng' => 'Geo Code',
			'status' => 'Status',
			'type' => 'Type',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('church_id',$this->church_id);
		$criteria->compare('profile_id',$this->profile_id);
		$criteria->compare('church_name',$this->church_name,true);
		$criteria->compare('address_id',$this->address_id);
		$criteria->compare('tel_num',$this->tel_num,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('fb_account',$this->fb_account,true);
		$criteria->compare('twitter_account',$this->twitter_account,true);
		$criteria->compare('youtube_account',$this->youtube_account,true);
		$criteria->compare('latlng',$this->latlng,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('type',$this->type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}