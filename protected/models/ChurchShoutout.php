<?php

/**
 * This is the model class for table "church_shoutout".
 *
 * The followings are the available columns in table 'church_shoutout':
 * @property integer $shoutout_id
 * @property integer $church_id
 * @property string $shoutout_content
 * @property string $shoutout_date
 * @property integer $shoutout_type
 */
class ChurchShoutout extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ChurchShoutout the static model class
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
		return 'church_shoutout';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('church_id, shoutout_content, shoutout_date, shoutout_type', 'required'),
			array('church_id, shoutout_type', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('shoutout_id, church_id, shoutout_content, shoutout_date, shoutout_type', 'safe', 'on'=>'search'),
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
			'shoutout_id' => 'Shoutout',
			'church_id' => 'Church',
			'shoutout_content' => 'Shoutout Content',
			'shoutout_date' => 'Shoutout Date',
			'shoutout_type' => 'Shoutout Type',
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

		$criteria->compare('shoutout_id',$this->shoutout_id);
		$criteria->compare('church_id',$this->church_id);
		$criteria->compare('shoutout_content',$this->shoutout_content,true);
		$criteria->compare('shoutout_date',$this->shoutout_date,true);
		$criteria->compare('shoutout_type',$this->shoutout_type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}