<?php

$params = require(__DIR__ . '/../../app/config/params.php');

return array(
	'id' => 'checkstorage',
	'basePath' => dirname(__DIR__),
	'controllerPath' => '@app/controllers',
	'components' => array(
		'db' => array(
			'class' => 'yii\db\Connection',
			'dsn' => 'mysql:host=localhost;dbname=checkstorage',
            'username' => 'root', 
            'password' => '',
            'tablePrefix' => 'tbl_',
		),
		/*'db' => array(
			'class'       => 'yii\db\Connection',
			'dsn'         => 'sqlite:'.dirname(__DIR__).'/../app/data/frenzelgmbh.db',
			'tablePrefix' => 'tbl_',
		),*/
		'seeder'=>array(
			'class'    =>'app\components\DbFixtureManager',
			'basePath' => dirname(__DIR__).'/migrations/seed',
        ),
        'preseeder'=>array(
			'class'    =>'app\components\DbFixtureManager',
			'basePath' => dirname(__DIR__).'/migrations/preseed',
        ),
		'log' => array(
			'targets' => array(
				'file' => array(
					'class'  => 'yii\log\FileTarget',
					'levels' => array('error', 'warning'),
				),
			),
		),
	),
	'params' => $params,
);