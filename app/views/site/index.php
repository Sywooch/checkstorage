<?php
/**
 * @var yii\base\View $this
 */

use yii\helpers\Html;
use yii\widgets\Block;
use yii\widgets\LinkPager;

use yii\bootstrap\Carousel;
use app\models\Messages;

use app\widgets\PortletStorageSearch;

$this->title = 'check storage - Lagerraum, Keller, Dachboden, Selfstorage Vergleich';


$mapJS = <<<DEL

//google.maps.event.addListener(map, 'click', find_closest_marker);
function rad(x) {return x*Math.PI/180;}
function find_closest_marker( event ) {
	var lat = event.latLng.lat();
	var lng = event.latLng.lng();
	var R = 6371;
	var distances = [];
	var closest = -1;
	for( i=0;i<map.markers.length; i++ ) {
		var mlat = map.markers[i].position.lat();
		var mlng = map.markers[i].position.lng();
		var dLat = rad(mlat - lat);
		var dLong = rad(mlng - lng);
		var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
		Math.cos(rad(lat)) * Math.cos(rad(lat)) * Math.sin(dLong/2) * Math.sin(dLong/2);
		var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
		var d = R * c;
		distances[i] = d;
		if ( closest == -1 || d < distances[closest] ) {
			closest = i;
		}
	}
	alert(map.markers[closest].title);
}

DEL;

$this->registerJs($mapJS);

$this->registerJs($map->printHeaderJS());
$this->registerJs($map->printMapJS());

?>

<?php Block::begin(array('id'=>'sidebar')); ?>
	
<?php Block::end(); ?>

<?php Block::begin(array('id'=>'toolbar')); ?>
	
	empty
	
<?php Block::end(); ?>

	<div class="row-fluid">
		<div class="span7">
			<?php echo PortletStorageSearch::widget(array(
          		'maxResults'=>5,
      		)); ?> 
		</div>
		<div class="span5">
			<?php 

			/*$item = array();
			$item[] = array('content'=>"<img src='img/location/".Yii::$app->user->identity->location_id.".jpg'/>",'id'=>Yii::$app->user->identity->Location->name);
			*/

			for($img=1;$img<3;$img++){
				$item[] = array('content'=>"<img src='img/location/".$img.".jpg'/>",'id'=>$img);
			}

			echo Carousel::widget(array(
				'items'=> $item,
				'options'=>array(
					'style'=>'height:230px',
				)
			)); ?>
		</div>		
	</div>

	<!-- Example row of columns -->

	<div class="row-fluid">
		<div class="span4">
			<h4>&nbsp;&nbsp;<i class="icon-user icon-2x"></i> Für Interessenten!</h4>
			<ul>
				<li>Wo ist der nächste Store?</li>
				<li>Welche Leistungen?</li>
				<li>Wieviel kostet es mich?</li>
				<li>Lagertraum - Ich suche, Ihr bietet?!</li>
			</ul>
		</div>
		<div class="span4">
			<h4>&nbsp;&nbsp;<i class="icon-building icon-2x"></i> Für Anbieter!</h4>
			<ul>
				<li>Wo bieten Sie Lagerflächen?</li>
				<li>Zu welchen Konditionen bieten Sie an?</li>
				<li>Welche Mehrwerte bieten Sie?</li>
				<li>Online Vertragsmanagement und Payment</li>
				<li>Lagertraum - Nachfragebörse</li>
			</ul>			
		</div>
		<div class="span4">
			<h4>&nbsp;&nbsp;<i class="icon-book icon-2x"></i>Für Kunden!</h4>
			<ul>
				<li>Meine Abteile</li>
				<li>Meine Rechnungen</li>
			</ul>			
		</div>
	</div>
	<div class="row-fluid">
		<div class="span4">
			<a href="<?php echo Html::url(array('/site/register')); ?>" class="btn btn-success span12"><i class="icon-plus"></i> Registrieren (kostenlos)</a>
		</div>
		<div class="span4">
			<a href="<?php echo Html::url(array('/site/register')); ?>" class="btn btn-inverse span12"><i class="icon-plus"></i> Registrieren (kostenlos)</a>			
		</div>
		<div class="span4">
			<a href="#" class="btn btn-info span12"><i class="icon-signin"></i> Anmelden</a>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span6">
			<h4>&nbsp;&nbsp;<i class="icon-globe icon-2x"></i> Standorte</h4>
			<?php $map->printMap() ?>
		</div>
		<div class="span6">			
			<h4>&nbsp;&nbsp;<i class="icon-truck icon-2x"></i> Ihr Ihrer Nähe</h4>
<ul class="unstyled">	
	<?php foreach( $map->getMarkers() as $n => $marker ): ?>
		<li id="marker<?php echo $n ?>" style="background-image: url(<?php echo $marker->getIcon() ?>)" onclick="<?php echo $marker->getOpener() ?>">
			<b><?php echo $marker->title ?></b>
			<p><?php echo $marker->title ?> marker</p>
		</li>
	<?php endforeach; ?>
</ul>

		</div>
	</div>

	<div class="row-fluid">
		<div class="span6">
			<h4>&nbsp;&nbsp;<i class="icon-bullhorn icon-2x"></i> Neuigkeiten</h4>
			
<?php
if(!empty($_GET['tag'])) { ?>
	<h3>Posts Tagged with <i><?php echo Html::encode($_GET['tag']); ?></i></h3>
<?php
}

foreach($models as $model) {
	echo $this->context->renderPartial('/post/_view', array(
		'data'=>$model,
	));
}

echo LinkPager::widget(array('pagination'=>$pagination));
?>
		
		</div>
		<div class="span6"></div>
	</div>
