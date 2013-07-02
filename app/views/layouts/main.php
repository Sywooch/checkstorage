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
		<div class="nav-bar bg-color-redMyplace">
			<div class="nav-bar-inner">
				<ul class="menu">
					<li><img src="img/myplace_logo.jpg"></img></li>
					<li><?php echo Html::a('<i class="icon-home"></i> '.Yii::t('app','Home'), Yii::$app->homeUrl); ?></li>
					<li class="divider"></li>
					
					<li data-role="dropdown">
						<a href="#"><i class="icon-cabinet"></i> <?php echo Yii::t('app','Content'); ?></a>
						<ul class="dropdown-menu">
							<?php 
								$rootNodes = app\models\Pages::getRootNodes();
							?>
							<?php foreach($rootNodes AS $Node): ?>
									<li><?php echo Html::a(Yii::t('app',$Node->title), array('/pages/view','id'=>$Node->id)); ?></li>
							<?php endforeach; ?>
						</ul>
					</li>

					<li class="divider"></li>
					<li data-role="dropdown">
						<a href="#"><i class="icon-cog"></i> <?php echo Yii::t('app','Toolbox'); ?></a>
						<ul class="dropdown-menu">
							<li><?php echo Html::a(Yii::t('app','Time Control'), array('/holiday/indexuser')); ?></li>
							<li><?php echo Html::a(Yii::t('app','Workflow Control'), array('/workflow/index')); ?></li>
						</ul>						
					</li>

					<?php if (Yii::$app->user->isAdmin): ?>
					<li class="divider"></li>
					<li data-role="dropdown">
						<a href="#"><i class="icon-wrench"></i> Administration</a>
						<ul class="dropdown-menu">
							<li><?php echo Html::a(Yii::t('app','Locations'), array('/location/admin')); ?></li>
							<li><?php echo Html::a(Yii::t('app','Costcenter'), array('/costcenter/admin')); ?></li>
							<li><?php echo Html::a(Yii::t('app','User'), array('/user/admin')); ?></li>
							<li><?php echo Html::a(Yii::t('app','Controlling'), array('/controlling/indexadmin')); ?></li>
							<li class="divider"></li>
							<li><?php echo Html::a(Yii::t('app','Holiday').'s DB', array('/holiday/index')); ?></li>
							<li><?php echo Html::a(Yii::t('app','Content'), array('/post/indexadmin')); ?></li>
							<li class="divider"></li>
							<li><?php echo Html::a(Yii::t('app','File Manager'), array('/site/filemanager')); ?></li>
						</ul>						
					</li>
					<?php endif; ?>								
					
					<li class="divider"></li>
					<?php if (Yii::$app->user->isGuest): ?>
					<li><?php echo Html::a('<i class="icon-enter"></i>'.Yii::t('app','Login'), array('/site/login')); ?></li>
					<?php else: ?>
					<li><?php echo Html::a('<i class="icon-exit"></i>'.Yii::t('app','Logout'), array('/site/logout')); ?></li>
					<?php endif; ?>
					
					
				</ul>				
			</div>
		</div>
		<!-- /.navbar -->
		
		<!-- Content starts here -->
		<?php echo $content; ?>

	</div><!-- /#pagewrapper -->
	
	<?php $this->endBody(); ?>
</div>

<div id="footer" class="footer bg-color-blueLight fg-color-white">
	<div class="container">
		<div class="span4">
			<ul class="unstyled">
				<li>MyPlace Selfstorage <?php echo date('Y'); ?></li>
				<li>&copy; Frenzel GmbH <?php echo date('Y'); ?></li>
			</ul>
		</div>
		<div class="span4">
			<ul class="unstyled">
				
			</ul>
		</div>
		<div class="span4">
			
		</div>
	</div>	
</div>

</body>
</html>
<?php $this->endPage(); ?>