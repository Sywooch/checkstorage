<?php
use \yii\helpers\Html;

$this->params['breadcrumbs']=array(
	array(
		'label' => $model->subject,		
	),
	'Update',
);
?>

<h1>Update <i><?php echo Html::encode($model->subject); ?></i></h1>

<?php echo $this->context->renderPartial('_form', array('model'=>$model)); ?>