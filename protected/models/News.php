<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property integer $news_id
 * @property string $news_title
 * @property string $news_content
 * @property string $news_date
 * @property integer $church_id
 * @property integer $news_type
 * @property integer $need_id
 * @property integer $supplies_id
 */
 
class News extends CActiveRecord {
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return News the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

   

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'news';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('news_title, news_content, news_date, church_id, news_type, need_id, supplies_id', 'required'),
            array('church_id, news_type, need_id, supplies_id', 'numerical', 'integerOnly' => true),
            array('news_title', 'length', 'max' => 100),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('news_id, news_title, news_content, news_date, church_id, news_type, need_id, supplies_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
     public function relations() {
        return array(
            'church'=>array(self::BELONGS_TO, 'Church', 'church_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'news_id' => 'News',
            'news_title' => 'News Title',
            'news_content' => 'News Content',
            'news_date' => 'News Date',
            'church_id' => 'Church',
            'news_type' => 'News Type',
            'need_id' => 'Need',
            'supplies_id' => 'Supplies',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('news_id', $this->news_id);
        $criteria->compare('news_title', $this->news_title, true);
        $criteria->compare('news_content', $this->news_content, true);
        $criteria->compare('news_date', $this->news_date, true);
        $criteria->compare('church_id', $this->church_id);
        $criteria->compare('news_type', $this->news_type);
        $criteria->compare('need_id', $this->need_id);
        $criteria->compare('supplies_id', $this->supplies_id);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}