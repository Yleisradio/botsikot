<?php
$this->beginContent('//layouts/base');
?>

<nav class="navbar navbar-default">
    <div class="container">
            <?php
            $this->widget('zii.widgets.CMenu', array(
                'htmlOptions' => array(
                    'class' => 'nav navbar-nav',
                ),
                'encodeLabel' => false,
                'items' => array(
                    array('label' => '<i class="icon-bolt"></i>Botsikot', 'url' => array('/')),
                    array('label' => '<span class="icon-star"></span>Parhaat', 'url' => array('/parhaat')),
                    array('label' => '<span class="icon-time"></span>Uudet', 'url' => array('/uudet')),
                ),
            ));
            ?>
            <?php
            $this->widget('zii.widgets.CMenu', array(
                'htmlOptions' => array(
                    'class' => 'nav navbar-nav pull-right',
                ),
                'items' => array(
                    array('itemOptions' => array('id' => 'login-button'), 'label' => 'Kirjaudu sisään', 'url' => array('/')),
                    array('itemOptions' => array('id' => 'logout-button'), 'label' => 'Kirjaudu ulos', 'url' => array('/')),
                ),
            ));
            ?>
    </div>
</nav>
<div class="container top-container">
    <?php echo $content; ?>

    <footer>
        <a href="https://twitter.com/botsikot" class="twitter-follow-button" data-show-count="false" data-lang="fi" data-size="large">Seuraa käyttäjää @botsikot</a>
        <script>!function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                if (!d.getElementById(id)) {
                    js = d.createElement(s);
                    js.id = id;
                    js.src = p + '://platform.twitter.com/widgets.js';
                    fjs.parentNode.insertBefore(js, fjs);
                }
            }(document, 'script', 'twitter-wjs');</script>
    </footer>
</div>

<?php
$this->endContent();