<?php

//formular for storage place

use \yii\helpers\Html;

?>
	
	<fieldset>
		<legend><?php echo Yii::t('app','Lagerplatz'); ?></legend>
		
		
		<div class="row-fluid">
			<div class="span4">
				<?php echo $form->field($model,'name')->textInput(array('size'=>80,'maxlength'=>128,'class'=>'tipster','title'=>'Tragen Sie hier den Anzeigenamen des Standortes ein...')); ?>
			</div>
			<div class="span8">				
				<?php echo $form->field($model,'address')->textInput(array('size'=>80,'maxlength'=>128,'class'=>'tipster','title'=>'Tragen Sie hier die möglichst genaue Adresse des Standortes ein...')); ?>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span4">
				<?php echo $form->field($model,'zipcode')->textInput(array('size'=>10,'maxlength'=>10,'class'=>'tipster','title'=>'Die Postleitzahl der Stadt, in dem sich der Lagerort befindet...')); ?>
			</div>
			<div class="span8">				
				<?php echo $form->field($model,'city')->textInput(array('size'=>80,'maxlength'=>128,'class'=>'tipster','title'=>'Die Stadt, in dem sich der Lagerplatz befindet.')); ?>				
			</div>
		</div>
		<div class="row-fluid">
			<div class="span6">
				<?php echo $form->field($model,'country')->radioList($model->getCountryOptions()); ?>				
			</div>
		</div>
		
	
	</fieldset>

