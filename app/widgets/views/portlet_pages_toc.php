<?php

use \Yii;
use \yii\helpers\Html;
use yiijquerytoc\yiijquerytoc;

?>

<?php

echo yiijquerytoc::widget(
	array(
		'scope' => '#cmswrapper',
		'clientOptions'=>array(
		 	'depth' => 4,
		 	'topLinks' => false,
		),			
	    'options'=>array(
			'id'    => 'toccmspage',
			'data-spy' => 'affix',
			'data-offset-top' => 250,			
		),
	)
);
?>
