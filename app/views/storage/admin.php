<?php
use \yii\helpers\Html;
use \yii\widgets\LinkPager;

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
<h1>Standorte verwalten</h1>


<table class="table">
	<thead>
		<tr>
			<td>#</td>
			<td>Name</td>
			<td>Adresse</td>
			<td>PLZ</td>
			<td>Aktionen</td>
		</tr>
	</thead>
	<?php
	if (count($models) > 0) {
		foreach($models as $model) {
	?>
	<tr>
		<td><?php echo $model->id;?></td>
		<td><?php echo Html::a(Html::encode($model->name), $model->url);?></td>
		<td><?php echo $model->address;?></td>
		<td><?php echo $model->zipcode;?></td>
		<td>
			<i class="icon-pencil"></i> 
			<?php
				echo Html::a('edit', array("update", "id"=>$model->id), array('class' => 'edit')); 
			?>
			<i class="icon-remove"></i> 
			<?php
				echo Html::a('delete', array("delete", "id"=>$model->id), array('class'=>'delete'));
			?>
		</td>
	</tr>
	<?php
		}
	}
	else {
	?>
	<tr>
		<td cols="5">no result.</td>
	</tr>
	<?php
	}
	?>
</table>
<?php
	echo LinkPager::widget(array('pagination'=>$pagination));
?>

