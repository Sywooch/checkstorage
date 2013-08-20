<?php
/**
 * @var $this \yii\base\View
 * @var $content string
 */
use yii\helpers\Html;
use app\config\AppAsset;

AppAsset::register($this);

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
				<a href="<?php echo Html::Url(array('user/view','id'=>Yii::$app->user->identity->id)); ?>"><i class="icon-user"></i> <?php echo Yii::$app->user->identity->username; ?></a>
			<?php endif; ?>
		</div>
		<div id="logostyle">CheckStorage</div>
		<div id="sloganstyle">LAGERRAUM VERGLEICH</div>
	</div>
	
	<div id="pagewrapper">
		<?php echo $content; ?>
	</div>

	<?php $this->endBody(); ?>
</div>

<div id="footer" class="footer fg-color-white">
	<div class="container">
		<div class="col-lg-4">
			<ul class="unstyled">
				<li>&copy; Frenzel GmbH <?php echo date('Y'); ?></li>
			</ul>
		</div>
		<div class="col-lg-4">
			<ul class="unstyled">
				<li><?php echo Yii::powered(); ?></li>				
			</ul>
		</div>
		<div class="col-lg-4">
			
		</div>
	</div>	
</div>

</body>
</html>
<?php $this->endPage(); ?>