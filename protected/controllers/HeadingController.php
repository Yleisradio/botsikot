<?php

class HeadingController extends Controller
{

    /**
     * Increase the score of heading by one if this session has not yet done it
     * @param type $id
     */
    public function actionScore()
    {
        $heading = Heading::model()->findByPk(Yii::app()->request->getPost('id'));
        $heading->score = $heading->score + 1;
        $heading->save();
    }

}