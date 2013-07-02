<?php 
use \yii\helpers\Html;

use app\helpers\HighlightHelper;
?>
<div class="row-fluid">
	<small>Found hit in:</small>
	<p><?php echo $data->name; ?></p>
</div>
<div class="row-fluid">	
	<p>
		<?php echo substr(HighlightHelper::highlightWords(strip_tags($data->body),array($searchText)),0,200).'...'; ?>	
	</p>
	<?php echo Html::a('<i class="icon-arrow-right"></i>'.Yii::t('app','view'), $data->url,array()); ?>	
</div>
