<?php
/**
 * This file initializes Yii application
 * Use the environemnt variable to determine which configuration is loaded
 */

//$environment = 'development';
$environment = 'production';
// change the following paths if necessary
$yii = '/var/frameworks/yii/yii-1.1.14/framework/';

if ($environment == 'production') {
    $config =(dirname(__FILE__) . '/production.php');
} else if ($environment == 'development') {

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $config = (dirname(__FILE__) . '/development.php');

    // remove the following lines when in production mode
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    // specify how many levels of call stack should be shown in each log message
    defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);
}
