<?php

$params = require(__DIR__ . '/params.php');

return array(
	'id' => 'app',
	'name' => 'check storage - Lagerraum, Keller, Dachboden, Selfstorage Vergleich',
	'basePath' => dirname(__DIR__),
	'vendorPath' => dirname(__DIR__) . '/vendor',
	'preload' => array('debug'),
	'controllerNamespace' => 'app\controllers',
	'charset'=>'UTF-8',
	'language' => 'de_DE',	
	'modules' => array(
		'units' => array(
			'class' => 'app\modules\units\Units'
		),
		'contracts' => array(
			'class' => 'app\modules\contracts\Contracts'
		),	
		'debug' => array(
			'class' => 'yii\debug\Module',
			'enabled' => YII_DEBUG && YII_ENV === 'dev',
		),
	),
	'components' => array(
		'cache' => array(
			'class' => 'yii\caching\FileCache',
		),
		'db' => array(
			'class' => 'yii\db\Connection',
			'dsn' => 'mysql:host=localhost;dbname=checkstorage',
            'username' => 'root', 
            'password' => '',
            'tablePrefix' => 'tbl_',
		),
		'user' => array(
			'class' => 'app\components\AppUser',
			'identityClass' => 'app\models\User',
		),
		'log' => array(
			'targets' => array(
				'file' => array(
					'class' => 'yii\log\FileTarget',
					'levels' => array('error','warning'),
				),
			),
		),
		'translations' => array(
			array(
				'class' => 'yii\i18n\PhpMessageSource',
				'basePath' => "@app/messages",
				'sourceLanguage' => 'en_US',
				'fileMap' => array(
					'app'=>'app.php'
				)
			)
		),
	),
	'params' => $params,
);