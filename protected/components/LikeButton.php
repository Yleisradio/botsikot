<?php

class LikeButton extends CWidget
{

    public $liked = false;
    public $headingId;
    public $likes;

    public function run()
    {
        $likeList = Yii::app()->user->getState('liked');
        if (is_array($likeList)) {
            if (in_array($this->headingId, $likeList)) {
                $this->liked = true;
            }
        }
        
        Yii::app()->clientScript->registerScript('likeButton', "
            var likeButton = (function() {
                $(document).ready(function() {
                    likeButton.bind();
                });
                var onSuccess;
                return {
                    setOnSuccess: function(callbackFunction) {
                        onSuccess = callbackFunction;
                    },
                    bind: function bind() {
                        $('.like').on('click', function(event) {
                            $.ajax({
                                url: '" . Yii::app()->createUrl('heading/score') . "',
                                data: {
                                    id: $(event.currentTarget).attr('data-id')
                                },
                                success: function() {
                                    if(typeof onSuccess === 'function') {
                                        onSuccess(event.currentTarget);
                                    }
                                    $(event.currentTarget).removeClass('btn-primary');
                                    $(event.currentTarget).addClass('btn-inverse');
                                    var likes = $('[data-id=\'' + $(event.currentTarget).attr('data-id') + '\'] .likes').html();
                                    $('[data-id=\'' + $(event.currentTarget).attr('data-id') + '\'] .likes').html(parseInt(likes, 10) + 1);
                                }
                            });
                            return false;
                        });
                    }
                }
            })();
        ", CClientScript::POS_HEAD);
        
        $this->render('likeButton');
    }

}