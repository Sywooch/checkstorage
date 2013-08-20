<?php

use \yii\helpers\Html;
use \yii\jui\DatePicker;

use yii\widgets\MaskedInput;

?>
	
		
<div class="control-group">
	<label class="control-label"><?php echo Yii::t('app','Phone'); ?></label>
	<div class="controls">
		<div class="input-control text">
			<?php echo MaskedInput::widget(array(
				'model'=>$model,
				'attribute'=>'phone',
				'mask'=>'+(99) 999 99 ?99 9999'
			));?>
		</div>
	</div>
</div>

<div class="control-group">
	<label class="control-label"><?php echo Yii::t('app','Mobile'); ?></label>
	<div class="controls">
		<div class="input-control text">
			<?php echo MaskedInput::widget(array(
				'model'=>$model,
				'attribute'=>'mobile',
				'mask'=>'+(99) 999 99 ?99 9999'
			));?>
		</div>
	</div>
</div>

<div class="control-group">
	<label class="control-label"><?php echo Yii::t('app','Fax'); ?></label>
	<div class="controls">
		<div class="input-control text">
			<?php echo MaskedInput::widget(array(
				'model'=>$model,
				'attribute'=>'fax',
				'mask'=>'+(99) 999 99 ?99 9999'
			));?>
		</div>
	</div>
</div>

<?php echo $form->field($model,'messanger')->textInput(array('size'=>40,'maxlength'=>128)); ?>
				
