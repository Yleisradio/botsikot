<?php

class SendTweetCommand extends CConsoleCommand
{

    /**
     * Tweet the most scored not yet tweeted heading
     */
    public function run()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'score > 0 AND tweeted = 0';
        $criteria->order = 'score DESC';

        $heading = Heading::model()->find($criteria);

        if ($heading) {


            $settings = array(
                'oauth_access_token' => Yii::app()->params['oauthAccessToken'],
                'oauth_access_token_secret' => Yii::app()->params['oauthAccessTokenSecret'],
                'consumer_key' => Yii::app()->params['consumerKey'],
                'consumer_secret' => Yii::app()->params['consumerSecret'],
            );

            $url = 'https://api.twitter.com/1.1/statuses/update.json';
            $requestMethod = 'POST';

            $postfields = array(
                'status' => $heading->heading . ' ' . Yii::app()->params['tweetLinkBaseUrl'] . "/botsikko?id=" . $heading->id . ' #botsikko',
            );

            $twitter = new TwitterAPIExchange($settings);
            echo $twitter->buildOauth($url, $requestMethod)
                    ->setPostfields($postfields)
                    ->performRequest();

            $heading->tweeted = time();
            $heading->save();
        }
    }

}