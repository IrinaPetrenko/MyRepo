<?php
$I= new WebGuy($scenario);
$I->wantTo("open momondo page");
$I->amOnPage("/");
$I->seeInTitle("momondo");

/**
 * Created by PhpStorm.
 * User: irina
 * Date: 11/18/16
 * Time: 4:07 PM
 */
?>