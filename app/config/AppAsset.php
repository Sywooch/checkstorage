<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\config;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = array(        
        'css/font-awesome.min.css',
        'css/syntaxhighlighter/github.css',
        'css/site.css',
        'css/custom-theme/jquery-ui-1.10.0.custom.css',
    );
    public $js = array(
        'js/dropdown.js',
        'js/syntaxhighlighter/highlight.pack.js',
    );
    public $depends = array(
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset'
    );
}
