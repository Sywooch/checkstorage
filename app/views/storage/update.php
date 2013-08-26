<?php

//update storage place

use \Yii;
use \yii\helpers\Html;
use \yii\widgets\Block;
use \yii\widgets\ActiveForm;
use \yii\widgets\ActiveField;

use \yii\bootstrap\Tabs;
?>

<?php Block::begin(array('id'=>'sidebar')); ?>
	<ul>
		<li class="mytoolbox"><?php echo Html::a('<i class="icon-arrow-left-3"></i>Lagerplatz Übersicht', array('/storage/admin')); ?></li>
	</ul>
<?php Block::end(); ?>

<h1>
    <small><?php echo Html::a('<i class="icon-arrow-left"></i> '.Yii::t('app','back'), array('/storage/admin'),array()); ?></small>
    <?php echo Yii::t('app','Lagerplatz bearbeiten'); ?>
</h1>


<?php $form = ActiveForm::begin(array(
    'options' => array('class' => ActiveField::className()),
)); ?>

<?php 
$myTabs = array();
$myTabs[] = array(
            'label' => Yii::t('app','Allgemeines'),
            'active' => true,
            'content' => $this->context->renderPartial('/storage/_form', array('model'=>$model,'form'=>$form)),
        );
$myTabs[] = array(
            'label' => Yii::t('app','Zusatzleistungen'),
            'active' => false,
            'content' => $this->context->renderPartial('/storage/_form_comparision', array('model'=>$model->Comparision,'form'=>$form)),
        );
/*$myTabs[] = array(
            'label' => Yii::t('app','User Contact'),
            'content' => $this->context->renderPartial('/user/_form_contact', array('model'=>$model,'form'=>$form)),
        );
if(Yii::$app->user->isAdmin)
        $myTabs[] =  array(
            'label' => Yii::t('app','User Admin'),
            'visible' => Yii::$app->user->isAdmin,
            'content' => $this->context->renderPartial('/user/tabs/_form_tab_admin', array('model'=>$model,'form'=>$form)),
        );*/

echo Tabs::widget(array(
     'id'=>'userTabs',
     'items' => $myTabs,
));
?>


<div class="form-actions">
    <?php echo Html::submitButton($model->isNewRecord ? '<i class="icon-plus"></i> '.Yii::t('app','Create') : '<i class="icon-pencil"></i> '.Yii::t('app','Save'), array('class'=>'btn btn-success fg-color-white')); ?>
</div>

<?php ActiveForm::end(); ?>
