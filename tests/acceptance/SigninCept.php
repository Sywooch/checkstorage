<?php
$I = new WebGuy($scenario);
$I->wantTo('log in as regular user');
$I->amOnPage('/index.php?r=site/login');
$I->fillField('loginform-username','admin');
$I->fillField('loginform-password','admin');
$I->click('Anmelden');
$I->see('admin');
