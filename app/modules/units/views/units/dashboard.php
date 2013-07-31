<?php

use \Yii;
use \yii\helpers\Html;
use \yii\widgets\ListView;

$editJS = <<<EDIT
$('.container').on('click','.op a.edit',function() {
	var th=$(this),
		container=th.closest('tr.timetablescheduleddetail'),
		id=container.attr('id').slice(1);	
	$('#myEditModal').modal('show');
	$('#myEditModal div.modal-header h2').html('You are going to edit: '+id);
	$('#myEditModal div.modal-body').load(th.attr('href'));
	return false;
});

EDIT;
$this->registerJs($editJS);

?>

<?php 
	echo ListView::widget(array(
		'dataProvider'=>$dpUnit,
		'itemView' => '/../modules/units/views/units/iviews/_admin',
	));
?>
