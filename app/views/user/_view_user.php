<?php

use \yii\helpers\Html;

?>

<h3><?php echo Yii::t('app','User'); ?></h3>
<table class="table table-striped">
	<tr>
		<td class="span2"><?php echo Yii::t('app','Username'); ?>:</td>
		<td><?php echo Html::encode($data->username); ?></td>
	</tr>
	<tr>
		<td class="span2"><?php echo Yii::t('app','E-Mail'); ?>:</td>
		<td><?php echo Html::encode($data->email); ?></td>
	</tr>
	<tr>
		<td class="span2"><?php echo Yii::t('app','Employee No'); ?>:</td>
		<td><?php echo Html::encode($data->no_employee); ?></td>
	</tr>
	<tr>
		<td class="span2"><?php echo Yii::t('app','Entry Date'); ?>:</td>
		<td><?php echo Html::encode($data->date_entry); ?></td>
	</tr>
</table>
<h3><?php echo Yii::t('app','Organisational'); ?></h3>
<table class="table table-striped">
	<tr>
		<td class="span2"><?php echo Yii::t('app','Orga'); ?>:</td>
		<td><?php echo Html::encode($data->Orgunit->name); ?></td>
	</tr>
	<tr>
		<td class="span2"><?php echo Yii::t('app','Position'); ?>:</td>
		<td><?php echo Html::encode($data->PositionAsString); ?></td>
	</tr>
	<tr>
		<td class="span2"><?php echo Yii::t('app','Site'); ?>:</td>
		<td><?php echo Html::encode($data->Location->address); ?>(<?php echo Html::encode($data->Location->Costcenter->name); ?>)</td>
	</tr>
	<tr>
		<td class="span2"><?php echo Yii::t('app','Reports To'); ?>:</td>
		<td><?php echo Html::encode($data->ReportTo->name); ?>, <?php echo Html::encode($data->ReportTo->prename); ?></td>
	</tr>
	<tr>
		<td class="span2"><?php echo Yii::t('app','Backup'); ?>:</td>
		<td><?php echo Html::encode($data->Backup->name); ?>, <?php echo Html::encode($data->Backup->prename); ?></td>
	</tr>
</table>
<h3><?php echo Yii::t('app','Contact'); ?></h3>	
<table class="table table-striped">
	<tr>
		<td class="span2"><?php echo Yii::t('app','Phone'); ?>:</td>
		<td><?php echo Html::encode($data->phone); ?></td>
	</tr>
	<tr>
		<td class="span2"><?php echo Yii::t('app','Mobile'); ?>:</td>
		<td><?php echo Html::encode($data->mobile); ?></td>
	</tr>
	<tr>
		<td class="span2"><?php echo Yii::t('app','Fax'); ?>:</td>
		<td><?php echo Html::encode($data->fax); ?></td>
	</tr>
	<tr>
		<td class="span2"><?php echo Yii::t('app','Messanger'); ?>:</td>
		<td><?php echo Html::encode($data->messanger); ?></td>
	</tr>
</table>
