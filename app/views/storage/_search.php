<?php

use \yii\helpers\Html;
use \yii\widgets\ActiveForm;
use app\components\MyHtml;
use yii\jui\DatePicker;

?>

<?php if(is_Null($hits)): ?>

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
				<?php echo Html::submitButton('<i class="icon-search"></i> '.Yii::t('app','Finden!'), array('class'=>'btn btn-warning fg-color-white span10')); ?>	
			</div>	
		</div>		
	</div>
</div>

<?php ActiveForm::end(); ?>

<?php else: ?>

<div style="height:160px">

<?php
	foreach($hits as $hit) {
		echo $this->render('@app/views/storage/portlet/_search_result',array('data'=>$hit));
	}
?>

</div>

<?php endif; ?>

