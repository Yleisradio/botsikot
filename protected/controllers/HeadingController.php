<?php

class HeadingController extends Controller
{

    public function actionScore($id)
    {
        $liked = Yii::app()->user->getState('liked');
        if (!$liked) {
            $liked = array();
        }

        if (!in_array($id, $liked)) {
            $heading = Heading::model()->findByPk($id);
            $heading->score = $heading->score + 1;
            $heading->save();
        }
        
        $liked[] = $id;
        Yii::app()->user->setState('liked', $liked);
    }

}