<?php
use \yii\helpers\Html;

$this->params['breadcrumbs']=array(
	array(
		'label' => $model->name,		
	),
	'Update',
);
?>

<?php echo $this->context->renderPartial('_form', array('model'=>$model)); ?>
