<?php 
use \yii\helpers\Html;

use app\helpers\HighlightHelper;
?>
<div class="row-fluid">
	<div class="span4">
		<img src="img/storage/<?php echo Html::encode($data->Owner->id); ?>.png" alt="<?php echo $data->name; ?>" style="height:30px"></img> 
		<p><b><?php echo $data->Owner->prename; ?> <?php echo $data->Owner->name; ?></b></p>
	</div>
	<div class="span8">
		<div>
			<?php echo $data->address; ?><br>
			<?php echo $data->zipcode; ?> <?php echo $data->city; ?> <br>
			<i class="icon-phone"></i> <?php echo $data->phone; ?><br>
			<i class="icon-envelope"></i> <?php echo $data->mail; ?><br>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<table class="table">
			<tr>
				<td class="fg-color-white bg-color-green1" style="text-align:center"><?php echo Html::checkBox('rememberme'.$data->id.'_1','',array('class'=>'tipster','title'=>'Hier klicken um das Abteil für Ihre Anfrage zu selektieren.')); ?> 1qm</td>
				<td class="fg-color-white bg-color-green2" style="text-align:center"><?php echo Html::checkBox('rememberme'.$data->id.'_2','',array('class'=>'tipster','title'=>'Hier klicken um das Abteil für Ihre Anfrage zu selektieren.')); ?> 2qm</td>
				<td class="fg-color-white bg-color-green4" style="text-align:center"><?php echo Html::checkBox('rememberme'.$data->id.'_4','',array('class'=>'tipster','title'=>'Hier klicken um das Abteil für Ihre Anfrage zu selektieren.')); ?> 4qm</td>
				<td class="fg-color-white bg-color-green6" style="text-align:center"><?php echo Html::checkBox('rememberme'.$data->id.'_6','',array('class'=>'tipster','title'=>'Hier klicken um das Abteil für Ihre Anfrage zu selektieren.')); ?> 6qm</td>
				<td class="fg-color-white bg-color-green10" style="text-align:center"><?php echo Html::checkBox('rememberme'.$data->id.'_10','',array('class'=>'tipster','title'=>'Hier klicken um das Abteil für Ihre Anfrage zu selektieren.')); ?> 10qm</td>
				<td>
					<div class="pull-right">
					 <a id="btn_<?php echo $data_id; ?>" href="<?php echo Html::url(array('/storage/rememberme')); ?>" class="btn btn-inverse"><i class="icon-star tipster" title="Anfragen"></i></a>
					</div>
				</td>
			</tr>
			<tr>
				<td class="bg-color-blue1 priceinfo">
					<small>ab</small> <b><?php echo $data->getUnitPrice(1.00)->one()->unit_rate; ?></b> <i class="icon-eur tipster" title="pro Woche, Ohne Gewähr!"></i><br>
				</td>
				<td class="bg-color-blue2 priceinfo">
					<small>ab</small> <b><?php echo $data->getUnitPrice(2.00)->one()->unit_rate; ?></b> <i class="icon-eur tipster" title="pro Woche, Ohne Gewähr!"></i><br>
				</td>
				<td class="bg-color-blue4 priceinfo">
					<small>ab</small> <b><?php echo $data->getUnitPrice(4.00)->one()->unit_rate; ?></b> <i class="icon-eur tipster" title="pro Woche, Ohne Gewähr!"></i><br>
				</td>
				<td class="bg-color-blue6 priceinfo">
					<small>ab</small> <b><?php echo $data->getUnitPrice(6.00)->one()->unit_rate; ?></b> <i class="icon-eur tipster" title="pro Woche, Ohne Gewähr!"></i><br>
				</td>
				<td class="bg-color-blue10 priceinfo">
					<small>ab</small> <b><?php echo $data->getUnitPrice(10.00)->one()->unit_rate; ?></b> <i class="icon-eur tipster" title="pro Woche, Ohne Gewähr!"></i><br>
				</td>
				<td></td>
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

