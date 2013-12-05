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

</div>
<?php
$this->endContent();