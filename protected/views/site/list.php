<script type="text/javascript">
    $(document).ready(function() {
        jQuery("abbr.timeago").timeago();

        if (typeof likeButton !== 'undefined') {
            likeButton.setOnSuccess(function() {
                $('#all-headings-grid').yiiGridView.update('all-headings-grid', {
                    complete: function() {
                        $('.like').likeButton({
                            url: '<?php echo Yii::app()->createUrl('heading/score'); ?>'
                        });
                    }
                });
            });
        }
    });
</script>
<?php
$this->widget('bootstrap.widgets.TbExtendedGridView', array(
    'id' => 'all-headings-grid',
    'dataProvider' => $headingsData,
    'filter' => $headings,
    'type' => 'striped bordered condensed',
    'summaryText' => false,
    'afterAjaxUpdate' => 'function() { jQuery("abbr.timeago").timeago(); $(".like").likeButton({url: "' . Yii::app()->createUrl('heading/score') . '"}); }',
    'responsiveTable' => true,
    'columns' => array(
        array(
            'name' => 'score',
            'header' => 'Peukut',
            'value' => '$this->grid->controller->widget("LikeButton", array("headingId" => $data["id"], "likes" => $data["score"]), true);',
            'type' => 'raw',
            'headerHtmlOptions' => array(
                'width' => '90px',
            ),
        ),
        array(
            'header' => 'Otsikko',
            'name' => 'heading',
            'value' => 'CHtml::link($data["heading"], Yii::app()->getBaseUrl(true) . "/botsikko?id=" . $data["id"]);',
            'type' => 'raw',
        ),
        array(
            'value' => 'CHtml::link("<i class=\"icon-search\"></i> Googlaa", "https://www.google.fi/#q=" . urlencode($data["heading"]), array("class" => "btn", "target" => "_blank"))',
            'type' => 'raw',
            'headerHtmlOptions' => array(
                'width' => '100px',
            ),
        ),
        array(
            'value' => '$this->grid->controller->widget("TweetButton", array("hashtag" => "botsikko", "text" => $data["heading"], "link" => Yii::app()->getBaseUrl(true) . "/botsikko?id=" . $data["id"]), true)',
            'type' => 'raw',
            'headerHtmlOptions' => array(
                'width' => '100px',
            ),
        ),
        array(
            'value' => '$this->grid->controller->widget("FacebookButton", array("link" => Yii::app()->getBaseUrl(true) . "/botsikko?id=" . $data["id"]), true)',
            'type' => 'raw',
            'headerHtmlOptions' => array(
                'width' => '160px',
            ),
        ),
        array(
            'header' => 'Luotu',
            'name' => 'generated',
            'value' => 'Timeago::timeagoOrUnknown($data["generated"])',
            'type' => 'raw',
        ),
    )
        )
);