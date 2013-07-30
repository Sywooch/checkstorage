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
	<ul class="nav nav-list">
	<li class="nav-header">Aktionen</li>
		<ul class="unstyled">
		<?php
			echo '<li class="mytoolbox">'.Html::a('<i class="icon-arrow-left fg-color-white"></i> Übersicht',array('/user/view','id'=>Yii::$app->user->id),array('class'=>'fg-color-white')).'</li>';
			echo '<li class="mytoolbox">'.Html::a('<i class="icon-plus fg-color-white"></i> Lagerplatz anlegen',array('/storage/create'),array('class'=>'fg-color-white')).'</li>';			
		?>
		</ul>
	</ul>
<?php Block::end(); ?>


<h1><i class="icon-building"></i> Standorte verwalten</h1>

<?php 
	echo ListView::widget(array(
		'dataProvider'=>$dpStorage,
		'itemView' => 'iviews/_admin',
	));
?>
