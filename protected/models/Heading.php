<?php

/**
 * This is the model class for table "heading".
 *
 * The followings are the available columns in table 'heading':
 * @property integer $id
 * @property string $heading
 * @property integer $tweeted
 * @property integer $score
 */
class Heading extends CActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'heading';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('heading', 'required'),
            array('tweeted, score, generated', 'numerical', 'integerOnly' => true),
            array('heading', 'length', 'max' => 128),
            array('generated', 'length', 'max' => 11),
            array('id, heading, score', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'heading' => 'Heading',
            'tweeted' => 'Tweeted',
            'score' => 'Score',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search($criteria = null, $sort = null)
    {

        if (!$criteria) {
            $criteria = new CDbCriteria;
            $criteria->condition = 'tweeted = 0 AND (generated > ' . (time() - 86400) . ' OR score > 0 AND generated > ' . (time() - 7 * 86400) . ')';
        }
        $criteria->compare('id', $this->id);
        $criteria->compare('heading', $this->heading, true);
        $criteria->compare('score', $this->score);

        if (!$sort) {
            $sort = new CSort();
            $sort->defaultOrder = array(
                'score' => CSort::SORT_DESC,
            );
        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 10,
            ),
            'sort' => $sort,
        ));
    }

    public function searchNew()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'generated > ' . (time() - 86400);
        return $this->search($criteria);
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Heading the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function searchBest()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'score > 0';
        return $this->search($criteria);
    }

}
