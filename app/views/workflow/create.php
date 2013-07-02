<?php

use yii\widgets\Block;

$this->params['breadcrumbs']=array(
	'Create Location',
);
?>

<?php echo $this->context->renderPartial('_form', array('model'=>$model)); ?>
