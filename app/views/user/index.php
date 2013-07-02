<?php
use \yii\helpers\Html;
use \yii\widgets\LinkPager;

use \yii\widgets\Block;

$this->title=Yii::$app->name . ' - Users';

?>

<?php Block::begin(array('id'=>'sidebar')); ?>
	<ul>		
		<li class="sticker sticker-color-yellow"><?php echo Html::a('<i class="icon-arrow-left-3"></i>Overview User', array('/user/index')); ?></li>
		<li class="sticker sticker-color-blue"><?php echo Html::a('<i class="icon-pencil"></i>Update', array('/user/update','id'=>Yii::$app->user->identity->id)); ?></li>
	</ul>
<?php Block::end(); ?>

<?php
foreach($models as $model) {
	echo $this->context->renderPartial('_overview', array(
		'data'=>$model,
	));
}

echo LinkPager::widget(array('pagination'=>$pagination));

?>
