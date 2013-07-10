<?php
/**
 * @var yii\base\View $this
 */

use yii\helpers\Html;
use yii\widgets\Block;
use yii\widgets\LinkPager;

use app\models\Messages;

use app\widgets\PortletStorageSearch;

use yii2tooltipster\yii2tooltipster;

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
?>

<?php echo yii2tooltipster::widget(array('options'=>array('class'=>'.tipster'))); ?>

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

<?php
//the sample map content...
		$map = new \PHPGoogleMaps\Map;

		$map->setHeight(350);
		$map->setWidth('100%');

		if(count(Yii::$app->controller->locations)==0)
		{
			$tmplocations = array();
			$storages = app\models\Storage::find()->select('city, country')->distinct()->all();
			foreach($storages as $storage)
			{
				$tmplocations[] = $storage->city .', '.$storage->country;
			}

			Yii::$app->controller->locations = $tmplocations;

			foreach( Yii::$app->controller->locations as $i => $location ) {
				$marker = \PHPGoogleMaps\Overlay\Marker::createFromLocation($location,
					array(
						'title' => $location,
						'content' => "$location Lagerplatz"
					)
				);
				$icon1 = new \PHPGoogleMaps\Overlay\MarkerIcon( 'img/flags_iso/24/'.strtolower(substr($location,-2)).'.png' );
				$marker->setIcon( $icon1 );
				$map->addObject( $marker );
			}	
		}
		else
		{
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

			if(count(Yii::$app->controller->locations)>0){
				foreach( Yii::$app->controller->locations as $i => $location ) {
					$marker = \PHPGoogleMaps\Overlay\Marker::createFromLocation($location->address.', '.$location->city,
						array(
							'title' => $location->address.' Lagerraum',
							'content' => "$location->address Lagerplatz"
						)
					);
					$icon2 = new \PHPGoogleMaps\Overlay\MarkerIcon( 'img/truck3.png' );
					$marker->setIcon( $icon2 );
					$map->addObject( $marker );
				}	
			}
		}

		$e = new \PHPGoogleMaps\Event\EventListener( $map, 'click', 'find_closest_marker');
		$map->addObject( $e );

$this->registerJs($map->printHeaderJS());
$this->registerJs($map->printMapJS());
?>

			<div class="row-fluid">
				<div class="span6">
					<h4>&nbsp;&nbsp;<i class="icon-user icon-2x"></i> Für Interessenten!</h4>
					<ul>
						<li>Bedarfssammler</li>
						<li>Wo liegt mein nächster SelfStorage Anbieter?</li>
						<li>Welche Mehrleistungen?</li>
						<li>Wieviel kostet es mich?</li>
						<li>Lagertraum - Ich suche, Ihr bietet?!</li>
					</ul>
				</div>
				<div class="span6">
					<h4>&nbsp;&nbsp;<i class="icon-building icon-2x"></i> Für Anbieter!</h4>
					<ul>
						<li>Wo bieten Sie Lagerflächen?</li>
						<li>Zu welchen Konditionen bieten Sie an?</li>
						<li>Welche Mehrwerte bieten Sie?</li>
						<li>Online Vertragsmanagement und Payment</li>
						<li>Lagertraum - Nachfragebörse</li>
					</ul>			
				</div>
			</div>
			<div class="row-fluid">
				<div class="span6">
					<a href="<?php echo Html::url(array('/site/register')); ?>" class="btn btn-success span12"><i class="icon-plus"></i> Registrieren (kostenlos)</a>
				</div>
				<div class="span6">
					<a href="<?php echo Html::url(array('/site/register')); ?>" class="btn btn-inverse span12"><i class="icon-plus"></i> Registrieren (kostenlos)</a>			
				</div>
			</div>
			<div class="row-fluid">
				<div class="span6">					
					<h4>&nbsp;&nbsp;<i class="icon-book icon-2x"></i>Für Kunden!</h4>
					<ul>
						<li>Meine Abteile</li>
						<li>Meine Rechnungen</li>
					</ul>
					<a href="#" class="btn btn-info span12"><i class="icon-signin"></i> Anmelden</a>		
				</div>
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
			</div>
			<div class="row-fluid">
				<div class="span12">
					
				</div>				
			</div>
		</div>
		<div class="span5">
			<?php $map->printMap() ?>
			<p>&nbsp;</p>
<h4>&nbsp;&nbsp;<i class="icon-globe icon-2x"></i> Top Standorte</h4>
<div id="map_sidebar">
	<ul class="sidebar unstyled">	
	<?php foreach( $map->getMarkers() as $n => $marker ): ?>
		<li id="marker<?php echo $n ?>" style="background-image: url(<?php echo $marker->getIcon() ?>)" onclick="<?php echo $marker->getOpener() ?>">
			<div style='padding-left:30px'>
				<b><?php echo $marker->title ?></b>
				<p><?php echo $marker->content ?></p>
			</div>
		</li>
	<?php endforeach; ?>
	</ul>
</div>

		</div>		
	</div>

	<!-- Example row of columns -->

