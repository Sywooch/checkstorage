<?php

use \Yii;
use \yii\helpers\Html;

use \yii\widgets\Block;
use \yii\widgets\ListView;
?>


<?php Block::begin(array('id'=>'sidebar')); ?>
	<ul class="nav nav-list">
	<li class="nav-header">Aktionen</li>
		<ul class="unstyled">
			<li class="mytoolbox"><?php echo Html::a('<i class="icon-arrow-left fg-color-white"></i> Übersicht', array('/storage/admin'),array('class'=>'fg-color-white')); ?></li>
		<?php			
			echo '<li class="mytoolbox">'.Html::a('<i class="icon-plus fg-color-white"></i> Vertrag anlegen',array('/contracts/contracts/createTable'),array('class'=>'fg-color-white')).'</li>';			
		?>
		</ul>
	</ul>
<?php Block::end(); ?>


<h1>Verträge</h1>


<?php 
	echo ListView::widget(array(
		'dataProvider'=>$provider,
		'itemView' => 'iviews/_admin',
	));
?>
