<?php

require_once(dirname(__FILE__) . '/protected/config/bootstrap.php');

require_once($yii . 'yii.php');
require_once(dirname(__FILE__) . '/protected/components/WebApplication.php');
$app = new WebApplication($config);
$app->run();
