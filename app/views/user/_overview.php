<?php 
use \yii\helpers\Html;
use \yii\widgets\Block;

?>

<?php Block::begin(array('id'=>'sidebar')); ?>
	<ul>
		<li class="sticker sticker-color-blue"><?php echo Html::a('<i class="icon-plus"></i>Create User', array('/user/create')); ?></li>
		<li class="sticker sticker-color-yellow"><?php echo Html::a('<i class="icon-database"></i>Overview User', array('/user/index')); ?></li>
	</ul>
<?php Block::end(); ?>

<div class="row">	
	<h2><?php echo Html::encode($data->prename); ?> <?php echo Html::encode($data->name); ?></h2>
	<table class="table table-striped">
		<tr>
			<td class="span3">Location</td>
			<td><?php echo Html::encode($data->location->name); ?></td>
		</tr>
		<tr>
			<td class="span3">Name</td>
			<td><?php echo Html::encode($data->prename); ?> <?php echo Html::encode($data->name); ?></td>
		</tr>
		<tr>
			<td class="span3">EMail</td>
			<td><?php echo Html::encode($data->email); ?></td>
		</tr>
		<tr>
			<td class="span3">Reports To</td>
			<td><?php echo Html::encode($data->ReportTo->prename); ?> <?php echo Html::encode($data->ReportTo->name); ?></td>
		</tr>
	</table>
	<p><?php echo Html::a("Update", array("update", "id"=>$data->id),array('class'=>'btn pull-right')); ?></p>
</div>
