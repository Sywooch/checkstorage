<?php

use yii\helpers\Html;

?>

<h3><i class="icon-book"></i> Inhaltsverzeichnis</h3>
<h4>Für Kunden</h4>

<ul>
	<li><a href="<?php echo Html::url(array('/site/page','view'=>'page_user_registration')); ?>">Anmeldung</a></li>
	<li><a href="<?php echo Html::url(array('/site/page','view'=>'page_bedarfssammler')); ?>">Bedarfssammler</a></li>
</ul>

<h4>Für Anbieter</h4>

<ul>
	<li><a href="<?php echo Html::url(array('/site/page','view'=>'page_storage_registration')); ?>">Anmeldung</a></li>	
	<li><a href="<?php echo Html::url(array('/site/page','view'=>'page_store_management')); ?>">Store Verwaltung</a></li>
	<li><a href="<?php echo Html::url(array('/site/page','view'=>'page_price_management')); ?>">Preis/Abteil Verwaltung</a></li>
	<li><a href="<?php echo Html::url(array('/site/page','view'=>'page_customer_management')); ?>">Kunden Verwaltung</a></li>
	<li><a href="<?php echo Html::url(array('/site/page','view'=>'page_contract_management')); ?>">Vertragsverwaltung</a></li>
	<li><a href="<?php echo Html::url(array('/site/page','view'=>'page_import')); ?>">Import Dokumentation</a></li>
</ul>