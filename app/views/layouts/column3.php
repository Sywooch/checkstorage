<?php

use app\widgets\PortletUserSearch;
use app\widgets\PortletContentSearch;
use app\widgets\TagCloud;

?>

<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<section id="content" class="bg-color-white">
	<div class="container">
	  <div class="row">
	  	 <div class="col-lg-3">
	  	 	
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
	    <div class="col-lg-7">
	      <?php echo $content; ?>
	    </div>
	    <div class="col-lg-2">	  	 		
	  	 	<?php echo $this->blocks['toolbar']; ?>
	    </div>
	  </div>	  
	</div>
</section>
<?php $this->endContent(); ?>
