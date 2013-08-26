<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<section id="content" class="bg-color-white">
	<div class="container">
	  <div class="row">
	  	 <div class="col-lg-3"> 	 		
	  	 	<?php echo $this->blocks['sidebar']; ?>
	    </div>
	    <div class="col-lg-9">
	      <?php echo $content; ?>
	    </div>
	  </div>
	</div>
</section>
<?php $this->endContent(); ?>
