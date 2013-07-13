<?php
use \yii\helpers\Html;
use \Yii;
use app\models\User;

use \yii\widgets\Block;
?>

<?php Block::begin(array('id'=>'sidebar')); ?>

<ul class="nav nav-list">

<li class="nav-header">Verwaltung</li>
	<ul class="unstyled">
	<?php

	//define the menu items for the storage suppliers and the administrator
	if(Yii::$app->user->isAdmin OR (Yii::$app->user->id == $model->id AND Yii::$app->user->identity->position == User::POS_STORE))
	{
		echo '<li class="mytoolbox">'.Html::a('<i class="icon-building fg-color-white"></i> Lagerplätze',array('/storage/admin','id'=>$model->id),array('class'=>'fg-color-white')).'</li>';
		echo '<li class="mytoolbox">'.Html::a('<i class="icon-dashboard fg-color-white"></i> Interessenten',array('/opportunities/index','id'=>$model->id),array('class'=>'fg-color-white')).'</li>';
		echo '<li class="mytoolbox">'.Html::a('<i class="icon-user fg-color-white"></i> Kunden',array('/opportunities/index','id'=>$model->id),array('class'=>'fg-color-white')).'</li>';
		echo '<li class="mytoolbox">'.Html::a('<i class="icon-archive fg-color-white"></i> Verträge',array('/contract/index','id'=>$model->id),array('class'=>'fg-color-white')).'</li>';
		echo '<li class="mytoolbox">'.Html::a('<i class="icon-eur fg-color-white"></i> Rechnungen',array('/invoice/index','id'=>$model->id),array('class'=>'fg-color-white')).'</li>';
	}

	//define the menu items for the storage suppliers and the administrator
	if(Yii::$app->user->isAdmin OR (Yii::$app->user->id == $model->id AND Yii::$app->user->identity->position == User::POS_CUSTOMER))
	{
		echo '<li class="mytoolbox">'.Html::a('<i class="icon-building fg-color-white"></i> Abteile',array('/unit/admin','id'=>$model->id),array('class'=>'fg-color-white')).'</li>';
		echo '<li class="mytoolbox">'.Html::a('<i class="icon-archive fg-color-white"></i> Verträge',array('/contract/index','id'=>$model->id),array('class'=>'fg-color-white')).'</li>';
		echo '<li class="mytoolbox">'.Html::a('<i class="icon-eur fg-color-white"></i> Rechnungen',array('/invoice/index','id'=>$model->id),array('class'=>'fg-color-white')).'</li>';
	}

	if(Yii::$app->user->isAdmin)
		echo '<li class="mytoolbox">'.Html::a('<i class="icon-remove"></i> Entfernen',array('/user/softdelete','id'=>$model->id),array('class'=>'fg-color-white')).'</li>';

	?>
	</ul>

<li class="nav-header">Mein Account</li>
	<ul class="unstyled">
	<?php

	//define the menu items for the user and the administrator
	if(Yii::$app->user->isAdmin OR Yii::$app->user->id == $model->id)
	{
		echo '<li class="mytoolbox">'.Html::a('<i class="icon-pencil fg-color-white"></i> Ändern',array('/user/update','id'=>$model->id),array('class'=>'fg-color-white')).'</li>';
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
