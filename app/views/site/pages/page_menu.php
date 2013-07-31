<?php

use yii\helpers\Html;

?>

<h3><i class="icon-book"></i> InhaltsVZ</h3>
<h4>Für Kunden</h4>

<ul>
	<li><a href="<?php echo Html::url(array('/site/page','view'=>'page_user_registration')); ?>">Anmeldung</a></li>
	<li><a href="<?php echo Html::url(array('/site/page','view'=>'page_user_bedarfsammler')); ?>">Bedarfssammler</a></li>
</ul>

<h4>Für Anbieter</h4>

<ul>
	<li><a href="<?php echo Html::url(array('/site/page','view'=>'page_storage_registration')); ?>">Anmeldung</a></li>
	<li><a href="<?php echo Html::url(array('/site/page','view'=>'page_store_registration')); ?>">Mein Account</a></li>	
	<li><a href="<?php echo Html::url(array('/site/page','view'=>'page_store_management')); ?>">Lagerplätze verwalten</a></li>
	<li><a href="<?php echo Html::url(array('/site/page','view'=>'page_price_management')); ?>">Abteile verwalten</a></li>
	<li><a href="<?php echo Html::url(array('/site/page','view'=>'page_customer_management')); ?>">Kunden verwalten</a></li>
	<li><a href="<?php echo Html::url(array('/site/page','view'=>'page_contract_management')); ?>">Verträge verwalten</a></li>
	<li><a href="<?php echo Html::url(array('/site/page','view'=>'page_import')); ?>">Import Dokumentation</a></li>
</ul>