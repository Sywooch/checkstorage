<?php
use \yii\helpers\Html;
?>

<div class="row-fluid">
	<div class="span10">
	
<?php if($data->sender_id == Yii::$app->user->identity->id) : ?>
	<a href="<?php echo Html::url(array('/messages/view','id'=>$data->id)); ?>">
	<ul class="replies">
		<li class="bg-color-blue">
			<b class="sticker sticker-left sticker-color-blue"></b>
			<div class="avatar"><img src="http://lorempixel.com/g/50/50/technics/<?php echo Html::encode(!is_object($data->sender)?'System':$data->sender->username); ?>"/></div>
			<div class="reply">
				<div class="date"><?php echo Html::encode($data->date_create); ?></div>
				<div class="author"><?php echo Html::encode(!is_object($data->sender)?'System':$data->sender->username); ?> - <?php echo Html::encode($data->module); ?></div>
				<div class="text">
					<b><?php echo Html::encode($data->subject); ?></b><br/>
					<?php echo Html::encode($data->body); ?>
				</div>
			</div>
		</li>
	</ul>
	</a>
<?php else : ?>
	<a href="<?php echo Html::url(array('/messages/view','id'=>$data->id)); ?>">
	<ul class="replies pull-right">
		<li class="bg-color-green">
			<b class="sticker sticker-right sticker-color-green"></b>
			<div class="avatar"><img src="http://lorempixel.com/g/50/50/technics/<?php echo Html::encode(!is_object($data->sender)?'System':$data->sender->username); ?>"/></div>
			<div class="reply">
				<div class="date"><?php echo Html::encode($data->date_create); ?></div>
				<div class="author"><?php echo Html::encode(!is_object($data->sender)?'System':$data->sender->username); ?> - <?php echo Html::encode($data->module); ?></div>
				<div class="text">
					<b><?php echo Html::encode($data->subject); ?></b><br/>
					<?php echo Html::encode($data->body); ?>
				</div>
			</div>
		</li>
	</ul>
	</a>
<?php endif; ?>

	</div>
	<div class="span2">
		<div class="toolbar">
			<a href="<?php echo Html::url(array('/messages/view','id'=>$data->id)); ?>" class="button bg-color-yellow"><i class="icon-cancel"></i></a>
			<a href="<?php echo Html::url(array('/messages/reply','id'=>$data->id)); ?>" class="button bg-color-blueLight"><i class="icon-reply"></i></a>
		</div>
	</div>
</div>
