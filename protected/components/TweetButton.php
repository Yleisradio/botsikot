<?php

class TweetButton extends CWidget {
    
    public $text;
    public $hashtag;
    public $link = '';
    
    public function run() {
        $this->render('tweetButton');
    }
}