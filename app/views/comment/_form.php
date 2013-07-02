<?php
use \yii\helpers\Html;
use \yii\widgets\ActiveForm;

?>

<div class="row-fluid">

<?php $form = ActiveForm::begin(array(
	'options' => array('class' => 'form-horizontal'),
	'fieldConfig' => array(
			'class' => 'app\components\MyActiveField'
	),
)); ?>
	<?php echo $form->field($model,'content')->textArea(array('rows'=>4, 'cols'=>50,'style'=>'width:80%')); ?>
	
	<div class="form-actions">		
		<?php echo Html::submitButton('<i class="icon-pencil"></i> '.Yii::t('app','Save'), array('class' => 'btn btn-success fg-color-white')); ?>
	</div>

<?php ActiveForm::end(); ?>

</div>
