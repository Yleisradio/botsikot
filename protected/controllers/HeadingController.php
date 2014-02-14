<?php

class HeadingController extends Controller
{

    /**
     * Increase the score of heading by one if this session has not yet done it
     * @param type $id
     */
    public function actionScore($id)
    {
        $likes = array();
        $likes = ProfilesApi::getAllFeatureDataItems($userId, 'botsikot', 'like');

        var_dump($likes);
        die();
        if (!in_array($id, $likes)) {
            $heading = Heading::model()->findByPk($id);
            $heading->score = $heading->score + 1;
            $heading->save();
            ProfilesApi::addFeatureDataItem($userId, 'botsikot', 'like', $id);
        }
    }

}