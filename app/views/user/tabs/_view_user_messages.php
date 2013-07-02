<?php

use \yii\helpers\Html;
use \yii\widgets\LinkPager;

?>


<div class="actions pull-right">
	<?php echo Html::a('<i class="icon-plus"></i> '.Yii::t('app','new Message'), array('/messages/create'),array('class'=>'btn')); ?>
</div>
<h3>						
	Messages
</h3>

<?php 

	foreach($msgmodels as $msg) {
		echo $this->context->renderPartial('/messages/_view_inline', array(
			'data'=>$msg,
		));
	}

	echo LinkPager::widget(array('pagination'=>$pagination));
?>
