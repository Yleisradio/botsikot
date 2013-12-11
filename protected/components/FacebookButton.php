<?php

class FacebookButton extends CWidget
{

    public $text;
    public $hashtag;
    public $link = '';

    public function run()
    {
        $this->render('facebookButton');
    }

}