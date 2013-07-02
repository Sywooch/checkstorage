<?php 
use \yii\helpers\Html;

foreach($comments as $comment): ?>
<div class="comment" id="c<?php echo $comment->id; ?>">
	<?php echo Html::a("#{$comment->id}", $comment->url, array(
		'class'=>'cid',
		'title'=>'Permalink to this comment',
	)); ?>

	<p>
		<?php echo date('F j, Y \a\t h:i a',$comment->time_create); ?><br/>
		<?php echo $comment->AuthorLink; ?> said
	</p>

	<p class='lead'>
		<?php echo nl2br(Html::encode($comment->content)); ?>
	</p>

</div><!-- comment -->
<?php endforeach; ?>