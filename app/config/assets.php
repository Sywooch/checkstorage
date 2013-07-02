<?php

return array(
    'app' => array(
        'basePath' => '@wwwroot',
        'baseUrl' => '@www',
        'css' => array(
            'css/site.css',
            'less/modern.less',
        ),
        'js' => array(
            'js/dropdown.js',
        ),
        'depends' => array(
            'yii',
            'yii/bootstrap'
        ),
    ),
    'jquerymetroui' => array(
        'basePath' => '@wwwroot',
        'baseUrl' => '@www',
        'css' => array(
            'css/jquery-ui.css',
        )
    ),
    'app/syntaxhighlighter' => array(
        'basePath' => '@wwwroot',
        'baseUrl' => '@www',
        'css' => array(
            'css/syntaxhighlighter/github.css',
        ),
        'js' => array(
            'js/syntaxhighlighter/highlight.pack.js',
        ),
        'depends'=> array(
            'yii/jquery'
        )
    )
);