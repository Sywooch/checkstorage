<?php
use \Yii;
use \yii\helpers\Html;
use \yii\widgets\Block;
use \yii\widgets\ActiveForm;

use \yii\bootstrap\Tabs;
?>

<?php Block::begin(array('id'=>'sidebar')); ?>
	<ul>
		<li class="sticker sticker-color-yellow"><?php echo Html::a('<i class="icon-arrow-left-3"></i>Overview User', array('/user/index')); ?></li>
	</ul>
<?php Block::end(); ?>

<h1>
    <?php echo Html::a('<i class="icon-arrow-left-3"></i>'.Yii::t('app','back'), array('/user/view','id'=>$model->id),array()); ?>
    <?php echo Yii::t('app','Edit User Form'); ?>
</h1>

<?php $form = ActiveForm::begin(array(
    'options' => array('class' => 'form-horizontal'),
    'fieldConfig' => array(
            'class' => 'app\components\MyActiveField'
    ),
)); ?>

<?php 
$myTabs = array();
$myTabs[] = array(
            'label' => Yii::t('app','General User'),
            'active' => true,
            'content' => $this->context->renderPartial('/user/_form', array('model'=>$model,'form'=>$form)),
        );
$myTabs[] = array(
            'label' => Yii::t('app','User Contact'),
            'content' => $this->context->renderPartial('/user/_form_contact', array('model'=>$model,'form'=>$form)),
        );
if(Yii::$app->user->isAdmin)
        $myTabs[] =  array(
            'label' => Yii::t('app','User Admin'),
            'visible' => Yii::$app->user->isAdmin,
            'content' => $this->context->renderPartial('/user/tabs/_form_tab_admin', array('model'=>$model,'form'=>$form)),
        );

echo Tabs::widget(array(
     'id'=>'userTabs',
     'items' => $myTabs,
));
?>

<div class="form-actions">
    <?php echo Html::submitButton($model->isNewRecord ? '<i class="icon-plus"></i> '.Yii::t('app','Create') : '<i class="icon-pencil"></i> '.Yii::t('app','Save'), array('class'=>'btn btn-success fg-color-white')); ?>
</div>

<?php ActiveForm::end(); ?>
