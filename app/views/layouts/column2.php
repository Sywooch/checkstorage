<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<section id="content">
  <div class="row-fluid">
  	 <div class="span3">
  	 	<div class="page-sidebar">	  	 		
  	 		<?php echo $this->blocks['sidebar']; ?>
  	 	</div>      
    </div>
    <div class="span9">
      <?php echo $content; ?>
    </div>
  </div>
</section>
<?php $this->endContent(); ?>
