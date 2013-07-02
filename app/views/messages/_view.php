<?php 
use \yii\helpers\Html;
use \yii\widgets\Block;

?>

<?php Block::begin(array('id'=>'sidebar')); ?>
	<ul>
		<li class="sticker sticker-color-blue"><?php echo Html::a('<i class="icon-plus"></i>Create Message', array('/messages/create')); ?></li>
	</ul>
<?php Block::end(); ?>

<div class="row-fluid">	
	<h4><?php echo Html::encode($data->subject); ?></h4>
	<p>
	<?php
		echo $data->body;
	?>
	</p>
</div>
