<?php
/**
 * @var $this \yii\base\View
 * @var $content string
 */
use yii\helpers\Html;
use yii\bootstrap\NavBar;
use app\models\User;

$this->registerAssetBundle('app');

?>

<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title><?php echo Html::encode($this->title); ?></title>
	<?php $this->head(); ?>
</head>
<body class="metrouicss">
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
		<div id="logostyle">checkstorage</div>
		<div id="sloganstyle">LAGERRAUM VERGLEICH</div>
	</div>
		
	<div id="pagewrapper">
		<?php 

		$MenuItems = array();
		$MenuItems[] = array('label' => 'Über Uns', 'url' => array('/site/about'));
		$MenuItems[] = array('label' => 'Kontakt', 'url' => array('/site/contact'));
		if(Yii::$app->user->identity->position==User::POS_STORE && !Yii::$app->user->isGuest){
			$MenuItems[] = array('label' => 'Standorte', 'url' => array('/storage/admin'));
		};
		if(!Yii::$app->user->isGuest){
			$MenuItems[] = array('label' => 'Abmelden', 'url' => array('/site/logout'));
		};

		echo NavBar::widget(array(
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

</body>
</html>
<?php $this->endPage(); ?>