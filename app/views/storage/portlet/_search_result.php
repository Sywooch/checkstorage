<?php 
use \yii\helpers\Html;

use app\helpers\HighlightHelper;
?>
<div class="row-fluid">
	<div class="span5">
		<p><b><?php echo $data->name; ?></b> von <b><?php echo $data->Owner->prename; ?> <?php echo $data->Owner->name; ?></b></p>
		<div>
			<?php echo $data->address; ?><br>
			<?php echo $data->zipcode; ?> <?php echo $data->city; ?> 
		</div>
	</div>
	<div class="span7">
		<table class="table striped">
			<tr>
				<td class="fg-color-white bg-color-green1" style="text-align:center">1qm</td>
				<td class="fg-color-white bg-color-green2" style="text-align:center">2qm</td>
				<td class="fg-color-white bg-color-green4" style="text-align:center">4qm</td>
				<td class="fg-color-white bg-color-green6" style="text-align:center">6qm</td>
				<td class="fg-color-white bg-color-green10" style="text-align:center">10qm</td>
			</tr>
			<tr>
				<td>
					<small>ab</small><b>9,-</b> <i class="icon-eur tipster" title="Ohne Gewähr!"></i><br>
					Woche
				</td>
				<td>
					<small>ab</small><b>17,-</b> <i class="icon-eur tipster" title="Ohne Gewähr!"></i><br>
					Woche
				</td>
				<td>
					<small>ab</small><b>32,-</b> <i class="icon-eur tipster" title="Ohne Gewähr!"></i><br>
					Woche
				</td>
				<td>
					<small>ab</small><b>48,-</b> <i class="icon-eur tipster" title="Ohne Gewähr!"></i><br>
					Woche
				</td>
				<td>
					<small>ab</small><b>78,-</b> <i class="icon-eur tipster" title="Ohne Gewähr!"></i><br>
					Woche
				</td>
			</tr>
		</table>
	</div>
</div>
<div class="row-fluid">
	<div class="span11">
		<table class="table">
			<tr>
				<td class="bg-color-white"><i class="icon-bullseye fg-color-red tipster" title="Entfernung zu Ihrer Adresse in km"></i> <?php echo number_format($data->calcDistanceBetween($model->latitude, $model->longitude), 2, ',', '.'); ?>km</td>
				<td class="bg-color-white"><i class="icon-resize-vertical fg-color-red tipster" title="Raumhöhe in Metern"></i> <?php echo number_format($data->Comparision->room_height, 2, ',', '.'); ?>m</td>
				<td class="bg-color-white"><i class="icon-fire <?php echo $data->Comparision->fireprotection?'fg-color-green':'fg-color-yellow'; ?> tipster" title="Brandmelder"></i></td>
				<td class="bg-color-white"><i class="icon-camera-retro <?php echo $data->Comparision->security_camera?'fg-color-green':'fg-color-yellow'; ?> tipster" title="Kameraüberwachung"></i></td>
				<td class="bg-color-white"><i class="icon-key <?php echo $data->Comparision->security_access?'fg-color-green':'fg-color-yellow'; ?> tipster" title="Zugangskontrolle"></i></td>
				<td class="bg-color-white"><i class="icon-user-md <?php echo $data->Comparision->security_service?'fg-color-green':'fg-color-yellow'; ?> tipster" title="Wachschutz"></i></td>
				<td class="bg-color-white"><i class="icon-dropbox <?php echo $data->Comparision->shopping?'fg-color-green':'fg-color-yellow'; ?> tipster" title="Verpackungsmaterial vor Ort"></i></td>
				<td class="bg-color-white"><i class="icon-shopping-cart <?php echo $data->Comparision->trolleys?'fg-color-green':'fg-color-yellow'; ?> tipster" title="Transporthilfen"></i></td>
				<td class="bg-color-white"><i class="icon-cogs <?php echo $data->Comparision->no_elevators?'fg-color-green':'fg-color-yellow'; ?> tipster" title="Aufzüge im Gebäude"></i></td>
				<td class="bg-color-white"><i class="icon-music <?php echo $data->Comparision->music?'fg-color-green':'fg-color-yellow'; ?> tipster" title="Musikbeschallung"></i></td>		
				<td class="bg-color-white"><?php echo Html::a('<i class="icon-arrow-right"></i> '.Yii::t('app','anzeigen'), $data->url,array()); ?></td>
			</tr>
		</table>
	</div>
</div>

