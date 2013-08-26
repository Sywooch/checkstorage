<?php

//formular for storage place

use \yii\helpers\Html;

?>
	
	<fieldset>
		<legend><?php echo Yii::t('app','Lagerplatz'); ?></legend>
		
		<div class="row">
			<div class="col-lg-4">
				<?php echo $form->field($model,'name')->textInput(array('maxlength'=>128,'class'=>'tipster','title'=>'Tragen Sie hier den Anzeigenamen des Standortes ein...')); ?>
			</div>
			<div class="col-lg-8">				
				<?php echo $form->field($model,'address')->textInput(array('maxlength'=>128,'class'=>'tipster','title'=>'Tragen Sie hier die möglichst genaue Adresse des Standortes ein...')); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4">
				<?php echo $form->field($model,'zipcode')->textInput(array('size'=>10,'maxlength'=>10,'class'=>'tipster','title'=>'Die Postleitzahl der Stadt, in dem sich der Lagerort befindet...')); ?>
			</div>
			<div class="col-lg-8">				
				<?php echo $form->field($model,'city')->textInput(array('maxlength'=>128,'class'=>'tipster','title'=>'Die Stadt, in dem sich der Lagerplatz befindet.')); ?>				
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<?php echo $form->field($model,'country')->radioList($model->getCountryOptions()); ?>				
			</div>
		</div>
		
	</fieldset>

	<fieldset>
		<legend><?php echo Yii::t('app','Kommunikation'); ?></legend>
		
		<div class="row">
			<div class="col-lg-4">
				<?php echo $form->field($model,'phone')->textInput(array('maxlength'=>128,'class'=>'tipster','title'=>'Tragen Sie hier den Anzeigenamen des Standortes ein...')); ?>
			</div>
			<div class="col-lg-8">				
				<?php echo $form->field($model,'mail')->textInput(array('maxlength'=>128,'class'=>'tipster','title'=>'Tragen Sie hier die möglichst genaue Adresse des Standortes ein...')); ?>
			</div>
		</div>
	
	</fieldset>

