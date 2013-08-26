<?php

use \Yii;
use \yii\helpers\Html;
use \yii\grid\GridView;

?>

<h1>Abteile</h1>

<?php 
	echo GridView::widget(array(
		'dataProvider'=>$dpUnits,
	));
?>