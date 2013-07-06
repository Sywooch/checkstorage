<?php 
use \yii\helpers\Html;

use app\helpers\HighlightHelper;
?>
<div class="row-fluid">
	<div class="span12">
		<p><b><?php echo $data->name; ?></b> von <b><?php echo $data->Owner->prename; ?> <?php echo $data->Owner->name; ?></b></p>
		<p><?php echo $data->city; ?> <?php echo $data->address; ?></p>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<?php echo number_format($data->calcDistanceBetween($model->latitude, $model->longitude), 2, ',', '.'); ?>
		<i class="icon-archive"></i>
		<i class="icon-camera-retro"></i>
		<?php echo Html::a('<i class="icon-arrow-right"></i> '.Yii::t('app','anzeigen'), $data->url,array()); ?>
	</div>
</div>

