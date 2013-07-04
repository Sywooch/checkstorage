<?php 
use \yii\helpers\Html;

use app\helpers\HighlightHelper;
?>
<div class="row-fluid">
	<p><small>Lageraum in:</small> <b><?php echo $data->name; ?></b> von <?php echo $data->Owner->prename; ?> <?php echo $data->Owner->name; ?></p>
	<p><?php echo $data->city; ?> <?php echo $data->address; ?>	
	<?php echo Html::a('<i class="icon-arrow-right"></i> '.Yii::t('app','anzeigen'), $data->url,array()); ?>	</p>
</div>
