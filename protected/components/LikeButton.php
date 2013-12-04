<?php

class LikeButton extends CWidget
{

    public $liked = false;
    public $headingId;

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
                bindLikeButton();
            });

            function bindLikeButton() {
                $('.like').on('click', function(event) {
                    $.ajax({
                        url: '" . Yii::app()->createUrl('heading/score') . "',
                        data: {
                            id: $(event.currentTarget).attr('data-id')
                        },
                        success: function() {
                            $('#all-headings-grid').yiiGridView.update('all-headings-grid', {
                                complete: function() {
                                    bindLikeButton()
                                }
                            });
                        }
                    });
                    return false;
                });
            }
        ");
        
        $this->render('likeButton');
    }

}