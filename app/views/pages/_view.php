<?php 
use \yii\helpers\Html;

$this->registerAssetBundle('app/syntaxhighlighter',POS_READY);

if (!isset($commentCount)) {
	$commentCount = 0;
	if (count($data->comments) > 0 ) $commentCount=count($data->comments);
}

$syntaxhighlighter = <<<DEL

hljs.initHighlightingOnLoad();

DEL;
$this->registerJs($syntaxhighlighter);

?>

<?php if (Yii::$app->user->isAdvanced): ?>
	<div class="pull-right">
		<?php echo Html::a(Yii::t('app','view'), $data->url,array('class'=>'btn')); ?>
		<?php echo Html::a(Yii::t('app','update'), $data->urlUpdate,array('class'=>'btn')); ?>
	</div>
<?php endif; ?>

<div class="row" id='cmswrapper'>
	<div style="padding-top:13px">
		<h1>
			<?php echo Html::encode($data->title);?>			
		</h1>
	</div>
	<p>
		<?php 
			if($data->special=='-1'){
				echo '<pre><code>';
				echo Html::encode($data->body);
				echo '</pre></code>';
			}else
				echo $data->body;				
		?>
	<p>
</div>
<div class="row">
	<p class="tags">
		<strong>Tags:</strong>
		<?php echo implode(' ', $data->tagLinks); ?>
	</p>
	<?php echo Html::a('Permalink', $data->url); ?> |
	<?php echo Html::a("Comments ({$commentCount})",$data->url.'#comments'); ?> |
	Last updated on <?php echo date('F j, Y',$data->time_update); ?>
</div>
