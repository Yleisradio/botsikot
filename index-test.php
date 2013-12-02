<?php
require_once(dirname(__FILE__) . '/protected/config/bootstrap.php');

$config = dirname(__FILE__) . '/protected/config/test.php';

// remove the following line when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', true);

require_once($yii . 'yii.php');
$app = new WebApplication($config);
$app->run();

