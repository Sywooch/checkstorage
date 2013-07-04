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
			<?php $map->printMap() ?>
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
