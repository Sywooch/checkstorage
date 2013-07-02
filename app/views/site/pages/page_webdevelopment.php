<?php
use yii\helpers\Html;
use yii\widgets\Block;
?>

<?php Block::begin(array('id'=>'sidebar')); ?>
	<ul>
		<li class="sticker sticker-color-blue"><a><i class="icon-spades"></i>Bootsrap</a></li>
		<li class="sticker sticker-color-green"><a><i class="icon-clubs"></i>MetroUI</a></li>
		<li class="sticker sticker-color-yellow"><a><i class="icon-diamonds"></i>Custom</a></li>
	</ul>
<?php Block::end(); ?>

<section id="content">
	<h1>Web Design <small>Pimp your page!</small></h1>
	<p>
		We rock your web!
	</p>
	<h2>Bootstrap</h2>
	<p>
		Lorem ispum dolorem...
	</p>
	<h2>Metro UI</h2>
	<p>
		Lorem ispum dolorem...
	</p>
	<h2>Custom</h2>
	<p>
		Lorem ispum dolorem...
	</p>
</section>