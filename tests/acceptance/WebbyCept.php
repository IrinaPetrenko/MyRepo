<?php
    use Page\mainPage as mainPage;
    use Page\searchResults as searchResults;

    $I = new AcceptanceTester($scenario);
    $I->wantTo("run SECOND test with user");
    $I->amOnPage("/");
    $mainPage = new mainPage($I);
    $searchResults=new searchResults($I);
    $mainPage->chooseOrigin("Kiev");
    $mainPage->chooseDestination("Berlin");
    $mainPage->selectCalendarDateFromNow("7");
    $mainPage->selectCalendarDateFromNow("14");
    $mainPage->selectNumberOfAdultPassangers(2);
    $mainPage->search();
    $searchResults->waitForEndOfSearch();
    $searchResults->getAllSearchResultData();
    $I->seeInTitle("momondo");


