<?php

use yii\helpers\Html;
use yii\widgets\Block;

?>


<?php Block::begin(array('id'=>'sidebar')); ?>
	
	<?php echo Yii::$app->controller->renderPartial('/site/pages/page_menu'); ?>

<?php Block::end(); ?>

<h1>Dokumentation <small>Starten Sie hier!</small></h1>
<h2>
	Allgemeines
</h2>
<p>
	Die Dokumentation der Seite gliedert sich für die 2 Nutzerarten:
	<ul>
		<li>Kunden</li>
		<li>Anbieter</li>
	</ul>
	Im Rahmen der Transparenz für beide Seiten, sind alle Inhalte für jeden zugänglich, denn auch in Ihnen steckt sowohl
	ein Lagerraum Anbierter als auch ein Lagerraum Nutzer. Selfstorage ist auf Grund der steigenden Mobilität, sowie dem Wegfall
	von traditionellen Lagerflächen (Dachboden - immer öfter ausgebaut), Keller - Nuzung als Parkplatz, etc. immer attraktiver geworden.	
</p>
<h2>
	Leistungsübersicht/Mehrleistungen
</h2>
<p>
	Für die erweiterte Bewertung eines Anbieters nutzen wir die folgenden Kategorien:
	<ul>
		<li>Sicherheit</li>
		<ul>
			<li>Kameraüberwachung</li>
			<li>Zugangssicherheit</li>
			<li>Sicherheitsdienst</li>
			<li>Brandschutz/Brandmelder</li>
		</ul>
		<li>Verfügbarkeit</li>
		<ul>
			<li>Zugang zum Abteil</li>
			<li>Anprechpartner vor Ort</li>
		</ul>
		<li>Gebäudeinfos</li>
		<ul>
			<li>Aufzug</li>
			<li>Barrierefrei</li>
			<li>Aussenabteile</li>
			<li>Klima</li>
		</ul>
		<li>Zusatzleistungen</li>
		<ul>
			<li>Umzugshilfen</li>
			<li>Verpackungsmaterial vor Ort / Shop</li>
			<li>Musik im Gebäude</li>
		</ul>
	</ul>
</p>
