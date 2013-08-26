<?php

use yii\helpers\Html;
use yiimetroui\Accordion;

?>

<h1><i class="icon-book"></i> <?php echo Yii::t('app','Blog Control'); ?></h1>
<fieldset>
	<legend><?php echo Yii::t('app','Blog') . ' ' . Yii::$app->user->identity->RoleAsString; ?></legend>
	<div class="row">
		<div class="col-lg-12">
			<a class="shortcut" href="<?php echo Html::url(array('/post/create')); ?>">
				<span class="icon">
					<i class="icon-plus"></i>
				</span>
				<span class="label">
					<?php echo Yii::t('app','New'); ?>
				</span>
			</a>
			<a class="shortcut" href="<?php echo Html::url(array('/post/index')); ?>">
				<span class="icon">
					<i class="icon-basket"></i>
				</span>
				<span class="label">
					<?php echo Yii::t('app','Progressing'); ?>
				</span>
			</a>
			<a class="shortcut" href="<?php echo Html::url(array('/post/admin')); ?>">
				<span class="icon">
					<i class="icon-user-3"></i>
				</span>
				<span class="label">
					<?php echo Yii::t('app','Overview'); ?>
				</span>
			</a>
		</div>
	</div>
</fieldset>

<fieldset>
	<legend><?php echo Yii::t('app','CMS') . ' ' . Yii::$app->user->identity->RoleAsString; ?></legend>
	<div class="row">
		<div class="col-lg-12">
			<a class="shortcut" href="<?php echo Html::url(array('/pages/create')); ?>">
				<span class="icon">
					<i class="icon-plus"></i>
				</span>
				<span class="label">
					<?php echo Yii::t('app','New'); ?>
				</span>
			</a>
			<a class="shortcut" href="<?php echo Html::url(array('/pages/index')); ?>">
				<span class="icon">
					<i class="icon-basket"></i>
				</span>
				<span class="label">
					<?php echo Yii::t('app','Progressing'); ?>
				</span>
			</a>
			<a class="shortcut" href="<?php echo Html::url(array('/pages/admin')); ?>">
				<span class="icon">
					<i class="icon-user-2"></i>
				</span>
				<span class="label">
					<?php echo Yii::t('app','Management'); ?>
				</span>
			</a>
		</div>
	</div>
</fieldset>

<h3><i class="icon-broadcast"></i> <?php echo Yii::t('app','Manual');?></h3>
<?php echo Accordion::widget(array(
		'items'=>array(
			Yii::t('app','Blog')=>array(
				'content'=>$this->context->renderPartial('/site/manual/'.Yii::$app->language.'_blog')
			)
		)
	));
?>
