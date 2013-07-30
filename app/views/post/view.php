<?php
use \yii\helpers\Html;
use \Yii;

use yii\jui\Accordion;
?>

<?php 
$commentCount = 0;
if (count($model->comments) > 0 ) $commentCount=count($model->comments);
echo $this->context->renderPartial('_view', array(
	'data'=>$model,
	'commentCount'=>$commentCount
)); ?>

<div id="comments" class="row-fluid">
	<?php
	if($commentCount>=1): ?>
		<h2>
			<i class="icon-comments-4"></i>
			<?php echo $commentCount>1 ? $commentCount . Yii::t('app',' comments') : 'One comment'; ?>
		</h2>

		<?php echo $this->context->renderPartial('_comments',array(
			'post'=>$model,
			'comments'=>$model->comments,
		)); ?>
	<?php endif; ?>

	<?php if(Yii::$app->session->hasFlash('commentSubmitted')): ?>
		<div class="flash-success">
			<?php echo Yii::$app->session->getFlash('commentSubmitted'); ?>
		</div>
	<?php else: ?>		
		<?php echo Accordion::widget(array(
			'items'=>array(
				array(
					'header'=>Yii::t('app','Leave a Comment'),
					'content'=>$this->context->renderPartial('/comment/_form',array('model'=>$comment))
				)
			),
			'clientOptions'=>array(
				'collapsible'=>true,
				'collapsed'=>true,
			)
		));
		?>
	<?php endif; ?>
	<p>&nbsp;</p>
</div><!-- comments -->
