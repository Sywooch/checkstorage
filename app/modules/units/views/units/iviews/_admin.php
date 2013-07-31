<?php

use \yii\helpers\Html;

?>

<div class="tile">
	<div class="row-fluid <?php echo ++$index%2==0?'bg-color-blue2':'bg-color-white'?>">
		<div class="span4">
			<i class="icon-resize-horizontal"></i> <?php echo $item->room_width; ?> m
			<i class="icon-resize-full"></i> <?php echo $item->room_length; ?> m
			<i class="icon-resize-vertical"></i> <?php echo $item->room_height; ?> m
		</div>
		<div class="span2"><?php echo $item->id; ?> - <?php echo $item->unit_number; ?></div>
		<div class="span3"><?php echo $item->getUnitTypeAsString($item->unit_type); ?> (<?php echo $item->getUnitStatusAsString($item->current_status); ?>)</div>
		<div class="span1"><?php echo $item->is_consumer==0?'<i class="icon-check-empty"></i>':'<i class="icon-check"></i>'; ?></div>
		<div class="op span2">
			<i class="icon-pencil"></i> <?php echo Html::a(Yii::t('app','edit'),array('/timetablescheduleddetail/update','id'=>$item->id),array('class'=>'edit')); ?>
		</div>
	</div>
	<div class="row-fluid <?php echo $index%2==0?'bg-color-blue2':'bg-color-white'?>">
		<div class="span4">
			<b><i class="icon-eur"> </i><?php echo number_format($item->unit_rate, 2, ',', '.'); ?></b>
			<?php echo $item->getPeriodAsString($item->rate_period); ?>
		</div>
		<div class="span2"><i class="icon-key"></i> <?php echo $item->accesskey; ?></div>
		<div class="span6"><?php echo $item->note; ?></div>
	</div>
</div>
