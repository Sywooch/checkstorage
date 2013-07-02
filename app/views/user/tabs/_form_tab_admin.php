<fieldset>
	<legend><?php echo Yii::t('app','Internal'); ?></legend>

	<?php echo $form->field($model,'role')->dropDownList($model->getRoleOptions()); ?>

</fieldset>
