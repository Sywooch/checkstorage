<?php
use \yii\helpers\Html;
use app\models\Comment;

$deleteJS = <<<DEL
$('.container').on('click','.op a.delete',function() {
	var th=$(this),
		container=th.closest('div.comment'),
		id=container.attr('id').slice(1);
	if(confirm('Are you sure you want to delete comment #'+id+'?')) {
		$.ajax({
			url:th.attr('href'),
			data:{
				'ajax':1
			},
			type:'POST'
		}).done(function(){container.slideUp()});
	}
	return false;
});

DEL;
$this->registerJs($deleteJS);
?>

<div class="row comment" id="c<?php echo $data->id; ?>">

	<p>
		<?php echo Html::a("#{$data->id}", $data->url, array(
			'class'=>'cid',
			'title'=>Yii::t('app','Permalink to this comment'),
		)); ?>
		<?php echo $data->AuthorLink; ?> <?php echo Yii::t('app','says on'); ?>
		<?php echo Html::a(Html::encode($data->post->title), $data->post->url); ?>
	<p>

	<p class="op">
		<?php if($data->status==Comment::STATUS_PENDING): ?>
			<span class="pending">Pending approval</span> |
			<?php echo Html::a('Approve', array('comment/approve','id'=>$data->id), array('class'=>'approve')); ?> |
		<?php endif; ?>
		<?php echo Html::a('Update',array('comment/update','id'=>$data->id)); ?> |
		<?php echo Html::a('Delete',array('comment/delete','id'=>$data->id),array('class'=>'delete')); ?> |
		<?php echo date('F j, Y \a\t h:i a',$data->time_create); ?>
	</p>

	<p class='lead'>
		<?php echo nl2br(Html::encode($data->content)); ?>
	</p>

</div><!-- comment -->