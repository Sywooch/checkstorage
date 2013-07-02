<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yiimetroui\Tile;
use yiimetroui\Notice;
/**
 * @var yii\base\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\models\LoginForm $model
 */
$this->title = 'Login';
?>


<div class="row-fluid">
	<div class="span3">
		<?php echo Tile::widget(array(
			'items'=>array(
				array(
					'content'=>'<i class="icon-cube"></i>',
					'brand'=>'<div class="name">myplace</div>',					
				),
			),
			'options'=>array('class'=>'icon bg-color-redMyplace'),
		));
		?>
	</div>
	<div class="span9">
		<?php echo Notice::widget(array(
			'items'=>array(
				array(
					'header'=> Html::encode($this->title),
					'content'=>'<p>Welcome to the MyPlace Intranet!</p><p>Please fill out the following fields to login</p>',
					'icon'=>'<i class="icon-key fg-color-white"></i>',					
				),
			),
			'options'=>array('class'=>'bg-color-green'),
		));
		?>

		<p>&nbsp;</p>

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
				<?php echo Html::submitButton('<i class="icon-enter"></i> '.Yii::t('app','Login'), array('class'=>'btn btn-success fg-color-white')); ?>
			</div>
		<?php ActiveForm::end(); ?>
	</div>
</div>

	
