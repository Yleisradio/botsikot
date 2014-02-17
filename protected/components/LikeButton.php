<?php

class LikeButton extends CWidget
{

    public $selector = '.like';
    public $url;
    public $liked = false;
    public $headingId;
    public $likes;
    public $onSuccess;

    public function init()
    {
        Yii::app()->clientScript->registerScriptFile(
                Yii::app()->assetManager->publish(
                        Yii::getPathOfAlias('webroot.protected.components.js') . '/likeButton.js'
                )
        );
        if (!$this->url) {
            $this->url = Yii::app()->createUrl('heading/score');
        }
    }

    public function run()
    {
        $likeList = Yii::app()->user->getState('liked');
        if (is_array($likeList)) {
            if (in_array($this->headingId, $likeList)) {
                $this->liked = true;
            }
        }

        Yii::app()->clientScript->registerScript('likeButton', "
            $(document).ready(function() {
                $('.like').likeButton({
                    url: '" . $this->url . "',
                    appId: '" . Yii::app()->params['profilesApi']['appId'] . "',
                    appKey: '" . Yii::app()->params['profilesApi']['appKey'] . "', 
                    onSuccess: " . $this->onSuccess . ",
                });
          });
        ");

        $this->render('likeButton');
    }

}