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
	<ul class="nav nav-list">
	<li class="nav-header">Aktionen</li>
		<ul class="unstyled">
		<?php
			echo '<li class="mytoolbox">'.Html::a('<i class="icon-arrow-left fg-color-white"></i> Übersicht',array('/user/view','id'=>Yii::$app->user->id),array('class'=>'fg-color-white')).'</li>';
			echo '<li class="mytoolbox">'.Html::a('<i class="icon-plus fg-color-white"></i> Lagerplatz anlegen',array('/storage/create'),array('class'=>'fg-color-white')).'</li>';			
		?>
		</ul>
	</ul>
<?php Block::end(); ?>


<h1><i class="icon-building"></i> Standorte verwalten</h1>


<table class="table">
	<thead>
		<tr>
			<td>#</td>
			<td>Name</td>
			<td>Adresse</td>
			<td>Land</td>
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
		<td><?php echo $model->country;?></td>
		<td><?php echo $model->zipcode;?></td>
		<td>
			<i class="icon-book"></i> 
			<?php
				echo Html::a('verwalten', array("dashboard", "id"=>$model->id), array('class'=>'dashboard'));
			?>
			<i class="icon-pencil"></i> 
			<?php
				echo Html::a('bearbeiten', array("update", "id"=>$model->id), array('class' => 'edit')); 
			?>
			<i class="icon-remove"></i> 
			<?php
				echo Html::a('entfernen', array("softdelete", "id"=>$model->id), array('class'=>'delete'));
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

