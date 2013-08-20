<?php

use \yii\helpers\Html;
use \yii\widgets\ActiveForm;
use \yii\widgets\ActiveField;
use app\components\MyHtml;
use \yii\jui\DatePicker;

?>

<?php if(is_Null($hits)): ?>

<?php $form = ActiveForm::begin(array(
	//'options' => array('class' => ActiveField::className()),
)); 
?>

<div class="row" style="padding-bottom: 4px">
	<div class="col-lg-6">
		<?php echo $form->field($model,'address',array('template' => "{input}\n{error}"))->textInput(array('maxlength'=>128,'placeholder'=>'Ihre Adresse...','class'=>'col-lg-12 tipster','title'=>'Adresse, Stadt oder Postleitzahl eintragen...')); ?>
	</div>
	<div class="col-lg-6">
		<?php echo $form->field($model,'int_weeks',array('template' => "{input}\n{error}"))->textInput(array('maxlength'=>128,'placeholder'=>'4 (Mietdauer in Wochen)','class'=>'col-lg-11 tipster','title'=>'Mietdauer in Wochen, min. 2 Wochen...')); ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">		
		<?php echo $form->field($model,'double_sqm')->textInput(array('maxlength'=>128,'class'=>'pull-right tipster','placeholder'=>'1.00','title'=>'Grundfläche in Quadratmetern, von 0.5 bis 100')); ?>
		<?php echo $form->field($model,'double_distance')->textInput(array('maxlength'=>128,'class'=>'pull-right tipster','placeholder'=>'5','title'=>'Maximale Entfernung von ihrer obigen Adresse...')); ?>
	</div>
	<div class="col-lg-6">
		<div class="control-group">
			<label for="storagesearchform-date_start">Ab </label>
			<div class="controls">
				<?php echo DatePicker::widget(array(
				  'id' => 'storagesearchform-date_start',
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
			          'showOn' => 'both',
			          'buttonImage' => 'img/calendar.gif',
			          'buttonImageOnly' => false,			       								         
			      ),
				));?>
			</div>	
		</div>
		<div class="control-group">
			<label for="storagesearchform-date_start" class="control-label">&nbsp;</label>
			<div class="controls">
				<?php echo Html::submitButton('<i class="icon-search"></i> '.Yii::t('app','Finden!'), array('class'=>'btn btn-warning fg-color-white col-lg-11')); ?>	
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

