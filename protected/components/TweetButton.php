<?php

class TweetButton extends CWidget {
    
    public $text;
    public $hashtag;
    
    public function run() {
        $this->render('tweetButton');
    }
}