<?php

return array(
    'app' => array(
        'basePath' => '@wwwroot',
        'baseUrl' => '@www',
        'css' => array(
            'css/bootstrap.min.css',
            'css/font-awesome.min.css',
            'css/site.css',            
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