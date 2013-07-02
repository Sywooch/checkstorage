<?php
use yii\helpers\Html;

use yii2elfinder\yii2elfinder;
/**
 * @var yii\base\View $this
 */
$this->title = 'File Manager';
?>

<h1><?php echo Html::encode($this->title); ?></h1>

<?php

echo yii2elfinder::widget(
	array(
		'id' => 'myElFilemanager',
		'connectorRoute' => 'site/connector',
		'clientOptions' => array(
			'uiOptions' => array(
                'toolbar' => array(
                    // toolbar configuration
                    ['open'],
                    ['back', 'forward'],
                    ['reload'],
                    ['home', 'up'],
                    ['mkdir', 'mkfile', 'upload'],
                    ['info'],
                    ['quicklook'],
                    ['copy', 'cut', 'paste'],
                    ['rm'],
                    ['duplicate', 'rename', 'edit'],
                    ['extract', 'archive'],
                    ['search'],
                    ['view'],
                    ['help']
                )
            ),
            'contextmenu' => array(
                'files'  => array(
                    'getfile', '|','open', '|', 'copy', 'cut', 'paste', 'duplicate', '|',
                    'rm', '|', 'edit', 'rename', '|', 'archive', 'extract', '|', 'info'
                )
            ),
            'dragUploadAllow' => true,
		),
	)
);

?>