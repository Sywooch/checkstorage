<?php 
use \yii\helpers\Html;

use app\helpers\HighlightHelper;
?>
<div class="row-fluid">
	<div class="span11">
		<p><b><?php echo $data->name; ?></b> von <b><?php echo $data->Owner->prename; ?> <?php echo $data->Owner->name; ?></b></p>
<div>
<?php echo $data->address; ?><br>
<?php echo $data->zipcode; ?> <?php echo $data->city; ?> 
</div>
	</div>
</div>
<table class="table">
	<tr>
		<td class="bg-color-white"><i class="icon-flag-checkered fg-color-red"></i> <?php echo number_format($data->calcDistanceBetween($model->latitude, $model->longitude), 2, ',', '.'); ?>km</td>
		<td><i class="icon-resize-vertical fg-color-red"></i> <?php echo number_format($data->Comparision->room_height, 2, ',', '.'); ?>m</td>
		<td class="bg-color-white"><i class="icon-fire <?php echo $data->Comparision->fireprotection?'fg-color-green':'fg-color-darken'; ?>"></i></td>
		<td><i class="icon-camera-retro <?php echo $data->Comparision->security_camera?'fg-color-green':'fg-color-darken'; ?>"></i></td>
		<td class="bg-color-white"><i class="icon-key <?php echo $data->Comparision->security_access?'fg-color-green':'fg-color-darken'; ?>"></i></td>
		<td><i class="icon-user-md <?php echo $data->Comparision->security_service?'fg-color-green':'fg-color-darken'; ?>"></i></td>
		<td class="bg-color-white"><i class="icon-dropbox <?php echo $data->Comparision->shopping?'fg-color-green':'fg-color-darken'; ?>"></i></td>
		<td><i class="icon-shopping-cart <?php echo $data->Comparision->trolleys?'fg-color-green':'fg-color-darken'; ?>"></i></td>
		<td class="bg-color-white"><i class="icon-cogs <?php echo $data->Comparision->no_elevators?'fg-color-green':'fg-color-darken'; ?>"></i></td>
		<td><i class="icon-music <?php echo $data->Comparision->music?'fg-color-green':'fg-color-darken'; ?>"></i></td>		
		<td><?php echo Html::a('<i class="icon-arrow-right"></i> '.Yii::t('app','anzeigen'), $data->url,array()); ?></td>
	</tr>
</table>


