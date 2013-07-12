<?php

/*
 *
 * Company Intranet
 * @company Frenzel GmbH
 * @copy    Frenzel GmbH 2013
 * @contact philipp@frenzel.net
 *
 */

//Set the default time zone to europe/berlin
ini_set('date.timezone','Europe/Berlin');

if (function_exists('date_default_timezone_set')) {
	date_default_timezone_set('Europe/Berlin');
}

function includeIfExists($file)
{
	if(file_exists($file)) {
		return include $file;
	}
}

function clean_composer_namespace($nsfile)
{
	$clean = array();
	foreach($nsfile AS $name => $patharray)
	{	
		$clean[$name] = $patharray[0];		
	}
	return $clean;
}

// comment out the following line to disable debug mode
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../vendor/yiisoft/yii2/yii/Yii.php');
require(__DIR__ . '/../vendor/autoload.php');

Yii::importNamespaces(clean_composer_namespace(require(__DIR__ . '/../vendor/composer/autoload_namespaces.php')));

//require(__DIR__ . '/../vendor/composer/autoload_classmap.php');  

//Yii::$classMap['SebastianBergmann\Diff'] = __DIR__ . '/../vendor/sebastian/diff/src/Diff.php';

if(($baseConfig = includeIfExists(__DIR__.'/../app/config/main.php')) && ($localConfig = includeIfExists(__DIR__.'/../app/config/local.php'))) {
	$config = \yii\helpers\ArrayHelper::merge($baseConfig,$localConfig);
} else {
	$config = $baseConfig;
}

$application = new yii\web\Application($config);

$exitCode = $application->run();
exit($exitCode);
