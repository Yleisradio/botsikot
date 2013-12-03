<script type="text/javascript">
    $(document).ready(function() {
        jQuery("abbr.timeago").timeago();
        bindLikeButton();
    });

    function bindLikeButton() {
        $('.like').on('click', function(event) {
            $.ajax({
                url: '<?php echo $this->createUrl('heading/score'); ?>',
                data: {
                    id: $(event.currentTarget).attr("data-id")
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

</script>
<?php

function getLikeButton($data)
{
    $liked = Yii::app()->user->getState('liked');
    if (!$liked) {
        $liked = array();
    }
    if (in_array($data['id'], $liked)) {
        
    } else {
        return CHtml::link('<i class="icon-thumbs-up"></i>', "#", array("data-id" => $data["id"], "class" => "like btn btn-primary"));
    }
}

function getTweetButton($data)
{
    return '<a target="_blank" class="btn" href="https://twitter.com/intent/tweet?button_hashtag=botsikko&text=' . urlencode($data['heading']) . '" class="twitter-hashtag-button"><i class="icon-twitter"></i> Twiittaa</a>';
}

$this->widget('bootstrap.widgets.TbExtendedGridView', array(
    'id' => 'all-headings-grid',
    'dataProvider' => $headings->search(),
    'filter' => $headings,
    'type' => 'striped bordered condensed',
    'summaryText' => false,
    'afterAjaxUpdate' => 'function() { jQuery("abbr.timeago").timeago(); bindLikeButton(); }',
    'responsiveTable' => true,
    'columns' => array(
        array(
            'header' => 'Pisteet',
            'name' => 'score',
            'type' => 'raw',
            'headerHtmlOptions' => array(
                'width' => '50px',
            )
        ),
        array(
            'header' => '',
            'value' => 'getLikeButton($data);',
            'type' => 'raw',
        ),
        array(
            'header' => 'Otsikko',
            'name' => 'heading',
            'type' => 'raw',
        ),
        array(
            'header' => 'Googlaa',
            'value' => 'CHtml::link("<i class=\"icon-search\"></i> Googlaa", "https://www.google.fi/#q=" . urlencode($data["heading"]), array("class" => "btn", "target" => "_blank"))',
            'type' => 'raw',
            'headerHtmlOptions' => array(
                'width' => '100px',
            )
        ),
        array(
            'header' => 'Twiittaa',
            'value' => 'getTweetButton($data);',
            'type' => 'raw',
            'headerHtmlOptions' => array(
                'width' => '100px',
            )
        ),
        array(
            'header' => 'Generoitu',
            'name' => 'generated',
            'value' => 'Timeago::timeagoOrUnknown($data["generated"])',
            'type' => 'raw',
        ),
    )
        )
);