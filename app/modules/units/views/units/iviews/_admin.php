<?php

use \yii\helpers\Html;

?>

<div class="tile">
	<div class="row <?php echo ++$index%2==0?'bg-color-blue2':'bg-color-white'?>">
		<div class="col-lg-4">
			<i class="icon-resize-horizontal"></i> <?php echo $model->room_width; ?> m
			<i class="icon-resize-full"></i> <?php echo $model->room_length; ?> m
			<i class="icon-resize-vertical"></i> <?php echo $model->room_height; ?> m
		</div>
		<div class="col-lg-2"><?php echo $model->id; ?> - <?php echo $model->unit_number; ?></div>
		<div class="col-lg-3"><?php echo $model->getUnitTypeAsString($model->unit_type); ?> (<?php echo $model->getUnitStatusAsString($model->current_status); ?>)</div>
		<div class="col-lg-1"><?php echo $model->is_consumer==0?'<i class="icon-check-empty"></i>':'<i class="icon-check"></i>'; ?></div>
		<div class="op col-lg-2">
			<i class="icon-pencil"></i> <?php echo Html::a(Yii::t('app','edit'),array('/timetablescheduleddetail/update','id'=>$model->id),array('class'=>'edit')); ?>
		</div>
	</div>
	<div class="row <?php echo $index%2==0?'bg-color-blue2':'bg-color-white'?>">
		<div class="col-lg-4">
			<b><i class="icon-eur"> </i><?php echo number_format($model->unit_rate, 2, ',', '.'); ?></b>
			<?php echo $model->getPeriodAsString($model->rate_period); ?>
		</div>
		<div class="col-lg-2"><i class="icon-key"></i> <?php echo $model->accesskey; ?></div>
		<div class="col-lg-6"><?php echo $model->note; ?></div>
	</div>
</div>
