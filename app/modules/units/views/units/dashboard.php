<?php

use \Yii;
use \yii\helpers\Html;
use \yii\widgets\LinkPager;

$editJS = <<<EDIT
$('.container').on('click','.op a.edit',function() {
	var th=$(this),
		container=th.closest('tr.timetablescheduleddetail'),
		id=container.attr('id').slice(1);	
	$('#myEditModal').modal('show');
	$('#myEditModal div.modal-header h2').html('You are going to edit: '+id);
	$('#myEditModal div.modal-body').load(th.attr('href'));
	return false;
});

EDIT;
$this->registerJs($editJS);

?>

<table class="table container">
	<thead>
		<tr>
			<th>Abteil Nummer</th>
			<th>Abteil Breite</th>
			<th>Abteil Länge</th>
			<th>Abteil Höhe</th>
			<th>Abteil Art</th>
			<th>Privat/Gewerbe</th>
		</tr>
	</thead>
	<thead>
		<tr>
			<th>Preis</th>
			<th>Zyklus</th>
			<th>Zugangscode</th>
			<th>Status</th>			
			<th>Notizen</th>
			<th></th>
		</tr>
	</thead>

<?php

$units = $provider->getItems();

$counter = 0;

foreach($units AS $unit):
?>
<tr class="<?php echo ++$counter%2==0?'bg-color-blue2':'bg-color-white'?>">
	<td><?php echo $unit->unit_number; ?></td>
	<td><i class="icon-resize-horizontal"></i> <?php echo $unit->room_width; ?> m</td>
	<td><i class="icon-resize-full"></i> <?php echo $unit->room_length; ?> m</td>
	<td><i class="icon-resize-vertical"></i> <?php echo $unit->room_height; ?> m</td>
	<td><?php echo $unit->unit_type; ?></td>
	<td><?php echo $unit->is_consumer==0?'<i class="icon-check-empty"></i>':'<i class="icon-check"></i>'; ?></td>
</tr>
<tr class="<?php echo $counter%2==0?'bg-color-blue2':'bg-color-white'?>">
	<td><b><i class="icon-eur"> </i><?php echo number_format($unit->unit_rate, 2, ',', '.'); ?></b></td>
	<td><?php echo $unit->getPeriodAsString($unit->rate_period); ?></td>
	<td><i class="icon-key"></i> <?php echo $unit->accesskey; ?></td>
	<td><?php echo $unit->current_status; ?></td>
	<td><?php echo $unit->note; ?></td>
	<td class="op">
		<i class="icon-pencil"></i> <?php echo Html::a(Yii::t('app','edit'),array('/timetablescheduleddetail/update','id'=>$unit->id),array('class'=>'edit')); ?>
	</td>
</tr>
<?php endforeach; ?>

</table>

<?php

echo LinkPager::widget(array(
      'pagination' => $provider->getPagination(),
 ));

?>
