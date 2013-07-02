<h3>Arbeitszeiten Vorlagen erfassen</h3>
<p>
	Je nach Mitarbeiter, Standort und Zeitfenster, werden verschiedene Musterzeiten gelpant. So werden gerade
	und ungerade Wochen unterschieden, um bestimmte "Freizeiten" sicher zustellen. Der Urlaubsanspruch der Mitarbeiter
	wird dabei Wahlweise einmal in Tagen (Vollzeit) oder in Stunden (Teilzeit) ermittet.
</p>
<p>
	Nehmen wir an Frau X arbeitet an 3 Tagen in der Woche eben 4 Stunden und an einem weiteren 7 Stunden. So würden
	eben die ersten 3 Tage auch "nur" mit 4 Stunden zu buche fallen, wobei der 4. Tag eben mit 7 Stunden berechnet
	werden würde.
</p>
<p>
	Um diesen Anforderungen gerecht zu werden, muss für jeden Mitarbeiter eine Vorlage eines 2 Wochenplans
	erstellt werden. Dieser beinhaltet die tatsächlichen Arbeitstage einer exemplarischen "geraden" und "ungeraden" Woche
	sowie die genau festgelgten Arbeitsstunden pro Tag. In der Maske sieht es wie folgt aus:
</p>
<h3>Vorschau</h3>
<h4>Frau X arbeitend auf Kostenstelle AT999<small> Gültig ab: 01-05-2013</small></h4>
<p>Gerade Woche:</p>
<table class="table table-striped">
	<thead>
		<tr>
			<td>Wochentag</td>
			<td>Begin</td>
			<td>Ende</td>
			<td>Arbeitszeit</td>
		</tr>
	</thead>
	<tr>
		<td>Mo</td>
		<td>08:00</td>
		<td>12:00</td>
		<td>4:00</td>
	</tr>
	<tr>
		<td>Di</td>
		<td>08:00</td>
		<td>12:00</td>
		<td>4:00</td>
	</tr>
	<tr>
		<td>Mi</td>
		<td>08:00</td>
		<td>12:00</td>
		<td>4:00</td>
	</tr>
	<tr>
		<td>Do</td>
		<td>08:00</td>
		<td>12:00</td>
		<td>4:00</td>
	</tr>
	<tr>
		<td>Fr</td>
		<td>08:00</td>
		<td>12:00</td>
		<td>4:00</td>
	</tr>
	<tr>
		<td>Sa</td>
		<td>08:00</td>
		<td>12:00</td>
		<td>4:00</td>
	</tr>
</table>
<p>Ungerade Woche:</p>
<table class="table table-striped">
	<thead>
		<tr>
			<td>Wochentag</td>
			<td>Begin</td>
			<td>Ende</td>
			<td>Arbeitszeit</td>
		</tr>
	</thead>
	<tr>
		<td>Mo</td>
		<td>08:00</td>
		<td>12:00</td>
		<td>4:00</td>
	</tr>
	<tr>
		<td>Di</td>
		<td>08:00</td>
		<td>12:00</td>
		<td>4:00</td>
	</tr>
	<tr>
		<td>Mi</td>
		<td>08:00</td>
		<td>12:00</td>
		<td>4:00</td>
	</tr>
	<tr>
		<td>Do</td>
		<td>08:00</td>
		<td>12:00</td>
		<td>4:00</td>
	</tr>
	<tr>
		<td>Fr</td>
		<td>08:00</td>
		<td>12:00</td>
		<td>4:00</td>
	</tr>
	<tr>
		<td>Sa</td>
		<td>08:00</td>
		<td>12:00</td>
		<td>4:00</td>
	</tr>
</table>
<h3>Prozess Zusammenhang</h3>
<p>
	Wird also durch Frau X ein Zeitraum als Urlaub beantragt, so prüft das System jedes Detaildatum nach:
	<ol>
		<li>Befindet sich das Datum in einer geraden/ungeraden Woche?</li>
		<li>Handelt es sich um einen Feiertag?</li>
		<li>Wieviele Stunden müssen "gebucht" werden?</li>
	</ol>
	An Hand dieser Information werden dann die Einzelzeiten nach Tagen erfasst und als Vorschlag 
	für die Verwaltung eingestellt.
</p>
