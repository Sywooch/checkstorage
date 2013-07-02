<?php

use \yii\helpers\Html;
use \yii\widgets\ActiveForm;
use app\components\MyHtml;

?>

<?php $form = ActiveForm::begin(array(
	'options' => array('class' => 'form-search'),
	'fieldConfig' => array(
		'class' => 'app\components\MyActiveField'
	)
)); 
?>

	<?php echo MyHtml::activeSearchInput($model,'searchstring',array('class'=>'search-query span8')); ?>

<?php ActiveForm::end(); ?>

<?php

if(!is_Null($hits)){
	foreach($hits as $hit) {
		echo $this->render('@app/views/pages/_search_result_portlet',array('data'=>$hit,'searchText'=>$model->searchstring));
	}
}
