<?php

return array(
	'modules' => array(
		'gii'=>array(
			'class' => 'yii\gii\module',			
		)
	),
	'components'=>array(
		'db' => array(
			'class' => 'yii\db\Connection',
			'dsn' => 'mysql:host=localhost;dbname=checkstorage',
	        'username' => 'root', 
	        'password' => '',
	        'tablePrefix' => 'tbl_',
		),
	),
);