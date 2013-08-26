<?php
use \yii\helpers\Html;
use \Yii;

use \yii\widgets\Block;
use \yii\bootstrap\Tabs;
?>

<?php Block::begin(array('id'=>'sidebar')); ?>
	<ul class="nav nav-list">
	<li class="nav-header">Verwaltung</li>
		<ul class="unstyled">
		<?php

		if(Yii::$app->user->isAdmin OR Yii::$app->user->id == $model->user_id){
			echo '<li class="mytoolbox">'.Html::a('<i class="icon-archive fg-color-white"></i> Verträge',array('/contracts/contracts/index','id'=>$model->id),array('class'=>'fg-color-white')).'</li>';
			echo '<li class="mytoolbox">'.Html::a('<i class="icon-user fg-color-white"></i> Kunden',array('/opportunities/index','id'=>$model->id),array('class'=>'fg-color-white')).'</li>';
			echo '<li class="mytoolbox">'.Html::a('<i class="icon-eur fg-color-white"></i> Rechnungen',array('/invoice/index','id'=>$model->id),array('class'=>'fg-color-white')).'</li>';
		}
		
		?>
		</ul>
	<li class="nav-header">Standort Aktionen</li>
		<ul class="unstyled">
		<?php

		if(Yii::$app->user->isAdmin OR Yii::$app->user->id == $model->user_id){
			echo '<li class="mytoolbox">'.Html::a('<i class="icon-pencil fg-color-white"></i> Standort ändern',array('/storage/update','id'=>$model->id),array('class'=>'fg-color-white')).'</li>';
			echo '<li class="mytoolbox">'.Html::a('<i class="icon-remove fg-color-white"></i> Standort entfernen',array('/storage/softdelete','id'=>$model->id),array('class'=>'fg-color-white')).'</li>';
		}
		
		?>
		</ul>
	</ul>
<?php Block::end(); ?>

<h1><img src="img/storage/<?php echo Html::encode($model->Owner->id); ?>.png" alt="logo"></img> <?php echo Html::encode($model->name); ?></h1>

<div class="row">
	<div class="col-lg-4">
		<div class="well">
			<?php echo Html::encode($model->Owner->prename) . ' ' . Html::encode($model->Owner->name); ?><br>
			<?php echo Html::encode($model->address); ?><br>
			<?php echo Html::encode($model->zipcode); ?> <?php echo Html::encode($model->city); ?>
		</div>
	</div>
	<div class="col-lg-8 portlet">
		<h4 class="fg-color-white">Preistabelle</h4>
		TO BE FILLED LATER
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		
<?php 
$myTabs = array();
$myTabs[] = array(
    'label' => Yii::t('app','Alle Abteile'),
    'active' => true,
    'content' => $this->context->renderPartial('/../modules/units/views/units/dashboard', array('dpUnit'=>$dpUnit)),
);
/*$myTabs[] = array(
            'label' => Yii::t('app','User Contact'),
            'content' => $this->context->renderPartial('/user/_form_contact', array('model'=>$model,'form'=>$form)),
        );*/

echo Tabs::widget(array(
     'id'=>'userTabs',
     'items' => $myTabs,
));
?>

	</div>
</div>
