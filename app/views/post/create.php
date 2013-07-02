<?php

//use yii\widgets\Block;
use yii\helpers\Html;
use yiimetroui\Tabs;
use yiimetroui\Accordion;

$this->params['breadcrumbs']=array(
	'Create Post',
);
?>

<?php echo Tabs::widget(
	array(
		'items'=>array(
			array(
				'header' => 'Blog Control',
				'content'=> $this->context->renderPartial('_form', array('model'=>$model)),
			)
		)
	)
); ?>

<?php echo Accordion::widget(array(
		'items'=>array(
			'Manual - allowed syntax'=>array(
				'content'=>$this->context->renderPartial('/site/manual/'.Yii::$app->language.'_wiki_syntax')
			)
		)
	));
?>
