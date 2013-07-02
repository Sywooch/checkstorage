<?php

use \yii\helpers\Html;
use \yii\jui\DatePicker;

use app\models\Location;
use app\models\Orgunit;

use yii\widgets\MaskedInput;

?>
	
	<fieldset>
		<legend>Contact</legend>
		
		<div class="control-group">
			<label class="control-label"><?php echo Yii::t('app','Phone'); ?></label>
			<div class="controls">
				<div class="input-control text">
					<?php echo MaskedInput::widget(array(
						'model'=>$model,
						'attribute'=>'phone',
						'mask'=>substr($model->Location->Costcenter->name,0,2)=='AT'?'+(99) 9 99 9?9 9999':'+(99) 999 99 9?9 9999'
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
						'mask'=>'+(99) 999 99 9?9 9999'
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
						'mask'=>substr($model->Location->Costcenter->name,0,2)=='AT'?'+(99) 9 99 9?9 9999':'+(99) 999 99 9?9 9999'
					));?>
				</div>
			</div>
		</div>

	<?php echo $form->field($model,'messanger')->textInput(array('size'=>80,'maxlength'=>128)); ?>

	</fieldset>						
