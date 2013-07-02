<?php
$I = new WebGuy($scenario);
$I->wantTo('ensure that entry page works');
$I->amOnPage('/');
$I->see('Login');
