<?php

namespace App\Entity;

class PasseDetails
{
    public float $lat;
    public  float $lon;


    /**
     * Km/second
     * @var float
     */
    public float $velo;

    /**
     * @param float $lat
     * @param float $lon
     */
    public function __construct(float $lat, float $lon)
    {
        $this->lat = $lat;
        $this->lon = $lon;
    }


}