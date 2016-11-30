<?php
use Page\mainPage as mainPage;

$I = new AcceptanceTester($scenario);
$I->wantTo("open momondo page and search for flights");
$I->amOnPage("/");
$mainPage = new mainPage($I);
//$mainPage->chooseOrigin("Kiev");
//$mainPage->chooseDestination("Berlin");
//$mainPage->selectCalendarDate("7");
//$mainPage->selectCalendarDate("14");
$mainPage->selectNumberOfPassangers();
//$mainPage->search();
$I->seeInTitle("momondo");
