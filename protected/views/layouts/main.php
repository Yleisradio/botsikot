<?php
$this->beginContent('//layouts/base');

$items = array(
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