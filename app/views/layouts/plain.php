<?php
/**
 * @var $this \yii\base\View
 * @var $content string
 */
use yii\helpers\Html;

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
		<h3 class="muted">MyPlace Intranet
		<?php if (!Yii::$app->user->isGuest): ?>
			<small><a href="<?php echo Html::Url(array('user/view','id'=>Yii::$app->user->identity->id)); ?>"><?php echo Yii::$app->user->identity->username; ?></a></small>
		<?php endif; ?>
		</h3>
	</div>
	<div id="pagewrapper">
		<?php echo $content; ?>
	</div>

	<?php $this->endBody(); ?>
</div>

<div id="footer" class="footer fg-color-white">
	<div class="container">
		<div class="span4">
			<ul class="unstyled">
				<li>MyPlace Selfstorage <?php echo date('Y'); ?></li>
				<li>&copy; Frenzel GmbH <?php echo date('Y'); ?></li>
			</ul>
		</div>
		<div class="span4">
			<ul class="unstyled">
				<li><?php echo Yii::powered(); ?></li>
				<li>Styles by <a href="http://metroui.org.ua/">Metro UI CSS</a></li>
			</ul>
		</div>
		<div class="span4">
			
		</div>
	</div>	
</div>

</body>
</html>
<?php $this->endPage(); ?>