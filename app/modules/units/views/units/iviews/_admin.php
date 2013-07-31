<?php

use \yii\helpers\Html;

?>

<div class="row-fluid <?php echo ++$index%2==0?'bg-color-blue2':'bg-color-white'?>">
	<div class="span2"><?php echo $item->unit_number; ?></div>
	<div class="span2"><i class="icon-resize-horizontal"></i> <?php echo $item->room_width; ?> m</div>
	<div class="span2"><i class="icon-resize-full"></i> <?php echo $item->room_length; ?> m</div>
	<div class="span2"><i class="icon-resize-vertical"></i> <?php echo $item->room_height; ?> m</div>
	<div class="span2"><?php echo $item->unit_type; ?></div>
	<div class="span2"><?php echo $item->is_consumer==0?'<i class="icon-check-empty"></i>':'<i class="icon-check"></i>'; ?></div>
</div>
<div class="row-fluid <?php echo $index%2==0?'bg-color-blue2':'bg-color-white'?>">
	<div class="span2"><b><i class="icon-eur"> </i><?php echo number_format($item->unit_rate, 2, ',', '.'); ?></b></div>
	<div class="span2"><?php echo $item->getPeriodAsString($item->rate_period); ?></div>
	<div class="span2"><i class="icon-key"></i> <?php echo $item->accesskey; ?></div>
	<div class="span2"><?php echo $item->current_status; ?></div>
	<div class="span2"><?php echo $item->note; ?></div>
	<div class="op">
		<i class="icon-pencil"></i> <?php echo Html::a(Yii::t('app','edit'),array('/timetablescheduleddetail/update','id'=>$item->id),array('class'=>'edit')); ?>
	</div>
</div>
