<?php
use \yii\helpers\Html;
use \Yii;

use \yii\widgets\Block;
?>

<?php Block::begin(array('id'=>'sidebar')); ?>
	<ul class="nav nav-list">
	<li class="nav-header">Aktionen</li>
		<ul class="unstyled">
		<?php

		if(Yii::$app->user->isAdmin OR Yii::$app->user->id == $model->user_id){
			echo '<li>'.Html::a('<i class="icon-pencil"></i> Standort ändern',array('/storage/update','id'=>$model->id)).'</li>';
			echo '<li>'.Html::a('<i class="icon-plus"></i> Neuer Standort',array('/storage/create')).'</li>';
			echo '<li>'.Html::a('<i class="icon-remove"></i> Standort entfernen',array('/storage/softdelete','id'=>$model->id)).'</li>';
		}
		
		?>
		</ul>
	</ul>
<?php Block::end(); ?>

<h1><i class="icon-user"></i> <?php echo Html::encode($model->name).' '.Html::encode($model->prename); ?></h1>

<?php

echo $this->context->renderPartial('_view', array(
	'data'=>$model,
	'msgmodels' => $msgmodels,
	'pagination' => $pagination,
)); ?>
