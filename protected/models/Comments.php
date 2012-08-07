<?php

/**
 * This is the model class for table "comments".
 *
 * The followings are the available columns in table 'comments':
 * @property integer $comment_id
 * @property integer $church_id
 * @property integer $need_id
 * @property integer $supplies_id
 * @property string $comment_content
 * @property string $date_posted
 */
class Comments extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Comments the static model class
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
		return 'comments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('church_id, need_id, supplies_id, comment_content, date_posted', 'required'),
			array('church_id, need_id, supplies_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('comment_id, church_id, need_id, supplies_id, comment_content, date_posted', 'safe', 'on'=>'search'),
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
                    'church_needs'=>array(self::BELONGS_TO, 'ChurchNeeds', 'need_id'),
                    'church_supplies'=>array(self::BELONGS_TO, 'ChurchSupplies', 'supplies_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'comment_id' => 'Comment',
			'church_id' => 'Church',
			'need_id' => 'Need',
			'supplies_id' => 'Supplies',
			'comment_content' => 'Comment Content',
			'date_posted' => 'Date Posted',
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

		$criteria->compare('comment_id',$this->comment_id);
		$criteria->compare('church_id',$this->church_id);
		$criteria->compare('need_id',$this->need_id);
		$criteria->compare('supplies_id',$this->supplies_id);
		$criteria->compare('comment_content',$this->comment_content,true);
		$criteria->compare('date_posted',$this->date_posted,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}