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
