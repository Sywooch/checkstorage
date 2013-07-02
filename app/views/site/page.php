<?php
use yii\helpers\Html;
/**
 * @var yii\base\View $this
 */
$this->title = 'View';


if(!is_null($view)){
	echo $this->context->renderPartial('page/'.$view);
}else{
	echo $this->context->renderPartial('page/page_404');
}


?>
