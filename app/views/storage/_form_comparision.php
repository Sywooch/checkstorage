<?php

//formular for storage place

use \yii\helpers\Html;

/*
'id'                   => 'ID',
'storage_id'           => Yii::t('app','Standort'),
#'no_elevators'         => Yii::t('app','Anzahl Aufzüge'),
#'room_height'          => Yii::t('app','Raum Höhe'),
#'fireprotection'       => Yii::t('app','Feuerschutz'),
#'externalunits'        => Yii::t('app','Aussenlager'),
#'security_camera'      => Yii::t('app','Kameraüberwacht'),
#'security_access'      => Yii::t('app','Zugangssicherung'),
#'security_service'     => Yii::t('app','Sicherheitsdienst'),
#'trolleys'             => Yii::t('app','Ladewagen'),
#'aircondition'         => Yii::t('app','Klimaanlage'),
#'aircondition_office'  => Yii::t('app','Klimaanlage Büro'),
#'max_degrees'          => Yii::t('app','max. Temp. Sommer'),
#'min_degrees'          => Yii::t('app','min. Temp. Winter'),
#'shopping'             => Yii::t('app','Verpackungsmaterial'),
#'shopping_pricelevel'  => Yii::t('app','Preisniveau Shop'),
'music'                => Yii::t('app','Musik'),
'opening_start'        => Yii::t('app','Zugang Abteil von'),
'opening_end'          => Yii::t('app','Zugang Abteil bis'),
'opening_days'         => Yii::t('app','Zugangstage'),
'opening_office_start' => Yii::t('app','Bürozeiten von'),
'opening_office_end'   => Yii::t('app','Bürozeiten bis'),
'opening_office_days'  => Yii::t('app','Bürotage'),
#'no_parking'           => Yii::t('app','Kundenparkplätze'),
*/

?>
	
	<fieldset>
		<legend><?php echo Yii::t('app','Vergleichsfaktoren'); ?></legend>		
		
		<div class="row-fluid">
			<div class="span5">
				<?php echo $form->field($model,'no_elevators')->textInput(array('size'=>80,'maxlength'=>128,'class'=>'tipster','title'=>'Wie viele Lastenaufzüge gibt es vor Ort?')); ?>
				<?php echo $form->field($model,'no_parking')->textInput(array('size'=>80,'maxlength'=>128,'class'=>'tipster','title'=>'Wie viele Kundenparkplätze gibt es vor Ort?')); ?>
			</div>
			<div class="span7">				
				<?php echo $form->field($model,'room_height')->textInput(array('size'=>80,'maxlength'=>128,'class'=>'tipster','title'=>'Welche Höhe haben die Abteile im Schnitt')); ?>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span5">
				<?php echo $form->field($model,'max_degrees')->textInput(array('size'=>10,'maxlength'=>10,'class'=>'tipster','title'=>'Wie hoch ist die max. Temperatur die in den Räumen erreicht wird?')); ?>
			</div>
			<div class="span7">				
				<?php echo $form->field($model,'min_degrees')->textInput(array('size'=>80,'maxlength'=>128,'class'=>'tipster','title'=>'Wie niedrig ist die min. Temperatur die in den Räumen erreicht wird?')); ?>				
			</div>
		</div>
		<div class="row-fluid">
			<div class="span5">
				<?php echo $form->field($model,'fireprotection')->checkbox(array('class'=>'tipster','title'=>'Brandschutz')); ?>
			</div>
			<div class="span7">				
				<?php echo $form->field($model,'externalunits')->checkbox(array('class'=>'tipster','title'=>'Freistehende Abteile')); ?>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span5">
				<?php echo $form->field($model,'security_camera')->checkbox(array('class'=>'tipster','title'=>'Kameraüberwacht')); ?>
			</div>
			<div class="span7">				
				<?php echo $form->field($model,'security_access')->checkbox(array('class'=>'tipster','title'=>'Zugangssicherung')); ?>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span5">
				<?php echo $form->field($model,'security_service')->checkbox(array('class'=>'tipster','title'=>'Sicherheitsdienst')); ?>
			</div>
			<div class="span7">				
				<?php echo $form->field($model,'trolleys')->checkbox(array('class'=>'tipster','title'=>'Transportwagen')); ?>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span5">
				<?php echo $form->field($model,'aircondition')->checkbox(array('class'=>'tipster','title'=>'Klimatisiert')); ?>
			</div>
			<div class="span7">				
				<?php echo $form->field($model,'aircondition_office')->checkbox(array('class'=>'tipster','title'=>'Büro klimatisiert')); ?>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span5">
				<?php echo $form->field($model,'shopping')->checkbox(array('class'=>'tipster','title'=>'Verpackungsmaterial vor Ort')); ?>
			</div>
			<div class="span7">				
				<?php echo $form->field($model,'music')->checkbox(array('class'=>'tipster','title'=>'Musik im Lagerraum')); ?>
				<?php //echo $form->field($model,'shopping_pricelevel')->checkbox(array('class'=>'tipster','title'=>'Transportwagen')); ?>
			</div>
		</div>
	
	</fieldset>

