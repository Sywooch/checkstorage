<?php

use \yii\helpers\Html;

?>
	
<div class="row">
	<div class="col-lg-6">
		<?php echo $form->field($model,'prename')->textInput(array('size'=>80,'maxlength'=>128)); ?>
		<?php echo $form->field($model,'username')->textInput(array('size'=>80,'maxlength'=>128)); ?>
		<?php echo $form->field($model,'password')->passwordInput(array('size'=>80,'maxlength'=>128)); ?>
	</div>
	<div class="col-lg-6">				
		<?php echo $form->field($model,'name')->textInput(array('size'=>80,'maxlength'=>128)); ?>
		<?php echo $form->field($model,'email')->textInput(array('size'=>80,'maxlength'=>128)); ?>				
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<?php echo $form->field($model,'position')->radioList($model->getPostitionOptions()); ?>				
	</div>
	<div class="col-lg-6">
		UPLOAD WIDGET
	</div>
</div>
		