<?php 

use \yii\helpers\Html;
use app\models\Workflow;

?>

<tr>
	<td class="bg-color-status<?php echo ucfirst($data->status_from)?>">
		<i class="icon-box-add"></i>
		<?php echo Html::encode($data->module); ?>
	</td>
	<td><?php echo Html::encode($data->PreviousUser->name); ?></td>
	<td><?php echo Html::encode($data->NextUser->name); ?></td>
	<td><?php echo Html::encode($data->status_from); ?></td>
	<td><?php echo Html::encode($data->status_to); ?></td>
	<td><?php echo Html::encode($data->date_create); ?></td>
	<td>	
		<i class="icon-eye"></i> <?php echo Html::a(Yii::t('app','view'), array('/'.Workflow::getModuleAsController($data->wf_table).'/formular','id'=>$data->wf_id)); ?>
	</td>
</tr>
