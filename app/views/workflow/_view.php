<?php 
use \yii\helpers\Html;
use \yii\widgets\Block;

?>

<?php Block::begin(array('id'=>'sidebar')); ?>
	<ul>
		<li class="sticker sticker-color-blue"><?php echo Html::a('<i class="icon-plus"></i>Create Location', array('/location/create')); ?></li>
		<li class="sticker sticker-color-yellow"><?php echo Html::a('<i class="icon-database"></i>Overview Locations', array('/location/index')); ?></li>
	</ul>
<?php Block::end(); ?>

<div class="row">	
	<h2><i class="icon-sun"></i> <?php echo Html::encode($data->address); ?> <small><?php echo Html::encode($data->Region->name); ?></small></h2>
	<table class="table table-striped">
		<tr>
			<td class="span3">Cost Center</td>
			<td><?php echo Html::encode($data->costcenter->label); ?> (<?php echo Html::encode($data->costcenter->name); ?>)</td>
		</tr>
		<tr>
			<td class="span3">Street</td>
			<td><?php echo Html::encode($data->address); ?></td>
		</tr>
		<tr>
			<td class="span3">Zip/City</td>
			<td><?php echo Html::encode($data->zipcode); ?> <?php echo Html::encode($data->city); ?></td>
		</tr>
		<tr>
			<td class="span3">Country</td>
			<td><?php echo Html::encode($data->country); ?></td>
		</tr>
		<tr>
			<td class="span3">Opening</td>
			<td><?php echo Html::encode($data->date_opening); ?></td>
		</tr>
		<tr>
			<td class="span3">EMail</td>
			<td><?php echo Html::encode($data->email); ?></td>
		</tr>
	</table>
	<p><?php echo Html::a("Update", array("update", "id"=>$data->id),array('class'=>'btn pull-right')); ?></p>
</div>
