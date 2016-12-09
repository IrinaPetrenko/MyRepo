<?php
/**
 * Created by PhpStorm.
 * User: irina.pentrenko
 * Date: 01/12/2016
 * Time: 16:40
 */

namespace Helper;


class FlightObject
{
    private $flightTimeToDestination;
    private $flightTimeToOrigin;
    private $priceForOne;

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }

        return $this;
    }
}