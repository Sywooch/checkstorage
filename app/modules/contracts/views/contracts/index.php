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
			echo '<li class="mytoolbox">'.Html::a('<i class="icon-plus fg-color-white"></i> Vertrag anlegen',array('/contracts/contracts/createTable'),array('class'=>'fg-color-white')).'</li>';			
		?>
		</ul>
	</ul>
<?php Block::end(); ?>


<h1>Verträge</h1>

<table class="table table-striped">
	<thead>
		<td>Vertrag #</td>
		<td>Abteil #</td>
		<td>Kunde</td>
		<td></td>
	</thead>

<?php

$contracts = $provider->getItems();

foreach($contracts AS $contract):
?>
<tr>
	<td># <?php echo $contract->id; ?></td>
	<td># <?php echo $contract->Unit->id; ?> - <?php echo $contract->Unit->unit_number; ?></td>
	<td><?php echo $contract->ContractPartner->name; ?> <?php echo $contract->ContractPartner->prename; ?></td>
	<td></td>
</tr>
<?php endforeach; ?>

</table>

<?php

echo LinkPager::widget(array(
      'pagination' => $provider->getPagination(),
 ));

?>
