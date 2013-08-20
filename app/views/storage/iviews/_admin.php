<?php

use \yii\helpers\Html;

?>
<div class="row tile <?php echo ++$index%2==0?'bg-color-blue2':'bg-color-white'?>">
	<div class="col-lg-3">
		&nbsp;<img src='img/flags_iso/24/<?php echo strtolower($model->country);?>.png'></img>&nbsp;<?php echo Html::a(Html::encode($model->name), $model->url);?>
	</div>
	<div class="col-lg-5">
		<?php echo $model->address;?><br>
		<i class="icon-phone"></i> <?php echo $model->phone;?><br>
		<i class="icon-envelope"></i> <?php echo $model->mail;?>
	</div>
	<div class="col-lg-2">
		<?php echo $model->zipcode;?> <?php echo $model->city;?>
	</div>
	<div class="col-lg-2">
		<i class="icon-book"></i> 
		<?php
			echo Html::a('verwalten', array("dashboard", "id"=>$model->id), array('class'=>'dashboard'));
		?><br>
		<i class="icon-pencil"></i> 
		<?php
			echo Html::a('bearbeiten', array("update", "id"=>$model->id), array('class' => 'edit')); 
		?><br>
		<i class="icon-remove"></i> 
		<?php
			echo Html::a('entfernen', array("softdelete", "id"=>$model->id), array('class'=>'delete'));
		?>
	</div>
</div>
