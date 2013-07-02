<?php
use \yii\helpers\Html;
use \yii\widgets\ActiveForm;

use app\models\Costcenter;
use app\models\Geography;
?>

<div class="row-fluid">
	<div class="span12">
		<div class="page-control" data-role="page-control">
			<!-- Responsive controls -->
			<span class="menu-pull"></span>
				<div class="menu-pull-bar"></div>
					<!-- Tabs -->
				<ul>
					<li class="active"><a href="#frame1">Location</a></li>
					<?php if(Yii::$app->user->isAdmin): ?>
						<li><a href="#frame2">Additional Information</a></li>
					<?php endif; ?>			
				</ul>
				<!-- Tabs content -->

				<?php $form = ActiveForm::begin(array(
						'options' => array('class' => 'form-horizontal'),
						'fieldConfig' => array(
								'class' => 'app\components\MyActiveField'
						),
				)); ?>
				
				<div class="frames">
					<div class="frame active" id="frame1">
					<h3>
						<div class="button-set" data-role="button-set">
							<?php echo $model->isNewRecord ? Html::a('<i class="icon-arrow-left"></i>back', array('/location/index'),array('class'=>'btn')) : Html::a('<i class="icon-arrow-left"></i>back', array('/location/view','id'=>$model->id),array('class'=>'btn')); ?>
						</div>
						Edit Location Form
					</h3>
						
						<fieldset>
							<legend>General</legend>											

						<?php echo $form->field($model,'name')->textInput(array('size'=>80,'maxlength'=>128)); ?>
						<?php echo $form->field($model,'email')->textInput(array('size'=>80,'maxlength'=>250)); ?>
						
						</fieldset>

						<fieldset>
							<legend>Address</legend>

						<?php echo $form->field($model,'address')->textInput(array('size'=>80,'maxlength'=>250)); ?>
						<?php echo $form->field($model,'zipcode')->textInput(array('size'=>15,'maxlength'=>15)); ?>
						<?php echo $form->field($model,'city')->textInput(array('size'=>80,'maxlength'=>250)); ?>
						<?php echo $form->field($model,'country')->textInput(array('size'=>80,'maxlength'=>250)); ?>
						
						</fieldset>

						<div class="form-actions">
							<?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-success fg-color-white')); ?>
						</div>
							
					</div>				
					<div class="frame" id="frame2">
						<h3>
						<div class="button-set" data-role="button-set">
							<?php echo $model->isNewRecord ? Html::a('<i class="icon-arrow-left"></i>back', array('/location/index'),array('class'=>'btn')) : Html::a('<i class="icon-arrow-left"></i>back', array('/location/view','id'=>$model->id),array('class'=>'btn')); ?>
						</div>
						Edit Additional Location Information
						</h3>

						<fieldset>
							<legend>Building</legend>											

						<?php echo $form->field($model,'date_opening')->textInput(array('size'=>80,'maxlength'=>128)); ?>
						<div class="row-fluid">
							<div class="span6"><?php echo $form->field($model,'category_property')->radioList($model->getCatPropertiesOptions()); ?></div>
							<div class="span6"><?php echo $form->field($model,'category_age')->radioList(array(0=>'Old',1=>'New')); ?></div>
						</div>						
						
						</fieldset>
						
						<fieldset>
							<legend>Controlling</legend>

						<?php echo $form->field($model,'costcenter_id')->dropDownList(Costcenter::getListOptions()); ?>
						<?php echo $form->field($model,'geography_id')->dropDownList(Geography::getListOptions()); ?>
						<?php echo $form->field($model,'stat_bgf')->textInput(array('size'=>15,'maxlength'=>15)); ?>
						<?php echo $form->field($model,'stat_final_nnf')->textInput(array('size'=>15,'maxlength'=>15)); ?>
						
						</fieldset>

						<div class="form-actions">
							<?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-success fg-color-white')); ?>
						</div>

					</div>					
				</div>

				<?php ActiveForm::end(); ?>

			</span>
		</div>
	</div>
</div>
