<?php
use \yii\helpers\Html;
use \yii\widgets\ActiveForm;

use yiiwymeditor\yiiwymeditor;
use app\models\Workflow;

?>


<?php $form = ActiveForm::begin(array(
	'options' => array('class' => 'form-inline'),
	'fieldConfig' => array(
			//'class' => 'app\components\MyActiveField'
		),
	)); 
?>

<div class="row">
	<div class="span4">
		<?php echo $form->field($model,'title')->textInput(array('size'=>80,'maxlength'=>128)); ?>
		<?php echo $form->field($model,'name')->textInput(array('size'=>80,'maxlength'=>128)); ?>
		<?php echo $form->field($model,'parent_pages_id')->dropDownList($model::getListOptions()); ?>
		<?php echo $form->field($model,'tags')->textInput(array('size'=>50)); ?>
		<?php echo $form->field($model,'status')->dropDownList(Workflow::getStatusOptions()); ?>	
	</div>
	<div class="span8">
		<?php echo yiiwymeditor::widget(array(
			'model'=>$model,
			'attribute'=>'body',
			'clientOptions'=>array(
				'toolbar' => 'basic',
				'height' => '500px',
				'filebrowserBrowseUrl' => Html::url(array('/pages/filemanager')),
				'filebrowserImageBrowseUrl' => Html::url(array('/pages/filemanager')),
			),
			'inputOptions'=>array(
				'size'=>'2',
			)
		));?>
	</div>
</div>

	<div class="form-actions">
		<?php echo Html::submitButton($model->isNewRecord ? Yii::t('app','Create') :  Yii::t('app','Save'), array('class'=>'btn btn-success fg-color-white')); ?>
	</div>

<?php ActiveForm::end() ?>
