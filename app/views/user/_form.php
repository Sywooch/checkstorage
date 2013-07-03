<?php

use \yii\helpers\Html;

?>
	
	<fieldset>
		<legend><?php echo Yii::t('app','General'); ?></legend>
		
		<div class="row-fluid">
			<div class="span12">
				<?php echo $form->field($model,'position')->dropDownList($model->getPostitionOptions()); ?>				
			</div>
		</div>
		<div class="row-fluid">
			<div class="span6">
				<?php echo $form->field($model,'username')->textInput(array('size'=>80,'maxlength'=>128)); ?>
				<?php echo $form->field($model,'prename')->textInput(array('size'=>80,'maxlength'=>128)); ?>
				<?php echo $form->field($model,'password')->passwordInput(array('size'=>80,'maxlength'=>128)); ?>
			</div>
			<div class="span6">				
				<?php echo $form->field($model,'email')->textInput(array('size'=>80,'maxlength'=>128)); ?>
				<?php echo $form->field($model,'name')->textInput(array('size'=>80,'maxlength'=>128)); ?>				
			</div>
		</div>
	
	</fieldset>

