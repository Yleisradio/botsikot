<?php
$this->beginContent('//layouts/base');

$items = array(
    array('label' => 'Botsikot', 'url' => array('/'), 'icon' => 'bolt'),
    array('label' => 'Parhaat', 'url' => array('/parhaat'), 'icon' => 'star'),
    array('label' => 'Uudet', 'url' => array('/uudet'), 'icon' => 'time'),
);
$this->widget('bootstrap.widgets.TbNavbar', array(
    'brand' => false,
    'items' => array(
        array(
            'class' => 'bootstrap.widgets.TbMenu',
            'items' => $items,
        )
    )
));
?>
<div class="container top-container">
    <?php echo $content; ?>

    <footer>
        <a href="https://twitter.com/botsikot" class="twitter-follow-button" data-show-count="false" data-lang="fi" data-size="large">Seuraa käyttäjää @botsikot</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
    </footer>
</div>

<?php
$this->endContent();