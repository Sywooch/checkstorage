<?php
use yii\helpers\Html;
use yii\widgets\Block;
?>

<?php Block::begin(array('id'=>'sidebar')); ?>
	<ul>
		<li class="sticker sticker-color-blue"><a><i class="icon-spades"></i>Technology</a></li>
		<li class="sticker sticker-color-green"><a><i class="icon-clubs"></i>Success Stories</a></li>
	</ul>
<?php Block::end(); ?>

<section id="content">
	<h1>Web Coding <small>We build your Toolbox!</small></h1>
	<ul class="accordion" data-role="accordion">
		<li class="active">
			<a href="#"> Technology </a>
			<div> ...content... </div>
		</li>
		<li>
			<a href="#"> Success Stories </a>
			<div> ...content... </div>
		</li>
	</ul>
</section>