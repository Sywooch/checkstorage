<?php

use \Yii;
use \yii\helpers\Html;

?>

<?php if(sizeOf($historics)): ?>
	
	<?php foreach($historics AS $history): ?>

		<?php echo Html::a('v. '.$history->time_create, $history->urlDiff); ?><br/>

	<?php endforeach; ?>

<?php else: ?>

	<small><?php echo Yii::t('app','No History'); ?></small>

<?php endif;?>
