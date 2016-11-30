<?php
/**
 * Created by PhpStorm.
 * User: irina
 * Date: 11/23/16
 * Time: 8:47 PM
 */

namespace Helper;


class DateHelper
{
    public static function getNew(){
    return new static;
}

    public function returnCorrectMonthForDatePeacker($initialMonth){
        switch ($initialMonth) {
            case "11":
                return "12";
                break;
            case "12":
                return "01";
                break;
            default:
                return "No such month";
        }
    }
    public function returnCorrectMonthForXpathDatePeacker($initialMonth){
        switch ($initialMonth) {
            case "12":
                return "11";
                break;
            case "01":
                return "12";
                break;
            default:
                return "No such month";
        }
    }
}