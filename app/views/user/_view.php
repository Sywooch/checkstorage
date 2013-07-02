<?php 
use \yii\helpers\Html;

use \yii\bootstrap\Tabs;
?>

<div class="row-fluid">
<?php 

$items = array();
$items[] = array(
            'label' => Yii::t('app','General User'),
            'active' => true,
            'content' => $this->context->renderPartial('_view_user',array('data'=>$data)),
        );
if($data->id==Yii::$app->user->id)
    $items[] = array(
            'label' => Yii::t('app','Messaging'),
            'content' => $this->context->renderPartial('tabs/_view_user_messages',array('msgmodels'=>$msgmodels,'pagination'=>$pagination)),
        );


echo Tabs::widget(array(
	 'id'=>'userTabs',
     'items' => $items,
));
?>
</div>
