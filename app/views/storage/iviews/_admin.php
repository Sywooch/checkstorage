<?php

use \yii\helpers\Html;

?>
<div class="row-fluid tile">
	<div class="span3">
		<img src='img/flags_iso/24/<?php echo strtolower($item->country);?>.png'></img><?php echo Html::a(Html::encode($item->name), $item->url);?>
	</div>
	<div class="span5">
		<?php echo $item->address;?><br>
		<i class="icon-phone"></i> <?php echo $item->phone;?><br>
		<i class="icon-envelope"></i> <?php echo $item->mail;?>
	</div>
	<div class="span2">
		<?php echo $item->zipcode;?> <?php echo $item->city;?>
	</div>
	<div class="span2">
		<i class="icon-book"></i> 
		<?php
			echo Html::a('verwalten', array("dashboard", "id"=>$item->id), array('class'=>'dashboard'));
		?><br>
		<i class="icon-pencil"></i> 
		<?php
			echo Html::a('bearbeiten', array("update", "id"=>$item->id), array('class' => 'edit')); 
		?><br>
		<i class="icon-remove"></i> 
		<?php
			echo Html::a('entfernen', array("softdelete", "id"=>$item->id), array('class'=>'delete'));
		?>
	</div>
</div>
