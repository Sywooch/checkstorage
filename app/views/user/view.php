<?php
use \yii\helpers\Html;
use \Yii;
use app\models\User;

use \yii\widgets\Block;
?>

<?php Block::begin(array('id'=>'sidebar')); ?>

<ul class="nav nav-list">

<li class="nav-header">Verwaltung</li>
	<?php

	//define the menu items for the storage suppliers and the administrator
	if(Yii::$app->user->isAdmin OR (Yii::$app->user->id == $model->id AND Yii::$app->user->identity->position == User::POS_STORE))
	{
		echo '<div class="list-group-item">'.Html::a('<i class="icon-building"></i> Lagerplätze',array('/storage/admin','id'=>$model->id)).'</div>';
		echo '<div class="list-group-item">'.Html::a('<i class="icon-dashboard"></i> Interessenten',array('/opportunities/index','id'=>$model->id)).'</div>';
		//echo '<div class="list-group-item">'.Html::a('<i class="icon-user"></i> Kunden',array('/opportunities/index','id'=>$model->id)).'</div>';
		//echo '<div class="list-group-item">'.Html::a('<i class="icon-archive"></i> Verträge',array('/contracts/contracts/index','id'=>$model->id)).'</div>';
		//echo '<div class="list-group-item">'.Html::a('<i class="icon-eur"></i> Rechnungen',array('/invoice/index','id'=>$model->id)).'</div>';
	}

	//define the menu items for the storage suppliers and the administrator
	if(Yii::$app->user->isAdmin OR (Yii::$app->user->id == $model->id AND Yii::$app->user->identity->position == User::POS_CUSTOMER))
	{
		echo '<div class="list-group-item">'.Html::a('<i class="icon-building"></i> Abteile',array('/unit/admin','id'=>$model->id)).'</div>';
		echo '<div class="list-group-item">'.Html::a('<i class="icon-archive"></i> Verträge',array('/contract/index','id'=>$model->id)).'</div>';
		echo '<div class="list-group-item">'.Html::a('<i class="icon-eur"></i> Rechnungen',array('/invoice/index','id'=>$model->id)).'</div>';
	}

	if(Yii::$app->user->isAdmin)
		echo '<div class="list-group-item">'.Html::a('<i class="icon-remove"></i> Entfernen',array('/user/softdelete','id'=>$model->id)).'</div>';

	?>

	<li class="nav-header">Mein Account</li>

	<?php

	//define the menu items for the user and the administrator
	if(Yii::$app->user->isAdmin OR Yii::$app->user->id == $model->id)
	{
		echo '<div class="list-group-item">'.Html::a('<i class="icon-pencil"></i> Ändern',array('/user/update','id'=>$model->id)).'</div>';
	}
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
