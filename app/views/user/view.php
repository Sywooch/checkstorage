<?php
use \yii\helpers\Html;
use \Yii;

use \yii\widgets\Block;
?>

<?php Block::begin(array('id'=>'sidebar')); ?>

<ul class="nav nav-list">
<li class="nav-header">Aktionen</li>

<?php

if(Yii::$app->user->isAdmin OR Yii::$app->user->id == $model->id)
	echo Html::a('<i class="icon-pencil"></i> Ändern',array('/user/update','id'=>$model->id));

if(Yii::$app->user->isAdmin)
	echo Html::a('<i class="icon-remove"></i> Entfernen',array('/user/softdelete','id'=>$model->id));

?>

</ul>

<?php Block::end(); ?>

<h1><i class="icon-user"></i> <?php echo Html::encode($model->name).' '.Html::encode($model->prename); ?></h1>

<?php

echo $this->context->renderPartial('_view', array(
	'data'=>$model,
	'msgmodels' => $msgmodels,
	'pagination' => $pagination,
)); ?>