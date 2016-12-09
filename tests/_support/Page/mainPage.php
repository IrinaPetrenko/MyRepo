<?php
namespace Page;

use Faker\Provider\cs_CZ\DateTime;
use Helper\DateHelper;
use SebastianBergmann\GlobalState\RuntimeException;

class mainPage
{
    // include url of current page
    public static $URL = '';


    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: Page\Edit::route('/123-post');
     */
    public static $origin = ['xpath' => "//*[@id='Content_ctl04_SearchFormv8_SearchFormFlight_InputOrigin']"];
    private static $destination =['xpath' => "//*[@id='Content_ctl04_SearchFormv8_SearchFormFlight_InputDestination']"];
    private static $departureDate=['xpath'=>"(//*[@class='input _date-depart'])[1]/div[@class='ui-calendar']/span"];
    private static $flighBackDate='.//*[@id=\'Content_ctl04_SearchFormv8_SearchFormFlight_InputReturn\']';
    private static $passangers = ['xpath'=>"//*[@class='input _passengers']/div/span"];
    private static $addPassangerButton = ['xpath'=>"//*[@id='ui-id-7-adults-total']/../a[1]/span"];
    private static $selectedNumberOfPassangers = ['xpath'=>"//*[@class='input _passengers']/div/span"];
    private static $selectedNumberOfAdults = ['xpath'=>"//*[@id='ui-id-7-adults-total']"];
    private static $search = ['xpath'=>"//*[@class='submit submit--desktop']/span"];
    private static $allAirportsOrigin=['xpath' => "//*[@id='ui-id-1']/li[1]"];
    private static $allAirportsDestination=['xpath' => "//*[@id='ui-id-2']/li[2]"];
    private static $preselectedDate=['xpath'=>"//*[@id='ui-datepicker-div']/table/tbody/tr/td[contains(@class,'day')]"];
    private static $preselectedDay=['xpath'=>"//*[@id='ui-datepicker-div']/table/tbody/tr/td[contains(@class,'day')]/a"];
    private static $previousMonthButton=['xpath'=>".//*[@class=\"ui-datepicker-header ui-widget-header ui-helper-clearfix ui-corner-all\"]/a[1]"];

    protected $tester;
    private $helper;

    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I;
        $this->helper = new DateHelper();
    }

    public function chooseOrigin($originCity){
        $I=$this->tester;

        $I->amOnPage(self::$URL);
        $I->click(self::$origin);
        $I->fillField(self::$origin,$originCity);
        $I->seeInField(self::$origin,$originCity);
        $I->waitForElementVisible(self::$allAirportsOrigin,5);
        $I->click(self::$allAirportsOrigin);
        return $this;
    }

    public function chooseDestination($destinationCity){
        $I=$this->tester;

        $I->click(self::$destination);
        $I->fillField(self::$destination,$destinationCity);
        $I->seeInField(self::$destination,$destinationCity);
        $this->waitForDestinationSearchResult();
        $I->waitForElementVisible(self::$allAirportsDestination,5);
        $I->click(self::$allAirportsDestination);
        $I->seeInField(self::$destination,"Берлін (BER), Німеччина");
        sleep(10);
        return $this;

    }

    public function selectCalendarDateFromNow($daysFromNow){
        $I=$this->tester;

        $selectMonth = date("m",strtotime("+{$daysFromNow} day"));
        $selectDay = date("j",strtotime("+{$daysFromNow} day"));

        $monthToSelect = $this->helper->returnCorrectMonthForXpathDatePeacker($selectMonth);
        $newDateSelector = ['xpath'=>"//*[@id='ui-datepicker-div']/table/tbody/tr/td[@data-month='{$monthToSelect}']/a[text()='{$selectDay}']"];

        $searchRes = $I->grabMultiple($newDateSelector);
        if(count($searchRes)==0){
            $I->click(self::$previousMonthButton);
            $I->click($newDateSelector);
        }
        else{
            $I->click($newDateSelector);
        }
    }

    public function selectNumberOfAdultPassangers($numberOfAdults){
        $I=$this->tester;

        $I->click(self::$passangers);
        $I->waitForElementVisible(self::$addPassangerButton);
        while  (($I->grabAttributeFrom(self::$selectedNumberOfAdults,'aria-valuenow'))<$numberOfAdults)   {
            $I->click(self::$addPassangerButton);
        }
    }

    public function search(){
        $I=$this->tester;

        $I->click(self::$search);
        sleep(0);
    }

    private function waitForDestinationSearchResult(){
        $I=$this->tester;
        $n=0;
        while ($n<5 && count($I->grabMultiple("//*[@id='ui-id-2']/li"))==2){
            sleep(1);
            $n++;
        }
    }

    private function getPreselectedDate(){
        $I=$this->tester;

        $preselectedYear=$I->grabAttributeFrom(self::$preselectedDate,'data-year');
        $preselectedMonth=$this->helper->returnCorrectMonthForDatePeacker($I->grabAttributeFrom(self::$preselectedDate,'data-month'));
        //another way to get correct month
        //$preselectedMonth=(new DateHelper())->returnCorrectMothForDatePeacker($I->grabAttributeFrom(self::$currentDate,'data-month'));
        $preselectedDay=$I->grabTextFrom(self::$preselectedDay);
        $date = new \DateTime($preselectedYear.'-'.$preselectedMonth.'-'.$preselectedDay);
        $preselectedDate=$date->format('Y-m-d');
    }


}
