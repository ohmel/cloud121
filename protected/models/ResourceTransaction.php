<?php

/**
 * This is the model class for table "resource_transaction".
 *
 * The followings are the available columns in table 'resource_transaction':
 * @property integer $trans_id
 * @property integer $resource_id
 * @property integer $type
 * @property string $trans_date
 * @property integer $ns_id
 * @property integer $orsc_id
 */
class ResourceTransaction extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ResourceTransaction the static model class
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
		return 'resource_transaction';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('resource_id, type, trans_date, ns_id, orsc_id', 'required'),
			array('resource_id, type, ns_id, orsc_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('trans_id, resource_id, type, trans_date, ns_id, orsc_id', 'safe', 'on'=>'search'),
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
			'trans_id' => 'Trans',
			'resource_id' => 'Resource',
			'type' => 'Type',
			'trans_date' => 'Trans Date',
			'ns_id' => 'Ns',
			'orsc_id' => 'Orsc',
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

		$criteria->compare('trans_id',$this->trans_id);
		$criteria->compare('resource_id',$this->resource_id);
		$criteria->compare('type',$this->type);
		$criteria->compare('trans_date',$this->trans_date,true);
		$criteria->compare('ns_id',$this->ns_id);
		$criteria->compare('orsc_id',$this->orsc_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}