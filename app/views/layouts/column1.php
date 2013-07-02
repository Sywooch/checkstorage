<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<section id="content" class="bg-color-white">
	<div class="container-fluid">
		<div class="row-fluid">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
</section>
<?php $this->endContent(); ?>