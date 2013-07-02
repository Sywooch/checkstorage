<?php
use yii\helpers\Html;
use yii\widgets\Block;
?>

<?php Block::begin(array('id'=>'sidebar')); ?>
	<ul>
		<li class="sticker sticker-color-blue"><a><i class="icon-diamonds"></i>Corporate Planning</a></li>
		<li class="sticker sticker-color-blue"><a><i class="icon-spades"></i>Technology</a></li>
		<li class="sticker sticker-color-green"><a><i class="icon-clubs"></i>Success Stories</a></li>
	</ul>
<?php Block::end(); ?>

<section id="content">
	<h1>Corporate Planning <small>ROLAP for smb's!</small></h1>
	
	<div class="row-fluid">
		<div class="span12">
			<div class="carousel" data-role="carousel">
				<div class="slides" style="height: 200px;">
					<div class="slide image" id="slide1">
						<img src="http://lorempixel.com/715/200/fashion/"/>
						<div class="description">
							Webbased corporate planning
						</div>
					</div>
		 
					<div class="slide mixed" id="slide2">
						<img src="http://lorempixel.com/715/200/cats/"/>
						<div class="description">
							Amazing responsive design and functionality
						</div>
					</div>
				</div>
				<span class="control left">‹</span>
				<span class="control right">›</span> 
			</div>
		</div>
	</div>
	
	<ul class="accordion" data-role="accordion">
		<li class="active">
			<a href="#"> Corporate Planning </a>
			<div>
				<h3>Why you should plan your business?</h3>
				<p>
					To guide a company successful is often a challenging competition. Planlogiq supports you within the following
					steps: <b>operative planning</b>, <b>strategical planning</b> and with the help of our amazing tool qlikview to
					<b>analyse actuals vs. plan</b>.
				</p>
				<p>
					Not every company has the same needs for budgeting and forecasting. Nevertheless, planlogiq is a amazing toolbox
					which allows you (with the support of one of our consultants) to build the supporting tool you need! Define your
					own <b>businesslogics</b> (e.g. calculations formulas for revenue) - implement your company structure and build the
					reports you need.
				</p>
				<p>
					As planlogiq is webbased it supports decentralised companies to collect budgets.
				</p>
			</div>
		</li>
		<li>
			<a href="#"> Technology </a>
			<div>
				<h3>History<small>Release 1</small></h3>
				<p>Everything started around 2006, when the first prototype of our webbased corporate planning suite
					<b>planlogiq</b> turned to live using:</p>
				<p>
					<ul>
						<li>Prado - PradoSoft.com</li>
					</ul>
				</p>
				<p>
					1.5 years later we upgraded the frontend with the usage of:
				</p>
				<p>
					<ul>
						<li>DHTMLX - dhtmlx.com (version 2.3)</li>
					</ul>
				</p>
				<p>
					Which delivered a rich dynamic webbased user frontend. In the background we still got Prado running.
				</p>
				<h3>The next step<small>Release 2</small></h3>
				<p>
					As our solutios grew up and more and more customers asked for better performance 2011 we decided to head
					on to a new framework and backendsolution. We knew that the afford to switch to a new platform
					is like a complete rewrite (it was;)) so the advantage must be hardly measurable! As the frontend with
					dhtmlx worked fine and our supplier provided us and others with stable and performance increasing features
					we decided to keep it!
				</p>
				<p>
					After checking and evaluating more than 5 php frameworks, we decided to switch to yii 1.0. Based upon several
					speedtests and the stable api we choose them!
				</p>
				<p>
					<ul>
						<li>Yii 1.0 - yiiframework.com</li>
						<li>DHTMLX - dhtmlx.com (version 3.4)</li>
					</ul>
				</p>

			</div>
		</li>
		<li>
			<a href="#"> Success Stories </a>
			<div> ...content... </div>
		</li>
	</ul>
</section>