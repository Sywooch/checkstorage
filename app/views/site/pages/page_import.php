<?php

use yii\helpers\Html;
use yii\widgets\Block;

?>


<?php Block::begin(array('id'=>'sidebar')); ?>
	
	<?php echo Yii::$app->controller->renderPartial('/site/pages/page_menu'); ?>

<?php Block::end(); ?>

<h1>Import Formate <small>CSV-Strukturen</small></h1>

<ul>
	<li>Standorte</li>
	<li>Preisliste</li>
</ul>

<h2>
	Standorte
</h2>
<h3>Schema</h3>
<table class="table stripped">
	<thead>
		<td>Feld</td>
		<td>Inhalt</td>
	</thead>
	<tbody>
		<tr>
			<td>Name</td>
			<td>Der Standortname für die externe Kommunikation</td>
		</tr>
		<tr>
			<td>Strasse</td>
			<td>Die Strasse, in der der Standort sich befindet. Je genauer desto besser (Hausnummer)</td>
		</tr>
		<tr>
			<td>Postleitzahl</td>
			<td>Die Postleitzahl in dem sich Ihr Standort befindet</td>
		</tr>
		<tr>
			<td>Stadt</td>
			<td>In welcher Stadt befindet sich Ihr Standort?</td>
		</tr>
		<tr>
			<td>Land</td>
			<td>In welchem Land befindet sich ihr Standort (2Letter ISO CODE)</td>
		</tr>
	</tbody>
</table>
<h2>
	Preisliste
</h2>
<h3>Schema</h3>
<table class="table stripped">
	<thead>
		<td>Feld</td>
		<td>Inhalt</td>
	</thead>
	<tbody>
		<tr>
			<td>Raumhöhe</td>
			<td>Die Höhe des Raumes in Metern</td>
		</tr>
		<tr>
			<td>Raumlänge</td>
			<td>Die Länge/Tiefe des Raumes in Metern</td>
		</tr>
		<tr>
			<td>Raumbreite</td>
			<td>Die Breite des Raumes in Metern</td>
		</tr>
		<tr>
			<td>Flächentyp</td>
			<td>Um was für eine Lagerfläche handelt es sich? Abteil(1), Garage(2), Container(3)</td>
		</tr>
		<tr>
			<td>Abrechnungsdauer</td>
			<td>Die Abrechnungsdauer? Täglich(0),Wöchentlich(1), 4 Wöchentlich(2), Monatlich(3)</td>
		</tr>
		<tr>
			<td>Preis für Dauer</td>
			<td>Wert mit 4 "Nachpunktstellen" -> 2.5000</td>
		</tr>
		<tr>
			<td>Größenschlüssel</td>
			<td>Wird vom System auf Basis von Länge und Breite des Abteils ermittelt.</td>
		</tr>
	</tbody>
</table>
<h3>Beispiel</h3>
<p>Bitte beachten Sie, dass der Satz ohne Kopfzeile angenommen wird!</p>
<code>
2.4,1.00,1.00,1,2,25.00,1
</code>
<p>&nbsp;</p>