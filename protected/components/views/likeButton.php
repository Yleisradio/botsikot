<?php
if ($this->liked) {
    echo CHtml::link('<div class="likes">' . $this->likes . '</div><i class="icon-thumbs-up"></i>', "#", array("data-id" => $this->headingId, "class" => "like btn btn-inverse"));
}
else {
    echo CHtml::link('<div class="likes">' . $this->likes . '</div><i class="icon-thumbs-up"></i>', "#", array("data-id" => $this->headingId, "class" => "like btn btn-primary"));
}
