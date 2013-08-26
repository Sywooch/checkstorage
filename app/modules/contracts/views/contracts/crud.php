<?php

//use yii\widgets\Block;
use yii\helpers\Html;
use yii\bootstrap\Tabs;

$this->params['breadcrumbs']=array(
	'CRUD Post',
);
?>

<?php echo Tabs::widget(
	array(
		'items'=>array(
			array(
				'label' => 'Stammdaten',
				'content'=> $this->context->renderPartial('_form', array('model'=>$model)),
				'active' => true				
			)
		)
	)
); ?>
