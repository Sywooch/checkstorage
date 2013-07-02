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

// comment out the following line to disable debug mode
defined('YII_DEBUG') or define('YII_DEBUG', true);

require_once(__DIR__ . '/../vendor/yiisoft/yii2/yii/Yii.php');
require_once(__DIR__ . '/../vendor/autoload.php');

Yii::setAlias('@yiidhtmlx', __DIR__ . '/../vendor/philippfrenzel/yiidhtmlx/yiidhtmlx/');
Yii::setAlias('@yiimetroui', __DIR__ . '/../vendor/philippfrenzel/yiimetroui/yiimetroui/');
Yii::setAlias('@yiijquerytoc', __DIR__ . '/../vendor/philippfrenzel/yiijquerytoc/yiijquerytoc/');
Yii::setAlias('@yiiwymeditor', __DIR__ . '/../vendor/philippfrenzel/yiiwymeditor/yiiwymeditor/');

//adding elfinder
Yii::setAlias('@yii2elfinder', __DIR__ . '/../vendor/philippfrenzel/yii2elfinder/yii2elfinder/');

Yii::$classMap['SebastianBergmann\Diff'] = __DIR__ . '/../vendor/sebastian/diff/src/Diff.php';

Yii::$classMap['app\extensions\assetparser\Converter'] = __DIR__ . '/../vendor/yiiext/assetparser/Converter.php';
Yii::$classMap['app\extensions\assetparser\Parser'] = __DIR__ . '/../vendor/yiiext/assetparser/Parser.php';
Yii::$classMap['app\extensions\assetparser\Less'] = __DIR__ . '/../vendor/yiiext/assetparser/Less.php';
Yii::$classMap['app\extensions\assetparser\Sass'] = __DIR__ . '/../vendor/yiiext/assetparser/Sass.php';

if(($baseConfig = includeIfExists(__DIR__.'/../app/config/main.php')) && ($localConfig = includeIfExists(__DIR__.'/../app/config/local.php'))) {
	$config = \yii\helpers\ArrayHelper::merge($baseConfig,$localConfig);
} else {
	$config = $baseConfig;
}

$application = new yii\web\Application($config);
return $application->run();
