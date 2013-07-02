<?php

use \yii\helpers\Html;
use \yii\jui\DatePicker;

use app\models\Location;
use app\models\Orgunit;

?>
	
	<fieldset>
		<legend><?php echo Yii::t('app','General'); ?></legend>

		<div class="row-fluid">
			<div class="span6">
				<?php echo $form->field($model,'prename')->textInput(array('size'=>80,'maxlength'=>128)); ?>
				<?php echo $form->field($model,'name')->textInput(array('size'=>80,'maxlength'=>128)); ?>
				<?php echo $form->field($model,'no_employee')->textInput(array('size'=>25,'maxlength'=>25)); ?>
			</div>
			<div class="span6">
				<?php echo $form->field($model,'username')->textInput(array('size'=>80,'maxlength'=>128)); ?>
				<?php echo $form->field($model,'email')->textInput(array('size'=>80,'maxlength'=>128)); ?>
				<?php echo $form->field($model,'password')->passwordInput(array('size'=>80,'maxlength'=>128)); ?>
			</div>
		</div>	

		<div class="control-group">
			<label class="control-label"><?php echo Yii::t('app','Start Date'); ?></label>
			<div class="controls">
				<div class="input-control text">
					<?php echo DatePicker::widget(array(
				      'language' => 'de',
				      'model' => $model,
				      'attribute' => 'date_entry',
				      'inline' => false,
				      'clientOptions' => array(
				          'dateFormat' => 'yy-mm-dd',								          
				      ),
				      
					));?>
				</div>
			</div>
		</div>
	
	</fieldset>			
	
	<fieldset>
		<legend><?php echo Yii::t('app','Organisational'); ?></legend>

		<div class="row-fluid">
			<div class="span6">
				<?php echo $form->field($model,'location_id')->dropDownList(Location::getListOptions()); ?>
				<?php echo $form->field($model,'parent_user_id')->dropDownList($model::getListOptions()); ?>
				<?php echo $form->field($model,'backup_user_id')->dropDownList($model::getListOptions()); ?>
			</div>
			<div class="span6">
				<?php echo $form->field($model,'position')->dropDownList($model->getPostitionOptions()); ?>
				<?php echo $form->field($model,'orgunit_id')->dropDownList(Orgunit::getListOptions()); ?>
			</div>
		</div>
	</fieldset>

