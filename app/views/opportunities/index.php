<?php
use \yii\helpers\Html;
use \yii\widgets\LinkPager;

use \yii\widgets\Block;

$tdis->params['breadcrumbs']=array(
	'Manage Posts',
);

$deleteJS = <<<DEL
$('.container').on('click','.table a.delete',function() {
	if(confirm('Are you sure you want to delete this item?')) {
		return true;
	}
	return false;
});

DEL;

$this->registerJs($deleteJS);
?>

<?php Block::begin(array('id'=>'sidebar')); ?>

<?php Block::end(); ?>


<h1><i class="icon-dropbox"></i> Bedarfssammler für</h1>


<table class="table">
	<thead>
		<tr>
			<td>Stadt</td>
			<td>ab (Datum)</td>
			<td>QM</td>
		</tr>
	</thead>
	<?php
	if (count($models) > 0) {
		foreach($models as $model) {
	?>
	<tr>
		<td><img src="img/flags_iso/24/<?php echo $model->country; ?>.png"></img> <?php echo $model->city;?></td>
		<td><?php echo $model->date_start;?></td>
		<td><?php echo $model->double_sqm;?></td>
	</tr>
	<?php
		}
	}
	else {
	?>
	<tr>
		<td cols="5">Aktuell kein Bedarf gesammelt.</td>
	</tr>
	<?php
	}
	?>
</table>
<?php
	echo LinkPager::widget(array('pagination'=>$pagination));
?>

