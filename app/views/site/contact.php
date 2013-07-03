<?php
use yii\helpers\Html;
use app\components\MyHtml;
use yii\widgets\ActiveForm;
use yii\widgets\Captcha;

/**
 * @var yii\base\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\models\ContactForm $model
 */

$this->title = 'Kontakt';
?>

	<h1><?php echo Html::encode($this->title); ?></h1>

	<?php if(Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
	<div class="row-fluid">
		<div class="span12">
			<div class="info">
				Danke, einer unserer Mitarbeiter wird sich so schnell wie möglich bei Ihnen melden!
			</div>
		</div>
	</div>
	<?php else:?>
	<p>
		Bei Fragen oder Hinweisen, bitten wir Sie folgendes Formular auszufüllen und an uns zu schicken!
	</p>	

	<?php $form = ActiveForm::begin(array(
		'options' => array('class' => 'form-horizontal'),
		'fieldConfig' => array(
			'class' => 'app\components\MyActiveField'
		),
	)); ?>
		
		<?php echo $form->field($model, 'name')->textInput(); ?>
		<?php echo $form->field($model, 'email')->textInput(); ?>
		<?php echo $form->field($model, 'subject')->textInput(); ?>
		<?php echo $form->field($model, 'body')->textArea(array('rows' => 6)); ?>
		<?php echo $form->field($model, 'verifyCode')->widget(Captcha::className(), array(
			'options' => array('class' => 'input-medium'),
		)); ?>

		<div class="form-actions">			
			<?php echo Html::submitButton('<i class="icon-envelope-alt"></i> senden', array('class'=>'btn btn-success fg-color-white')); ?>
		</div>
	<?php ActiveForm::end(); ?>

	<?php endif; ?>
