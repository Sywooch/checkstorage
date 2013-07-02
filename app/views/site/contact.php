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

$this->title = 'Contact';
?>

<section id="content">
	<h1><?php echo Html::encode($this->title); ?></h1>

	<?php if(Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
	<div class="row-fluid">
		<div class="span12">
			<div class="info-bar" style="position:relative;">
				Thank you for contacting us. We will respond to you as soon as possible.
			</div>
		</div>
	</div>
	<?php return; endif; ?>

	<p>
		If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
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
		<?php
			$field = $form->field($model, 'verifyCode');
			echo $field->begin();
			echo $field->label();
			echo Captcha::widget();
			echo "<div class='span4'>";
			echo MyHtml::activeTextInput($model, 'verifyCode',array());
			echo "</div>";
			echo $field->error();
			echo $field->end();
		?>
		<div class="form-actions">
			<?php echo Html::submitButton('Submit', array('class'=>'btn btn-success fg-color-white')); ?>
		</div>
	<?php ActiveForm::end(); ?>
</section>