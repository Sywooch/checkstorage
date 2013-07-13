<?php

use \Yii;
use \yii\helpers\Html;
use \yii\widgets\LinkPager;

?>

<h1>Abteile</h1>

<table class="table table-striped">
	<thead>
		<td>Abteil Breite</td>
		<td>Abteil Länge</td>
		<td>Abteil Höhe</td>
		<td></td>
	</thead>

<?php

$units = $provider->getItems();

foreach($units AS $unit):
?>
<tr>
	<td><?php echo $unit->room_width; ?></td>
	<td><?php echo $unit->room_length; ?></td>
	<td><?php echo $unit->room_height; ?></td>
	<td></td>
</tr>
<?php endforeach; ?>

</table>

<?php

echo LinkPager::widget(array(
      'pagination' => $provider->getPagination(),
 ));

?>
