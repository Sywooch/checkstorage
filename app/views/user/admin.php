<?php
use \yii\helpers\Html;
use \yii\widgets\Block;

use yiidhtmlx\Grid;

$this->title=Yii::$app->name . ' - Users';

$target = Html::url(array('/user/view','id'=>''));

$jumpJS = <<<DEL
function doOnRowSelect(id,ind) {
	window.location = "$target"+id;	
};
DEL;
$this->registerJs($jumpJS);

?>

<?php Block::begin(array('id'=>'sidebar')); ?>
	<ul>		
		<li class="sticker sticker-color-yellow"><?php echo Html::a('<i class="icon-arrow-left-3"></i>Overview User', array('/user/admin')); ?></li>
		<li class="sticker sticker-color-greenDark">
			<a><i class="icon-wrench"></i><?php echo Yii::t('app','Actions'); ?></a>
			<ul class="sub-menu light">
				<li><?php echo Html::a('<i class="icon-plus"></i>'.Yii::t('app','Create'), array('/user/create')); ?></li>
			</ul>
		</li>	
	</ul>
<?php Block::end(); ?>

<h1><?php echo Yii::t('app','Overview User'); ?></h1>

<?php
echo Grid::widget(
	array(
		'clientOptions'=>array(
		 	'parent' => 'myTestGrid',
		 	'auto_height' => true,
		 	'auto_width' => true,
		 	'skin' => "dhx_terrace",
		 	'columns' => array(
		 		array('label'=>'id','width'=>'40','type'=>'ed'),
				array('label'=>array(Yii::t('app','Name'),'#text_filter'),'type'=>'ed'),
				array('label'=>array(Yii::t('app','Prename'),'#text_filter'),'type'=>'ed'),
				array('label'=>array(Yii::t('app','Costcenter'),'#select_filter'),'type'=>'ed'),
				array('label'=>Yii::t('app','Entry Date'),'width'=>'130','type'=>'ed'),
			),
		 	//'image_path' => "./css/imgs/"
		),			
	    'options'=>array(
			'id'    => 'myTestGrid',
		),
		'clientDataOptions'=>array(
			'type'=>'json',
			'url'=>Html::url(array('/user/jsongriduserdata'))
		),
		'clientEvents'=>array(
			'onRowDblClicked'=>'doOnRowSelect',
			'onEnter' => 'doOnRowSelect',
		)		
	)
);
?>
