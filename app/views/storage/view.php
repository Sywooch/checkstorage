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
			echo '<li>'.Html::a('<i class="icon-remove"></i> Standort entfernen',array('/storage/softdelete','id'=>$model->id)).'</li>';
		}
		
		?>
		</ul>
	</ul>
<?php Block::end(); ?>

<h1><i class="icon-building"></i> <?php echo Html::encode($model->name); ?></h1>


<h2>Leistungsübersicht</h2>

<div class="row-fluid">
	<div class="span6">
<?php

echo \yii\widgets\DetailView::widget(array(
	'model' => $model->Comparision,
	'attributes' => array(
		'date_opening',
		'no_elevators',
		'room_height',
		'opening_start',
		'opening_end',
		'opening_days',
		'opening_office_start',
		'opening_office_end',
		'opening_office_days',
		'no_parking',
		'max_degrees',
		'min_degrees',
	),
));

/*
'title', // title attribute (in plain text)
'description:html', // description attribute in HTML
array( // the owner name of the model
	'label' => 'Owner',
	'value' => $model->owner->name,
),*/

?>		
	</div>
	<div class="span6">
<?php

echo \yii\widgets\DetailView::widget(array(
	'model' => $model->Comparision,
	'attributes' => array(
		array(
			'name' => 'fireprotection',
			'label'=>'Feuermelder',
			'type' => 'raw',
			'value'=>$model->Comparision->fireprotection==0?'<i class="icon-check-empty"></i>':'<i class="icon-check"></i>'
		),
		array(
			'name' => 'security_camera',
			'label'=>'Kameraüberwacht',
			'type' => 'raw',
			'value'=>$model->Comparision->security_camera==0?'<i class="icon-check-empty"></i>':'<i class="icon-check"></i>'
		),
		array(
			'name' => 'security_access',
			'label'=>'Zugriffssteuerung',
			'type' => 'raw',
			'value'=>$model->Comparision->security_access==0?'<i class="icon-check-empty"></i>':'<i class="icon-check"></i>'
		),
		array(
			'name' => 'security_service',
			'label'=>'Wachdienst',
			'type' => 'raw',
			'value'=>$model->Comparision->security_service==0?'<i class="icon-check-empty"></i>':'<i class="icon-check"></i>'
		),
		array(
			'name' => 'externalunits',
			'label'=>'Aussenlager',
			'type' => 'raw',
			'value'=>$model->Comparision->externalunits==0?'<i class="icon-check-empty"></i>':'<i class="icon-check"></i>'
		),
		array(
			'name' => 'trolleys',
			'label'=> 'Transporthilfen',
			'type' => 'raw',
			'value'=>$model->Comparision->trolleys==0?'<i class="icon-check-empty"></i>':'<i class="icon-check"></i>'
		),
		array(
			'name' => 'aircondition',
			'label'=> 'Klimaanlage',
			'type' => 'raw',
			'value'=>$model->Comparision->aircondition==0?'<i class="icon-check-empty"></i>':'<i class="icon-check"></i>'
		),
		array(
			'name' => 'aircondition_office',
			'label'=> 'Klimaanlage Büro',
			'type' => 'raw',
			'value'=>$model->Comparision->aircondition_office==0?'<i class="icon-check-empty"></i>':'<i class="icon-check"></i>'
		),
		array(
			'name' => 'shopping',
			'label'=> 'Verpackungsmaterial vor Ort',
			'type' => 'raw',
			'value'=>$model->Comparision->shopping==0?'<i class="icon-check-empty"></i>':'<i class="icon-check"></i>'
		),	
		//'shopping_pricelevel',
		array(
			'name' => 'music',
			'label'=> 'Musik',
			'type' => 'raw',
			'value'=>$model->Comparision->music==0?'<i class="icon-check-empty"></i>':'<i class="icon-check"></i>'
		),
	),
));

/*
'title', // title attribute (in plain text)
'description:html', // description attribute in HTML
array( // the owner name of the model
	'label' => 'Owner',
	'value' => $model->owner->name,
),*/

?>	
	</div>
</div>
