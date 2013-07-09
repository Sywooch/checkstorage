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
		<?php echo $form->field($model,'address')->textInput(array('maxlength'=>128,'placeholder'=>'Ihre Adresse...','class'=>'input-xlarge tipster','title'=>'Adresse, Stadt oder Postleitzahl eintragen...')); ?>
	</div>
	<div class="span6">
		<?php echo $form->field($model,'int_weeks')->textInput(array('maxlength'=>128,'placeholder'=>'4 (in Wochen)','class'=>'tipster','title'=>'Mietdauer in Wochen, min. 2 Wochen...')); ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span6">		
		<?php echo $form->field($model,'double_sqm')->textInput(array('size'=>80,'maxlength'=>128,'class'=>'input-small tipster','placeholder'=>'1.00','title'=>'Grundfläche in Quadratmetern, von 0.5 bis 100')); ?>
		<?php echo $form->field($model,'double_distance')->textInput(array('size'=>80,'maxlength'=>128,'class'=>'input-small tipster','placeholder'=>'5','title'=>'Maximale Entfernung von ihrer obigen Adresse...')); ?>
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
			      'options'=>array(
			      	'class'=>'input-small tipster',
			      	'placeholder'=>date('d-m-Y'),
			      	'title'=>'Ab wann benötigen Sie das Abteil...',
			      ),
			      'clientOptions' => array(
			          'dateFormat' => 'dd-mm-yy',
			          'showOn' => 'button',
			          'buttonImage' => 'img/calendar.gif',
			          'buttonImageOnly' => false,			       								         
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

<?php
	foreach($hits as $hit) {
		echo $this->render('@app/views/storage/portlet/_search_result',array('data'=>$hit,'model'=>$model));
	}

	if(count($hits)==0)
		echo "An der von Ihnen angegebenen Adresse wurden keine Treffer gefunden, bitte versuchen Sie es erneut mit Strasse, Ort und Land..."

?>


<?php endif; ?>

