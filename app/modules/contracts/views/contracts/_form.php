<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\base\View $this
 * @var app\modules\contracts\models\Contract $model
 * @var ActiveForm $form
 */
?>
<div class="contract-test">

    <?php $form = ActiveForm::begin(); ?>

        <?php echo $form->field($model, 'unit_id'); ?>
        <?php echo $form->field($model, 'user_id'); ?>
        <?php echo $form->field($model, 'is_consumer'); ?>
        <?php echo $form->field($model, 'date_created'); ?>
        <?php echo $form->field($model, 'date_start'); ?>
        <?php echo $form->field($model, 'date_end'); ?>
        <?php echo $form->field($model, 'date_deleted'); ?>
        <?php echo $form->field($model, 'note'); ?>
    
        <div class="form-group">
            <?php echo Html::submitButton('Submit', array('class' => 'btn btn-primary')); ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- contract-test -->