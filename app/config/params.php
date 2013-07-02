<?php
return array(
	'adminEmail' => 'philipp.frenzel@myplace.eu',
	'mailerAlias' => 'MyPlace Intranet',
	'consoleBaseUrl' => 'http://lichtbruecken.at',
 	'tagCloudCount' => 10,
	'gbFiscalYearStart' => '-01-01', //the fiscal year start - most companys have the calendar year
	'gbHolidaySetting'=>array(
		'holdidaysPerYear'=>array(
			'AT'=>array(
				'2013' => 25
			),
			'DE'=>array(
				'2013' => 28
			)
		)
	),
	'mailconfig'=>array(
		'Host'     => 'smtp.1und1.de',
		'Username' => 'myplace-info@lichtbruecken.at',
		'Password' => 'myPlace1234'
	),
	//'gbHolidayManager' => 'gabriele.londer@myplace.eu',
	'gbHolidayManager' => 'philipp@frenzel.net',
);
