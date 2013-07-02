<?php 
use \yii\helpers\Html;

use app\helpers\HighlightHelper;
?>

<div class="row-fluid">	
	<table>
		<tr>
			<td><b><?php echo HighlightHelper::highlightWords($data->prename.' '.$data->name,array($searchText)); ?></b></td>
		</tr>		
		<tr>
			<td><i class="icon-accessibility"></i> <?php echo Html::encode($data->location->name); ?></td>
		</tr>
		<?php if($data->email!=''):?>
			<tr>
				<td><i class="icon-mail"></i> <?php echo Html::encode($data->email); ?></td>
			</tr>
		<?php endif; ?>
		<?php if($data->mobile!=''):?>
			<tr>
				<td><i class="icon-mobile"></i> <?php echo Html::encode($data->mobile); ?></td>
			</tr>
		<?php endif; ?>
		<?php if($data->phone!=''):?>
			<tr>
				<td><i class="icon-phone"></i> <?php echo Html::encode($data->phone); ?></td>
			</tr>
		<?php endif; ?>
		<tr>
			<td><i class="icon-user-3"></i> <?php echo Html::encode($data->ReportTo->prename); ?> <?php echo Html::encode($data->ReportTo->name); ?></td>
		</tr>
	</table>
</div>
<p>&nbsp;</p>