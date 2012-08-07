<?php

/**
 * This is the model class for table "church_supplies".
 *
 * The followings are the available columns in table 'church_supplies':
 * @property integer $supplies_id
 * @property integer $church_id
 * @property string $supplies_title
 * @property string $supplies_desc
 * @property string $category
 * @property string $supplies_date
 * @property integer $supplies_status
 * @property string $latlng
 */
class ChurchSupplies extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ChurchSupplies the static model class
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
		return 'church_supplies';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('church_id, supplies_title, supplies_desc, category, supplies_date', 'required'),
			array('church_id, supplies_status', 'numerical', 'integerOnly'=>true),
			array('supplies_title, latlng', 'length', 'max'=>100),
			array('category', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('supplies_id, church_id, supplies_title, supplies_desc, category, supplies_date, supplies_status, latlng', 'safe', 'on'=>'search'),
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
                    'comments'=>array(self::HAS_MANY, 'Comments', 'supplies_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'supplies_id' => 'Supplies',
			'church_id' => 'Church',
			'supplies_title' => 'Supplies Title',
			'supplies_desc' => 'Supplies Desc',
			'category' => 'Category',
			'supplies_date' => 'Supplies Date',
			'supplies_status' => 'Supplies Status',
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

		$criteria->compare('supplies_id',$this->supplies_id);
		$criteria->compare('church_id',$this->church_id);
		$criteria->compare('supplies_title',$this->supplies_title,true);
		$criteria->compare('supplies_desc',$this->supplies_desc,true);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('supplies_date',$this->supplies_date,true);
		$criteria->compare('supplies_status',$this->supplies_status);
		$criteria->compare('latlng',$this->latlng,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}