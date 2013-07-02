<?php
use \yii\helpers\Html;
use yiimetroui\Accordion;

use yiimetroui\Tabs;

$this->params['breadcrumbs']=array(
	array(
		'label' => $model->title,
		'url' => $model->url
	),
	'Update',
);
?>

<h3>Update <i><?php echo Html::encode($model->title); ?></i></h3>

<?php 
echo Tabs::widget(
	array(
		'items'=>array(
			array(
				'header' => 'BLOG Control',
				'content'=> $this->context->renderPartial('_form', array('model'=>$model)),
			)
		)
	)
); 
?>

<h3><i class="icon-broadcast"></i> <?php echo Yii::t('app','Manual');?></h3>
<?php echo Accordion::widget(array(
		'items'=>array(
			'Manual - allowed syntax'=>array(
				'content'=>$this->context->renderPartial('/site/manual/'.Yii::$app->language.'_wiki_syntax')
			)
		)
	));
?>