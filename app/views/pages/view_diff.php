<?php
use \yii\helpers\Html;
use \Yii;
use \yii\widgets\Block;

use app\widgets\PortletCmsToc;
use app\widgets\PortletCmsHistory;
use app\widgets\PortletPagesToc;

use yiimetroui\Accordion;

?>

<?php Block::begin(array('id'=>'sidebar')); ?>
	
	<?php echo PortletCmsToc::widget(array(
  		'rootId'=>$model->id,
	)); ?>

	<?php echo PortletPagesToc::widget(); ?>

	<?php echo PortletCmsHistory::widget(array(
  		'id'=>$model->id,
	)); ?>

<?php Block::end(); ?>


<pre>
<?php print ($difftext); ?>
</pre>