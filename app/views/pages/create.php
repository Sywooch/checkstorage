<?php

use yii\widgets\Block;
use yii\helpers\Html;
use yii\bootstrap\Tabs;
use yiimetroui\Accordion;


$this->params['breadcrumbs']=array(
	'Create Page',
);
?>

<?php Block::begin(array('id'=>'sidebar')); ?>
	<ul>
		<li class="sticker sticker-color-yellow"><?php echo Html::a('<i class="icon-arrow-left-3"></i> '.Yii::t('app','Back to overview'), array('/post/indexadmin')); ?></li>
	</ul>
<?php Block::end(); ?>

<?php echo Tabs::widget(
	array(
		'items'=>array(
			array(
				'label' => 'CMS Control',
				'active' => true,
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
