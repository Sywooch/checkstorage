<?php
/**
 * @var yii\base\View $this
 */

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\Block;
use yii\widgets\LinkPager;

use yiimetroui\Tile;
use yiimetroui\Carousel;

use app\models\Messages;

$this->title = 'MyPlace Intranet Prototype';
?>

<?php Block::begin(array('id'=>'sidebar')); ?>
	
<?php Block::end(); ?>

<?php Block::begin(array('id'=>'toolbar')); ?>
	<?php if (!Yii::$app->user->isGuest): ?>
	<a href="<?php echo Html::Url(array('holiday/indexuser','id'=>Yii::$app->user->identity->id)); ?>">
		<?php echo Tile::widget(array(
				'items'=>array(
					array(
						'content'=>'<i class="icon-calendar"></i>',
						'brand'=>'<div class="name">'.Yii::t('app','Timetrack').'</div>',					
					),
				),
				'options'=>array('class'=>'icon bg-color-blueDark'),
			));
		?>
	</a>
	<a href="<?php echo Html::Url(array('workflow/index')); ?>">
		<?php echo Tile::widget(array(
				'items'=>array(
					array(
						'content'=>'<i class="icon-puzzle"></i>',
						'brand'=>'<div class="name">'.Yii::t('app','Workflow').'</div>',					
					),
				),
				'options'=>array('class'=>'icon bg-color-gray'),
			));
		?>
	</a>
	<?php endif; ?>
	<a href="http://hilfe.myplace.eu" taget="_blank">
		<?php echo Tile::widget(array(
				'items'=>array(
					array(
						'content'=>'<i class="icon-github"></i>',
						'brand'=>'<div class="name">hilfe.myplace.eu</div>',					
					),
				),
				'options'=>array('class'=>'icon bg-color-green'),
			));
		?>
	</a>
	
<?php Block::end(); ?>

	<div class="row-fluid">
		<div class="span12">
			<?php 

			$item = array();
			$item[] = array('content'=>"<img src='img/location/".Yii::$app->user->identity->location_id.".jpg'/>",'id'=>Yii::$app->user->identity->Location->name);
			
			for($img=4;$img<8;$img++){
				$item[] = array('content'=>"<img src='img/location/".$img.".jpg'/>",'id'=>$img);
			}

			echo Carousel::widget(array(
				'items'=> $item,
				'options'=>array(
					'style'=>'height:200px',
				)
			)); ?>
		</div>		
	</div>

	<!-- Example row of columns -->

	<div class="row-fluid">
		<div class="span12">
			<h1><?php echo Html::encode(Yii::$app->user->identity->Location->name); ?></h1>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span12">
			
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
