<?php
use \yii\helpers\Html;
use \yii\widgets\LinkPager;

$this->title=Yii::$app->name . ' - Messages';

foreach($models as $model) {
	echo $this->context->renderPartial('_view', array(
		'data'=>$model,
	));
}

echo LinkPager::widget(array('pagination'=>$pagination));

?>
