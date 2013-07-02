<?php 
use \yii\helpers\Html;

?>

<tr>
	<td><?php echo Html::encode($data->name); ?></td>
	<td><?php echo Html::encode($data->prename); ?></td>
	<td><?php echo Html::encode($data->username); ?></td>
	<td><?php echo Html::encode($data->date_entry); ?></td>
	<td><i class="icon-pencil"></i><?php echo Html::a("edit", array("update", "id"=>$data->id),array()); ?></td>
</tr>
