<?php

use app\widgets\PortletUserSearch;
use app\widgets\PortletContentSearch;
use app\widgets\TagCloud;

?>

<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<section id="content" class="bg-color-white">
	<div class="container-fluid">
	  <div class="row-fluid">
	  	 <div class="span3">
	  	 	
	  	 	<?php echo PortletUserSearch::widget(array(
          		'maxResults'=>5,
      		)); ?>

      		<?php echo PortletContentSearch::widget(array(
          		'maxResults'=>5,
      		)); ?>  	 		

      		<?php echo TagCloud::widget(array(
		        'maxTags'=>Yii::$app->params['tagCloudCount'],
		    )); ?>
	  	 	
	  	 	<?php echo $this->blocks['sidebar']; ?>      
	  	 	
	    </div>
	    <div class="span7">
	      <?php echo $content; ?>
	    </div>
	    <div class="span2">	  	 		
	  	 	<?php echo $this->blocks['toolbar']; ?>
	    </div>
	  </div>	  
	</div>
</section>
<?php $this->endContent(); ?>
