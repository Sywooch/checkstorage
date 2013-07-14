<?php
/**
 * @var $this \yii\base\View
 * @var $content string
 */
use yii\helpers\Html;
use yii\bootstrap\NavBar;
use app\models\User;
use yii2tooltipster\yii2tooltipster;

use \yii\web\Session;

$this->assetBundles['yii/bootstrap']=true;
$this->registerAssetBundle('app');


?>

<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	
	<meta name="description" content="Checkstorage ist die Selfstorage Vergleichs Plattform für den EU-weiten Vergleich von Lagerplatz, Mietflächen, Lager Bedarfsermittlung, Storage Plattform, Self Storage, Lager, Keller, Dachboden, Verleih von Flächen" />
	<meta name="keywords" content="Lagerplatz Vergleich, Börse, Bedarfsermittlung, Storage Plattform, Self Storage, Lager, Keller, Dachboden, Verleih von Flächen" />
	<meta name="author" content="Frenzel GmbH">
	<meta name="robots" content="index, follow" />
	<meta name="revisit-after" content="1 month" />

	<title><?php echo Html::encode($this->title); ?></title>
	<?php $this->head(); ?>
</head>
<body>

<?php echo yii2tooltipster::widget(array('options'=>array('class'=>'.tipster'))); ?>

<div class="container">
	<?php $this->beginBody(); ?>
	<div class="masthead">
		<div class="pull-right">		
			<?php if (!Yii::$app->user->isGuest): ?>
				<a href="<?php echo Html::Url(array('user/view','id'=>Yii::$app->user->identity->id)); ?>"><i class="icon-user icon-2x"></i> <?php echo Yii::$app->user->identity->username; ?></a>
			<?php else: ?>
				<a href="<?php echo Html::Url(array('site/login')); ?>"><i class="icon-signin icon-2x"></i> Anmelden</a>
			<?php endif; ?>
		</div>
		<div id="logostyle">CheckStorage</div>
		<div id="sloganstyle">Lagerraum Vergleich - Finde DEINEN Platz!</div>		
	</div>
		
	<div id="pagewrapper">
		<?php 

		$MenuItems = array();
		//Bedarfssammler
		$MenuItems[] = array('label' => 'Bedarfssammler', 'url' => array('/opportunities/index'));
		$MenuItems[] = array('label' => 'Dokumentation', 'url' => array('/site/page','view'=>'page_test'));

		//menu items visible for guests
		if(Yii::$app->user->isGuest)
		{
			$MenuItems[] = array('label' => 'Kontakt', 'url' => array('/site/contact'),'options'=>array());
			$MenuItems[] = array('label' => 'Imprint', 'url' => array('/site/about'));			
		}
		//menu items visible for stores and administrator
		if(Yii::$app->user->identity->position==User::POS_STORE && !Yii::$app->user->isGuest){
			$MenuItems[] = array('label' => 'Lagerplätze', 'url' => array('/storage/admin'));
		};
		//menu items visible for none stores
		if(!Yii::$app->user->isGuest){
			$MenuItems[] = array('label' => 'Abmelden', 'url' => array('/site/logout'));
		};

		echo NavBar::widget(array(
			'id' => 'mainnavigation',
			'options' => array('class' => 'nav'),
			'brandLabel' => 'Start',
			'items' => array(
				 array(
					'class' => 'yii\bootstrap\Nav',
					'options' => array(
						'items'=> $MenuItems,
					)
				)
			),
		)); ?>
		<!-- /.navbar -->
		
		<!-- Content starts here -->
		<?php echo $content; ?>

	</div><!-- /#pagewrapper -->
	
	<?php $this->endBody(); ?>
</div>

<div id="footer" class="footer bg-color-darken fg-color-white">
	<div class="container">
		<div class="row-fluid">
			<div class="span12">
				<b>Lagerplatz Vergleich, Börse, Bedarfsermittlung, Storage Plattform, Self Storage, Lager, Keller, Dachboden, Verleih von Flächen, Möbel einlagern, Mietflächen</b>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span4">
				<ul class="unstyled">
					<li>&copy; Frenzel GmbH <?php echo date('Y'); ?></li>				
				</ul>
				<address>
					Hohewartstr. 32 <br>
					70469 Stuttgart <br>
					Deutschland
				</address>
			</div>
			<div class="span4">
				<ul class="unstyled">
					<li>Impressum</li>
					<li>Letzte Suche: <?php $session = new Session; echo $session['address']; ?></li>					
				</ul>
				<ul class="unstyled">
					<li>Leistungen</li>
					<ul>
						<li>Lagerraum</li>
						<li>Selfstorage</li>
						<li>Leistungsvergleich</li>
						<li>Lagerplatzsuche</li>
						<li>Lagerraum Bedarfssammlung</li>
					</ul>
				</ul>
			</div>
			<div class="span4">
				<ul class="unstyled">
					<li>kontakt@check-storage.de</li>
					<li>+49 711 852505 (DE)</li>
					<li>+43 699 19 08 9393 (AT)</li>		
				</ul>
			</div>
		</div>		
	</div>			
</div>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-42276739-1', 'check-storage.de');
  ga('send', 'pageview');

</script>

</body>
</html>
<?php $this->endPage(); ?>