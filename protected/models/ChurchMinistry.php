<?php

/**
 * This is the model class for table "church_ministry".
 *
 * The followings are the available columns in table 'church_ministry':
 * @property integer $ministry_id
 * @property integer $church_id
 * @property string $ministry_title
 * @property string $ministry_desc
 */
class ChurchMinistry extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ChurchMinistry the static model class
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
		return 'church_ministry';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('church_id, ministry_title, ministry_desc', 'required'),
			array('church_id', 'numerical', 'integerOnly'=>true),
			array('ministry_title', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ministry_id, church_id, ministry_title, ministry_desc', 'safe', 'on'=>'search'),
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
			'ministry_id' => 'Ministry',
			'church_id' => 'Church',
			'ministry_title' => 'Ministry Title',
			'ministry_desc' => 'Ministry Desc',
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

		$criteria->compare('ministry_id',$this->ministry_id);
		$criteria->compare('church_id',$this->church_id);
		$criteria->compare('ministry_title',$this->ministry_title,true);
		$criteria->compare('ministry_desc',$this->ministry_desc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}