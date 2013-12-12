<?php

class FacebookButton extends CWidget
{

    public $link = '';

    public function run()
    {
        $this->render('facebookButton');
    }

}