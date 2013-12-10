<h1><?php echo $heading->heading; ?></h1>

<div class="buttons">
    <?php
    $this->widget("LikeButton", array("headingId" => $heading->id, 'likes' => $heading->score));
    $this->widget("TweetButton", array("hashtag" => "botsikko", "text" => $heading->heading, "link" => "data.yle.fi/botsikot/" . $heading->id));
    echo CHtml::link("<i class=\"icon-search\"></i> Googlaa", "https://www.google.fi/#q=" . urlencode($heading->heading), array("class" => "btn", "target" => "_blank"));
    ?>
</div>
