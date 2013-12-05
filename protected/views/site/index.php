<script type="text/javascript">
    $(document).ready(function() {
        jQuery("abbr.timeago").timeago();
    });
</script>
<p>
    Botsikot ovat koneelliseesti luotuja fiktiivisiä uutisotsikoita. Voit antaa pisteitä hauskoille otsikoille. <a href="https://twitter.com/botsikot">@Botsikot</a> tweettaa eniten pisteitä saaneet.
</p>
<?php
$this->widget('bootstrap.widgets.TbExtendedGridView', array(
    'id' => 'all-headings-grid',
    'dataProvider' => $headingsData,
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
            ),
        ),
        array(
            'header' => '',
            'value' => '$this->grid->controller->widget("LikeButton", array("headingId" => $data["id"]), true);',
            'type' => 'raw',
        ),
        array(
            'header' => 'Otsikko',
            'name' => 'heading',
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
            'value' => '$this->grid->controller->widget("TweetButton", array("hashtag" => "botsikko", "text" => $data["heading"]), true)',
            'type' => 'raw',
            'headerHtmlOptions' => array(
                'width' => '100px',
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