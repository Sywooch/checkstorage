<?php

use \yii\helpers\Html;
use \yii\widgets\ActiveForm;
use app\components\MyHtml;
use yii\jui\DatePicker;

?>

<?php $form = ActiveForm::begin(array(
	'options' => array('class' => 'form-search'),
)); 
?>

<div class="row-fluid">
	<div class="span6">
		<?php echo $form->field($model,'address')->textInput(array('size'=>80,'maxlength'=>128)); ?>
		<?php echo $form->field($model,'double_sqm')->textInput(array('size'=>80,'maxlength'=>128)); ?>		
	</div>
	<div class="span6">
		<div class="control-group">
			<label for="storagesearchform-date_start" class="control-label">Ab</label>
			<div class="controls">
				<?php echo DatePicker::widget(array(
				  'id' => 'storagesearchform-date_start',
			      'language' => 'de',
			      'model' => $model,
			      'attribute' => 'date_start',
			      'inline'=>false,
			      'clientOptions' => array(
			          'dateFormat' => 'dd-mm-yy',								          
			      ),
				));?>
			</div>	
		</div>
		<div class="control-group">
			<label for="storagesearchform-date_start" class="control-label">&nbsp;</label>
			<div class="controls">
				<a href="#" class="btn btn-warning span10"><i class="icon-search"></i> Finden!</a>	
			</div>	
		</div>		
	</div>
</div>

<?php ActiveForm::end(); ?>
