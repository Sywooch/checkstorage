<?php

return array(
	'components' => array(
		'db' => array(
			'class' => 'yii\db\Connection',
			'dsn' => 'mysql:host=localhost;dbname=mpintranet',
            'username' => 'root', 
            'password' => '',
            'tablePrefix' => 'tbl_',
		),
	),
);