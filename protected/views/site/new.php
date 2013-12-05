<p>
    Filtteröimätön lista generoiduista botsikoista. Peukuta hauskimpia, jotta ne nousevat botsikot-listalle ja päätyvät <a href="https://twitter.com/botsikot">@botsikot</a> twiittaamiksi.
</p>
<?php

$this->renderPartial('list', array(
    'headings' => $headings,
    'headingsData' => $headingsData
));