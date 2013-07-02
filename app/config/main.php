<?php

$params = require(__DIR__ . '/params.php');

return array(
	'id' => 'app',
	'name' => 'myplace intranet',
	'basePath' => dirname(__DIR__),
	'vendorPath' => dirname(__DIR__) . '/vendor',
	'preload' => array('log'),
	'controllerNamespace' => 'app\controllers',
	'charset'=>'UTF-8',
	'language' => 'de_DE',	
	'modules' => array(	
		/*'debug' => array(
			'class' => 'yii\debug\Module',
		)*/
	),
	'components' => array(
		'cache' => array(
			'class' => 'yii\caching\FileCache',
		),
		'db' => array(
			'class' => 'yii\db\Connection',
			'dsn' => 'mysql:host=localhost;dbname=mpintranet',
            'username' => 'root', 
            'password' => '',
            'tablePrefix' => 'tbl_',
		),
		'user' => array(
			'class' => 'app\components\AppUser',
			'identityClass' => 'app\models\User',
		),
		'log' => array(
			'class' => 'yii\logging\Router',
			'targets' => array(
				'file' => array(
					'class' => 'yii\logging\FileTarget',
					'levels' => array('error','warning'),
				),
			),
		),		
		'assetManager'=>array(
			'bundles' => require(__DIR__ . '/assets.php'),				
			'converter'=>array(
                'class'=>'app\extensions\assetparser\Converter',
                'force'=>true,
                'parsers' => array(
                    'sass' => array( // file extension to parse
                        'class' => 'app\extensions\assetparser\Sass',
                        'output' => 'css', // parsed output file type
                        'options' => array(
                            'cachePath' => '@app/../runtime/cache/sass-parser' // optional options
                        ),
                    ),
                    'scss' => array( // file extension to parse
                        'class' => 'app\extensions\assetparser\Sass',
                        'output' => 'css', // parsed output file type
                        'options' => array() // optional options
                    ),
                    'less' => array( // file extension to parse
                        'class' => 'app\extensions\assetparser\Less',
                        'lessParserPath' => '@app/../vendor/yiiext/assetparser/vendors/lessphp/lessc.inc.php',
                        'output' => 'css', // parsed output file type
                        'options' => array(
                            'auto' => true                            
                        )
                    )
                )
			)
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