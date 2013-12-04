<?php

return CMap::mergeArray(
                require(dirname(__FILE__) . '/common.php'), array(
            'components' => array(
                'fixture' => array(
                    'class' => 'system.test.CDbFixtureManager',
                ),
                'db' => array(
                    'connectionString' => 'mysql:host=localhost;dbname=dbname_test',
                    'emulatePrepare' => true,
                    'username' => 'username',
                    'password' => 'password',
                    'charset' => 'utf8',
                ),
            ),
            'import' => array(
                'application.commands.*',
            ),
                )
);
