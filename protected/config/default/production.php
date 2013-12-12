<?php

return CMap::mergeArray(
                require(dirname(__FILE__) . '/common.php'), array(
            'components' => array(
                'clientScript' => array(
                    'class' => 'ext.minScript.components.ExtMinScript',
                ),
            // Use this to override the db config
            /*
              'db' => array(
              'connectionString' => 'mysql:host=localhost;dbname=proddbname',
              'emulatePrepare' => true,
              'username' => 'username',
              'password' => 'password',
              'charset' => 'utf8',
              ),
             */
            ),
            'controllerMap' => array(
                'min' => array(
                    'class' => 'ext.minScript.controllers.ExtMinScriptController',
                ),
            ),
            'params' => array(
                'googleAnalytics' => array(
                    'id' => '',
                )
            ),
                )
);