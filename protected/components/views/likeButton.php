<?php
if (!$this->liked) {
    echo CHtml::link('<i class="icon-thumbs-up"></i>', "#", array("data-id" => $this->headingId, "class" => "like btn btn-primary"));
}
