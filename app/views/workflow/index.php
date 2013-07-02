<?php
use \yii\helpers\Html;
use \yii\widgets\LinkPager;

$this->title=Yii::$app->name . ' - Workflow';
?>

<h1><i class="icon-puzzle"></i>	<?php echo Yii::t('app','Overview Workflow'); ?></h1>

<div style="align:center;">
	<?php echo LinkPager::widget(array('pagination'=>$pagination)); ?>
</div>


<table class="table table-striped hovered">
	<thead>
		<td><?php echo Yii::t('app','Module'); ?></td>
		<td><?php echo Yii::t('app','From User'); ?></td>
		<td><?php echo Yii::t('app','Current User'); ?></td>
		<td><?php echo Yii::t('app','From Status'); ?></td>
		<td><?php echo Yii::t('app','To Status'); ?></td>
		<td><?php echo Yii::t('app','Timestamp'); ?></td>
		<td>	
			<?php echo Yii::t('app','actions'); ?>
		</td>
	</thead>
<?php
foreach($models as $model) {
	echo $this->context->renderPartial('_view_table_row', array(
		'data'=>$model,
	));
}
?>
</table>

<?php

echo LinkPager::widget(array('pagination'=>$pagination));

?>
