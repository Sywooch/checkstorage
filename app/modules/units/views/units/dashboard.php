<?php

use \Yii;
use \yii\helpers\Html;
use \yii\widgets\LinkPager;

?>

<table class="table">
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
	<td><b><i class="icon-eur"><?php echo $unit->unit_rate; ?></i></b></td>
	<td><?php echo $unit->getPeriodAsString($unit->rate_period); ?></td>
	<td><i class="icon-key"></i> <?php echo $unit->accesskey; ?></td>
	<td><?php echo $unit->current_status; ?></td>
	<td colspan="2"><?php echo $unit->note; ?></td>
</tr>
<?php endforeach; ?>

</table>

<?php

echo LinkPager::widget(array(
      'pagination' => $provider->getPagination(),
 ));

?>
