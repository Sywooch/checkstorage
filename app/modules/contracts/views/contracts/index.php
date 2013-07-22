<?php

use \Yii;
use \yii\helpers\Html;
use \yii\widgets\LinkPager;

use \yii\widgets\Block;
?>


<?php Block::begin(array('id'=>'sidebar')); ?>
	<ul class="nav nav-list">
	<li class="nav-header">Aktionen</li>
		<ul class="unstyled">
		<?php
			echo '<li class="mytoolbox">'.Html::a('<i class="icon-plus fg-color-white"></i> Vertrag anlegen',array('/contracts/contracts/create'),array('class'=>'fg-color-white')).'</li>';			
		?>
		</ul>
	</ul>
<?php Block::end(); ?>


<h1>Contracts</h1>

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
