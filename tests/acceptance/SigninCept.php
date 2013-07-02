<?php
$I = new WebGuy($scenario);
$I->wantTo('log in as regular user');
$I->amOnPage('/index.php?r=site/login');
$I->fillField('loginform-username','pfrenzel');
$I->fillField('loginform-password','pfrenzel');
$I->click('Anmelden');
$I->see('pfrenzel');
