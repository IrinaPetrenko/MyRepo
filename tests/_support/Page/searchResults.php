<?php
/**
 * Created by PhpStorm.
 * User: irina.pentrenko
 * Date: 01/12/2016
 * Time: 16:46
 */

namespace Page;
use Helper\DateHelper;
use Helper\FlightObject;


class searchResults
{
    private static $allSearchResults = ['xpath'=>"//*[@class='result-box-inner']"];
    private static $allSearchResultDetails = ['xpath'=>"//*[@class='result-details']"];
    private static $allSearchResultTicketsInfo = ['xpath'=>"//*[@class='ticketinfo']"];
    private static $searchProgressText = ['xpath'=>"//*[@id='searchProgressText']"];
    private static $flightLenghtToDestination = ['xpath'=>"//*[@class=\"segment segment0\"]/div[@class=\"segment-inner\"]/div[@class=\"duration\"]/div[@class=\"travel-time\"]"];
    private static $flightLenghtToOrigin = ['xpath'=>"//*[@class=\"segment segment1\"]/div[@class=\"segment-inner\"]/div[@class=\"duration\"]/div[@class=\"travel-time\"]"];
    private static $flightPricePerOne = ['xpath'=>"//*[@class='ticketinfo']/div/div[@class=\"floater\"]/div[@class=\"prices\"]/div[@class=\"price-pax\"]/*/span[@class=\"value\"]"];


    protected $tester;
    private $helper;

    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I;
        $this->helper = new DateHelper();
    }

    public function getAllSearchResultData(){
        $I=$this->tester;

        $flightOptions=array();
        $searchResults = $I->grabMultiple(self::$allSearchResults);
        $flightsLengthToDestination = $I->grabMultiple(self::$flightLenghtToDestination);
        $flightsLengthToOrigin = $I->grabMultiple(self::$flightLenghtToOrigin);
        $flightsPrice = $I->grabMultiple(self::$flightPricePerOne);

        for($i=0;$i<count($searchResults)-1;$i++){
            $fly = new FlightObject();
            $fly->flightTimeToDestination=$this->convertTextTime($flightsLengthToDestination[$i]);
            $fly->flightTimeToOrigin=$this->convertTextTime($flightsLengthToOrigin[$i]);
            $fly->priceForOne=$flightsPrice[$i];
            $flightOptions[]=$fly;

            print "OBJECT ".$i."--------------------"."\n";
            print $fly->flightTimeToDestination."\n";
            print $fly->flightTimeToOrigin."\n";
            print $fly->priceForOne."\n";
        }
    }

    public function waitForEndOfSearch(){
        $I=$this->tester;

        $n=0;
        while ($n<12 && $I->grabTextFrom(self::$searchProgressText)!="Пошук завершено"){
            sleep(1);
            $n++;
        }

    }

    private function convertTextTime($initialStr){
        $convertedString = mb_convert_encoding($initialStr, "Windows-1251", "utf-8");
        $resultingString=str_replace(' ','',substr($convertedString,0,strlen($convertedString)-2));
        $finalRes = preg_replace('/[^0-9]/s','.',$resultingString);
        return $finalRes;


    }

}