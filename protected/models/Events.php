<?php

/**
 * This is the model class for table "events".
 *
 * The followings are the available columns in table 'events':
 * @property integer $event_id
 * @property string $event_name
 * @property string $event_desc
 * @property integer $church_id
 * @property string $date_from
 * @property string $date_to
 * @property integer $event_type
 * @property string $latlng
 */
class Events extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Events the static model class
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
		return 'events';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_name, event_desc, church_id, date_from, date_to, event_type, latlng', 'required'),
			array('church_id, event_type', 'numerical', 'integerOnly'=>true),
			array('event_name, latlng', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('event_id, event_name, event_desc, church_id, date_from, date_to, event_type, latlng', 'safe', 'on'=>'search'),
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
                    'church'=>array(self::BELONGS_TO, 'Church', 'church_id'),
                    'address'=>array(self::BELONGS_TO, 'ChurchAddress', 'church_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'event_id' => 'Event',
			'event_name' => 'Event Name',
			'event_desc' => 'Event Description',
			'church_id' => 'Church',
			'date_from' => 'Date From',
			'date_to' => 'Date To',
			'event_type' => 'Event Type',
			'latlng' => 'Latlng',
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

		$criteria->compare('event_id',$this->event_id);
		$criteria->compare('event_name',$this->event_name,true);
		$criteria->compare('event_desc',$this->event_desc,true);
		$criteria->compare('church_id',$this->church_id);
		$criteria->compare('date_from',$this->date_from,true);
		$criteria->compare('date_to',$this->date_to,true);
		$criteria->compare('event_type',$this->event_type);
		$criteria->compare('latlng',$this->latlng,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}