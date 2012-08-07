<?php

/**
 * This is the model class for table "church_address".
 *
 * The followings are the available columns in table 'church_address':
 * @property integer $address_id
 * @property integer $church_id
 * @property string $city
 * @property string $country
 * @property string $province
 * @property string $municipality
 * @property string $zip
 * @property string $address_det
 */
class ChurchAddress extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ChurchAddress the static model class
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
		return 'church_address';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('church_id, city, country, province, municipality, zip, address_det', 'required'),
			array('church_id', 'numerical', 'integerOnly'=>true),
			array('city, country, municipality', 'length', 'max'=>50),
			array('province, address_det', 'length', 'max'=>100),
			array('zip', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('address_id, church_id, city, country, province, municipality, zip, address_det', 'safe', 'on'=>'search'),
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
                    'address'=>array(self::HAS_MANY, 'Events', 'church_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'address_id' => 'Address',
			'church_id' => 'Church',
			'city' => 'City',
			'country' => 'Country',
			'province' => 'Province',
			'municipality' => 'Municipality',
			'zip' => 'Zip',
			'address_det' => 'Address Details',
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

		$criteria->compare('address_id',$this->address_id);
		$criteria->compare('church_id',$this->church_id);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('province',$this->province,true);
		$criteria->compare('municipality',$this->municipality,true);
		$criteria->compare('zip',$this->zip,true);
		$criteria->compare('address_det',$this->address_det,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}