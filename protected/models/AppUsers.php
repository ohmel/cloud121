<?php

/**
 * This is the model class for table "app_users".
 *
 * The followings are the available columns in table 'app_users':
 * @property integer $user_id
 * @property string $ud_id
 * @property integer $church_id
 * @property string $user_name
 * @property string $user_fullname
 * @property string $user_password
 * @property string $user_type
 * @property integer $user_status
 */
class AppUsers extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AppUsers the static model class
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
		return 'app_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ud_id, church_id, user_fullname, user_type, user_name', 'required'),
			array('church_id, user_status', 'numerical', 'integerOnly'=>true),
			array('ud_id', 'length', 'max'=>10),
			array('user_name, user_password', 'length', 'max'=>100),
			array('user_fullname', 'length', 'max'=>255),
			array('user_type', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, ud_id, church_id, user_name, user_fullname, user_password, user_type, user_status', 'safe', 'on'=>'search'),
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
                    'church'=>array(self::HAS_ONE, 'Church', 'church_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'ud_id' => 'Ud',
			'church_id' => 'Church',
			'user_name' => 'Username',
			'user_fullname' => 'Fullname',
			'user_password' => 'Password',
			'user_type' => 'User Type',
			'user_status' => 'User Status',
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

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('ud_id',$this->ud_id,true);
		$criteria->compare('church_id',$this->church_id);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('user_fullname',$this->user_fullname,true);
		$criteria->compare('user_password',$this->user_password,true);
		$criteria->compare('user_type',$this->user_type,true);
		$criteria->compare('user_status',$this->user_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}