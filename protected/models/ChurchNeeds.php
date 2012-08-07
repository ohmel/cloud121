<?php

/**
 * This is the model class for table "church_needs".
 *
 * The followings are the available columns in table 'church_needs':
 * @property integer $need_id
 * @property integer $church_id
 * @property string $need_title
 * @property string $need_desc
 * @property integer $category
 * @property string $need_date
 * @property integer $need_status
 * @property string $latlng
 */
class ChurchNeeds extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ChurchNeeds the static model class
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
		return 'church_needs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('church_id, need_title, need_desc, need_date, need_status', 'required'),
			array('church_id, need_status', 'numerical', 'integerOnly'=>true),
			array('need_title, latlng', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('need_id, church_id, need_title, need_desc, category, need_date, need_status, latlng', 'safe', 'on'=>'search'),
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
                    'church'=> array(self::BELONGS_TO, 'Church', 'church_id'),
                    'comments'=> array(self::HAS_MANY, 'Comments', 'need_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'need_id' => 'Need',
			'church_id' => 'Church',
			'need_title' => 'Need Title',
			'need_desc' => 'Need Description',
			'category' => 'Category',
			'need_date' => 'Need Date',
			'need_status' => 'Need Status',
			'latlng' => 'Pinning the Location',
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

		$criteria->compare('need_id',$this->need_id);
		$criteria->compare('church_id',$this->church_id);
		$criteria->compare('need_title',$this->need_title,true);
		$criteria->compare('need_desc',$this->need_desc,true);
		$criteria->compare('category',$this->category);
		$criteria->compare('need_date',$this->need_date,true);
		$criteria->compare('need_status',$this->need_status);
		$criteria->compare('latlng',$this->latlng,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}