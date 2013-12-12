<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return CMap::mergeArray(
                require(dirname(__FILE__) . '/common.php'), array(
            'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
            'name' => 'My Console Application',
            // preloading 'log' component
            'preload' => array('log'),
            // application components
            'import' => array(
                'application.models.*',
                'application.components.*',
            ),
            'components' => array(
                // Use this to override the db config
                /*
                  'db' => array(
                  'connectionString' => 'mysql:host=localhost;dbname=dbname',
                  'emulatePrepare' => true,
                  'username' => 'dbusername',
                  'password' => 'dbpassword',
                  'charset' => 'utf8',
                  ),
                 */
                'cache' => array(
                    'class' => 'CApcCache',
                ),
                'log' => array(
                    'class' => 'CLogRouter',
                    'routes' => array(
                        array(
                            'class' => 'CFileLogRoute',
                            'levels' => 'error, warning, info',
                        ),
                    ),
                ),
            ),
            'params' => array(
                'tweetLinkBaseUrl' => '',
            ),
                )
);