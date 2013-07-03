<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/**
 * @var yii\base\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\models\LoginForm $model
 */
$this->title = 'Login';
?>

<h1>Login</h1>

<div class="row-fluid">
	<div class="span12">
		<?php $form = ActiveForm::begin(array(
			'options' => array('class' => 'form-horizontal'),
			'fieldConfig' => array(
				//'class' => 'app\components\MyActiveField' removed as it's working fine without!
			)
		)); 
		?>
			<?php echo $form->field($model, 'username')->textInput(); ?>
			<?php echo $form->field($model, 'password')->passwordInput(); ?>
			<?php echo $form->field($model, 'rememberMe')->checkbox(); ?>
			<div class="form-actions">				
				<?php echo Html::submitButton('<i class="icon-arrow-right"></i> '.Yii::t('app','Login'), array('class'=>'btn btn-success fg-color-white')); ?>
			</div>
		<?php ActiveForm::end(); ?>
	</div>
</div>

	
