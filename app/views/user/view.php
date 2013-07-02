<?php
use \yii\helpers\Html;
use \Yii;

use \yii\widgets\Block;
?>

<?php Block::begin(array('id'=>'sidebar')); ?>
	<ul>		
		<li class="sticker sticker-color-yellow"><?php echo Html::a('<i class="icon-arrow-left-3"></i>Overview User', array('/user/admin')); ?></li>
		<?php if (Yii::$app->user->isAdmin OR Yii::$app->user->id == $id): ?>
		<li class="sticker sticker-color-greenDark">
			<a><i class="icon-wrench"></i><?php echo Yii::t('app','Actions'); ?></a>			
			<ul class="sub-menu light">
				<li><?php echo Html::a('<i class="icon-pencil"></i> '.Yii::t('app','Update'), array('/user/update','id'=>$model->id)); ?></li>
				<?php if (Yii::$app->user->isAdmin): ?>
					<li><?php echo Html::a('<i class="icon-remove"></i> '.Yii::t('app','Delete'), array('/user/softdelete','id'=>$model->id)); ?></li>
				<?php endif; ?>
			</ul>
		</li>
		<?php endif; ?>	
	</ul>
<?php Block::end(); ?>

<h1><i class="icon-user"></i> <?php echo Html::encode($model->name).' '.Html::encode($model->prename); ?></h1>

<?php

echo $this->context->renderPartial('_view', array(
	'data'=>$model,
	'msgmodels' => $msgmodels,
	'pagination' => $pagination,
)); ?>
