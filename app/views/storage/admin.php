<?php
use \yii\helpers\Html;
use \yii\widgets\LinkPager;

use \yii\widgets\Block;
use \yii\widgets\ListView;

$tdis->params['breadcrumbs']=array(
	'Manage Posts',
);

$deleteJS = <<<DEL
$('.container').on('click','.table a.delete',function() {
	if(confirm('Are you sure you want to delete this item?')) {
		return true;
	}
	return false;
});

DEL;

$this->registerJs($deleteJS);
?>

<?php Block::begin(array('id'=>'sidebar')); ?>
	<?php
		echo '<div class="list-group-item">'.Html::a('<i class="icon-arrow-left"></i> Übersicht',array('/user/view','id'=>Yii::$app->user->id),array()).'</div>';
		echo '<div class="list-group-item">'.Html::a('<i class="icon-plus"></i> Lagerplatz anlegen',array('/storage/create'),array()).'</div>';			
	?>
<?php Block::end(); ?>


<h1><i class="icon-building"></i> Standorte verwalten</h1>

<?php 
	echo ListView::widget(array(
		'dataProvider'=>$dpStorage,
		'itemView' => 'iviews/_admin',
	));
?>
