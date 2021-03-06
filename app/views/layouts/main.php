<?php
/**
 * @var $this \yii\base\View
 * @var $content string
 */
use yii\helpers\Html;

use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;

use app\models\User;
use app\config\AppAsset;
use Yii2Tooltipster\Yii2Tooltipster;

use \yii\web\Session;

$this->assetBundles['yii/bootstrap']=true;
AppAsset::register($this); 

?>

<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	
	<meta name="description" content="Checkstorage ist die Selfstorage Vergleichs Plattform für den EU-weiten Vergleich von Lagerplatz, Mietflächen, Lager Bedarfsermittlung, Storage Plattform, Self Storage, Lager, Keller, Dachboden, Verleih von Flächen" />
	<meta name="keywords" content="Lagerplatz Vergleich, Börse, Bedarfsermittlung, Storage Plattform, Self Storage, Lager, Keller, Dachboden, Verleih von Flächen, Weinlager, Reifeneinlagern" />
	<meta name="author" content="Frenzel GmbH - Checkstorage">
	<meta name="robots" content="index, follow" />
	<meta name="revisit-after" content="1 month" />

	<title><?php echo Html::encode($this->title); ?></title>
	<?php $this->head(); ?>
</head>
<body>

<?php $this->beginBody(); ?>

<?php echo Yii2Tooltipster::widget(array('options'=>array('class'=>'.tipster'))); ?>

<div id="topbar"></div>

<div class="container">
	
	<div class="masthead">
		<div class="pull-right">		
			<?php if (!Yii::$app->user->isGuest): ?>
				<a href="<?php echo Html::Url(array('/user/view','id'=>Yii::$app->user->identity->id)); ?>"><i class="icon-user icon-2x"></i> <?php echo Yii::$app->user->identity->username; ?></a>
			<?php else: ?>
				<a href="<?php echo Html::Url(array('/site/login')); ?>"><i class="icon-signin icon-2x"></i> Anmelden</a>
			<?php endif; ?>
		</div>
		<div id="logostyle">CheckStorage</div>
		<div id="sloganstyle">Lagerraum Vergleich - Finde DEINEN Platz!</div>		
	</div>

	<div id="pagewrapper">
		<?php 

		$MenuItems = array();
		//Bedarfssammler
		//$MenuItems[] = array('label' => 'Bedarfssammler', 'url' => array('/opportunities/index'));
		$MenuItems[] = array('label' => '<div class="fg-color-white"><i class="icon-book"></i> Dokumentation</div>', 'url' => array('/site/page','view'=>'page_test'));

		//menu items visible for guests
		if(Yii::$app->user->isGuest)
		{
			$MenuItems[] = array('label' => '<div class="fg-color-white"><i class="icon-envelope"></i> Kontakt</div>', 'url' => array('/site/contact'));
			$MenuItems[] = array('label' => '<div class="fg-color-white"><i class="icon-signal"></i> Imprint</div>', 'url' => array('/site/about'));			
		}
		//menu items visible for stores and administrator
		if(Yii::$app->user->identity->position==User::POS_STORE && !Yii::$app->user->isGuest){
			$MenuItems[] = array('label' => '<div class="fg-color-white"><i class="icon-building"></i> Lagerplätze</div>', 'url' => array('/storage/admin'));
		};
		//menu items visible for none stores
		if(!Yii::$app->user->isGuest){
			$MenuItems[] = array('label' => '<div class="fg-color-white"><i class="icon-signout"></i> Abmelden</div>', 'url' => array('/site/logout'));
		};

?>

<div class="fg-color-white">

<?php

NavBar::begin(array(
	'id' => 'mainnavigation',
	'class' => 'navbar',
	'brandLabel' => '<div class="fg-color-white"><i class="icon-search"></i> Lagerraum Suchen</div>',
));

	echo Nav::widget(array(
		'encodeLabels' => false,
		'options' => array('class' => 'nav navbar-nav'),
		'items' => $MenuItems
	)); 

NavBar::end();
 
?>

</div>
		<!-- /.navbar -->
		
		<!-- Content starts here -->
		<?php echo $content; ?>

	</div><!-- /#pagewrapper -->
	
</div>

<div id="footer" class="footer bg-color-statusRequested fg-color-white">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<b>Lagerplatz Vergleich, Börse, Bedarfsermittlung, Storage Plattform, SelfStorage, Lager, Keller, Dachboden, Verleih von Flächen, Möbel einlagern, Mietflächen, Weinlager, Reifenlager</b>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4">
				&copy; Frenzel GmbH <?php echo date('Y'); ?>
				<address>
					Hohewartstr. 32 <br>
					70469 Stuttgart <br>
					Deutschland
				</address>
			</div>
			<div class="col-lg-4">
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
			<div class="col-lg-4">
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
	
	<?php $this->endBody(); ?>

</body>
</html>
<?php $this->endPage(); ?>