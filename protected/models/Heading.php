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
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('heading', 'required'),
            array('tweeted, score, generated', 'numerical', 'integerOnly' => true),
            array('heading', 'length', 'max' => 128),
            array('generated', 'length', 'max' => 11),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, heading, tweeted, score', 'safe', 'on' => 'search'),
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

        $sort = new CSort();
        $sort->defaultOrder = array(
            'generated' => CSort::SORT_DESC,
        );
        return $this->search($criteria, $sort);
    }

    public function searchBest()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'score > 1';
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

    public static function generate()
    {
        $sql = 'SELECT site.title, facebook_shares + linkedin_shares + twitter_tweets AS shares
                FROM site
                WHERE site.title IS NOT NULL 
                AND published <1385683200
                AND published >1385683200 -7 *86400
                AND facebook_shares + linkedin_shares + twitter_tweets >1
                AND url NOT LIKE  "%areena%"';
        $command = Yii::app()->db->createCommand($sql);
        $sites = $command->queryAll();

        $map = array();
        foreach ($sites as $site) {
            $words = explode(' ', $site['title']);

            foreach ($words as $i => $word) {
//                $word = preg_replace("/[^A-z0-9\s]/i", "", $word);
                $word = trim($word);
                $word = str_replace('"', '', $word);
                $word = str_replace(':', '', $word);
                $word = preg_replace('/\s+/', ' ', $word);
                if (isset($words[$i + 1])) {
                    if (isset($map[$word])) {
                        $map[$word][] = strtolower($words[$i + 1]);
                    } else {
                        $map[$word] = array(strtolower($words[$i + 1]));
                    }
                } else {
                    if (isset($map[$word])) {
                        $map[$word][] = '';
                    } else {
                        $map[$word] = array('');
                    }
                }
            }
        }
//        echo '<pre>';
//        var_dump($map);
//        echo '</pre>';
        $word = array_rand($map);
        $heading = ucfirst($word);
        while (count($word) && isset($map[$word])) {
            $word = $map[$word][array_rand($map[$word])];
            $heading .= ' ' . $word;
//            var_dump($map);
        }

        var_dump($heading);
    }

}
