<?php
use \yii\helpers\Html;
use \Yii;
?>

<?php

echo $this->context->renderPartial('_view', array(
	'data'=>$model
)); ?>
