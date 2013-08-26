<?php 
use \yii\helpers\Html;

if (!isset($commentCount)) {
	$commentCount = 0;
	if (count($data->comments) > 0 ) $commentCount=count($data->comments);
}
?>

<h5>
	<?php echo Html::encode($data->title);?>
	<?php echo Html::a(Yii::t('app','view'), $data->url); ?>
</h5>
<p class="meta"><?php echo Yii::t('app','Posted by');?> <?php echo $data->author->username . ' on ' . date('F j, Y',$data->time_create); ?></p>
<p>
	<?php
		echo $data->content;
	?>
<p>
<p class="tags">
	<strong><?php echo Yii::t('app','Tags'); ?>:</strong>
	<?php echo implode(' ', $data->tagLinks); ?>
	<?php echo Html::a('<i class="icon-link"></i>Permalink', $data->url); ?> |
	<?php echo Html::a('<i class="icon-comments-4"></i>'."Comments ({$commentCount})",$data->url.'#comments'); ?> |
	<?php echo Yii::t('app','Last updated on'); ?> <?php echo date('F j, Y',$data->time_update); ?>
</p>
