<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<section id="content">
  <div class="row">
  	 <div class="col-lg-3">
  	 	<div class="page-sidebar">	  	 		
  	 		<?php echo $this->blocks['sidebar']; ?>
  	 	</div>      
    </div>
    <div class="col-lg-9">
      <?php echo $content; ?>
    </div>
  </div>
</section>
<?php $this->endContent(); ?>
