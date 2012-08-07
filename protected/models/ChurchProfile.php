<?php

/**
 * This is the model class for table "church_profile".
 *
 * The followings are the available columns in table 'church_profile':
 * @property integer $profile_id
 * @property integer $church_id
 * @property string $church_desc
 * @property string $church_history
 * @property string $church_missionvision
 * @property string $church_tagtitle
 */
class ChurchProfile extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ChurchProfile the static model class
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
		return 'church_profile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('church_id, church_desc, church_history, church_missionvision, church_tagtitle', 'required'),
			array('church_id', 'numerical', 'integerOnly'=>true),
			array('church_tagtitle', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('profile_id, church_id, church_desc, church_history, church_missionvision, church_tagtitle', 'safe', 'on'=>'search'),
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
			'profile_id' => 'Profile',
			'church_id' => 'Church',
			'church_desc' => 'Church Desc',
			'church_history' => 'Church History',
			'church_missionvision' => 'Church Missionvision',
			'church_tagtitle' => 'Church Tagtitle',
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

		$criteria->compare('profile_id',$this->profile_id);
		$criteria->compare('church_id',$this->church_id);
		$criteria->compare('church_desc',$this->church_desc,true);
		$criteria->compare('church_history',$this->church_history,true);
		$criteria->compare('church_missionvision',$this->church_missionvision,true);
		$criteria->compare('church_tagtitle',$this->church_tagtitle,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}