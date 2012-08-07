<?php

/**
 * This is the model class for table "affiliation".
 *
 * The followings are the available columns in table 'affiliation':
 * @property integer $affilition_id
 * @property integer $church_id
 * @property integer $affid
 * @property string $affiliation_date
 * @property integer $status
 */
class Affiliation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Affiliation the static model class
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
		return 'affiliation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('church_id, affid, affiliation_date, status', 'required'),
			array('church_id, affid, status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('affilition_id, church_id, affid, affiliation_date, status', 'safe', 'on'=>'search'),
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
			'affilition_id' => 'Affilition',
			'church_id' => 'Church',
			'affid' => 'Affid',
			'affiliation_date' => 'Affiliation Date',
			'status' => 'Status',
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

		$criteria->compare('affilition_id',$this->affilition_id);
		$criteria->compare('church_id',$this->church_id);
		$criteria->compare('affid',$this->affid);
		$criteria->compare('affiliation_date',$this->affiliation_date,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}