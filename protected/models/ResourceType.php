<?php

/**
 * This is the model class for table "resource_type".
 *
 * The followings are the available columns in table 'resource_type':
 * @property integer $resource_id
 * @property string $resource_name
 * @property string $resource_desc
 * @property integer $category_id
 */
class ResourceType extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ResourceType the static model class
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
		return 'resource_type';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('resource_name, resource_desc, category_id', 'required'),
			array('category_id', 'numerical', 'integerOnly'=>true),
			array('resource_name', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('resource_id, resource_name, resource_desc, category_id', 'safe', 'on'=>'search'),
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
			'resource_id' => 'Resource',
			'resource_name' => 'Resource Name',
			'resource_desc' => 'Resource Desc',
			'category_id' => 'Category',
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

		$criteria->compare('resource_id',$this->resource_id);
		$criteria->compare('resource_name',$this->resource_name,true);
		$criteria->compare('resource_desc',$this->resource_desc,true);
		$criteria->compare('category_id',$this->category_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}