<?php

class HeadingController extends Controller {
    
    public function actionScore($id) {
        $heading = Heading::model()->findByPk($id);
        $heading->score = $heading->score + 1;
        $heading->save();
        
        $liked = Yii::app()->user->getState('liked');
        if(!$liked) {
            $liked = array();
        }
        $liked[] = $id;
        Yii::app()->user->setState('liked', $liked);
    }
}