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
			echo '<li class="mytoolbox">'.Html::a('<i class="icon-pencil fg-color-white"></i> Standort ändern',array('/storage/update','id'=>$model->id),array('class'=>'fg-color-white')).'</li>';
			echo '<li class="mytoolbox">'.Html::a('<i class="icon-remove fg-color-white"></i> Standort entfernen',array('/storage/softdelete','id'=>$model->id),array('class'=>'fg-color-white')).'</li>';
		}
		
		?>
		</ul>
	</ul>
<?php Block::end(); ?>

<h1><i class="icon-building"></i> <?php echo Html::encode($model->name); ?></h1>

<div class="row-fluid">
	<div class="span4">
		<div class="well">
			<?php echo Html::encode($model->Owner->prename) . ' ' . Html::encode($model->Owner->name); ?><br>
			<?php echo Html::encode($model->address); ?><br>
			<?php echo Html::encode($model->zipcode); ?> <?php echo Html::encode($model->city); ?>
		</div>
<?php
//the sample map content...
$map = new \PHPGoogleMaps\Map;

$map->setHeight(200);
$map->setWidth('100%');

$marker = \PHPGoogleMaps\Overlay\Marker::createFromPosition(new \PHPGoogleMaps\Core\LatLng((double)$model->no_latitude,(double)$model->no_longitude),
	array(
		'title' => $model->name,
		'content' => $model->address." Lagerplatz"
	)
);
$icon1 = new \PHPGoogleMaps\Overlay\MarkerIcon( 'img/flags_iso/24/'.strtolower($model->country).'.png' );
$marker->setIcon( $icon1 );
$map->addObject( $marker );

//adding the user search address
$session = new \yii\web\Session;
if(strlen($session[address])>0)
{
	$marker = \PHPGoogleMaps\Overlay\Marker::createFromLocation($session[address],
		array(
			'title' => $session[address] .' Ihr Standort',
			'content' => "Ihr Standort"
		)
	);
	$icon1 = new \PHPGoogleMaps\Overlay\MarkerIcon( 'img/mapmarker_icon.gif' );
	$marker->setIcon( $icon1 );
	$map->addObject( $marker );
}

$e = new \PHPGoogleMaps\Event\EventListener( $map, 'click', 'find_closest_marker');
$map->addObject( $e );

$this->registerJs($map->printHeaderJS());
$this->registerJs($map->printMapJS());
?>

<?php $map->printMap() ?>
	</div>
	<div class="span8 portlet">
		<table class="table">
			<thead>
				<tr>
					<td>QM</td>
					<td class="span3">Wochenpreis</td>
					<td class="span3">4 Wochenpreis</td>					
				</tr>
			</thead>
			<tr>
				<td class="fg-color-white">1qm</td>
				<td class="bg-color-blue1">
					<small>ab</small> <b><?php //echo $data->getUnitPrice(1.00)->one()->unit_rate; ?></b> <i class="icon-eur tipster" title="Ohne Gewähr!"></i> Woche
				</td>
				<td class="bg-color-blue1">
					<small>ab</small> <b><?php //echo $data->getUnitPrice(1.00)->one()->unit_rate; ?></b> <i class="icon-eur tipster" title="Ohne Gewähr!"></i> Woche
				</td>				
			</tr>
			<tr>
				<td class="fg-color-white">2qm</td>
				<td class="bg-color-blue2">
					<small>ab</small> <b><?php //echo $data->getUnitPrice(1.00)->one()->unit_rate; ?></b> <i class="icon-eur tipster" title="Ohne Gewähr!"></i> Woche
				</td>
				<td class="bg-color-blue2">
					<small>ab</small> <b><?php //echo $data->getUnitPrice(1.00)->one()->unit_rate; ?></b> <i class="icon-eur tipster" title="Ohne Gewähr!"></i> Woche
				</td>			
			</tr>
		</table>
	</div>
</div>

<h2>Leistungsübersicht</h2>

<div class="row-fluid">
	<div class="span6">
<?php

echo \yii\widgets\DetailView::widget(array(
	'model' => $model->Comparision,
	'attributes' => array(
		//'date_opening',
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
