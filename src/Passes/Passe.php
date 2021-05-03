<?php

namespace App\Passes;

class Passe
{

    public $dateStart;
    public $dateMax;
    public $dateEnd;
    public $azStart;
    public $azMax;
    public $azEnd;
    public $azStartDegres;
    public $azMaxDegres;
    public $azEndDegres;
    public $duration;
    public $mag;
    public $dateStartExact;
    public $dateEndExact;
    public $detailsPasseTotal;
    public $index;


    /**
     * Passe constructor. Create a passe
     * @param $dateStart
     * @param $dateStartExact
     * @param $dateMax
     * @param $dateEnd
     * @param $dateEndExact
     * @param $azStart
     * @param $azMax
     * @param $azEnd
     * @param $azStartDegres
     * @param $azMaxDegres
     * @param $azEndDegres
     * @param $duration //Duration in seconds
     * @param $mag
     */
    public function __construct($dateStart, $dateStartExact, $dateMax, $dateEnd, $dateEndExact, $azStart, $azMax, $azEnd, $azStartDegres, $azMaxDegres, $azEndDegres, $duration, $mag, $detailsPasseTotal = null, $index = null)
    {
        $this->dateStart = $dateStart;
        $this->dateStartExact = $dateStartExact;
        $this->dateMax = $dateMax;
        $this->dateEnd = $dateEnd;
        $this->dateEndExact = $dateEndExact;
        $this->azStart = $azStart;
        $this->azMax = $azMax;
        $this->azEnd = $azEnd;
        $this->azStartDegres = $azStartDegres;
        $this->azMaxDegres = $azMaxDegres;
        $this->azEndDegres = $azEndDegres;
        $this->duration = $duration;
        $this->mag = $mag;

        $this->detailsPasseTotal = $detailsPasseTotal;
        $this->index = $index;
    }

    /**
     * @return mixed
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * @return mixed
     */
    public function getDateMax()
    {
        return $this->dateMax;
    }


    /**
     * @return mixed
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * @return mixed
     */
    public function getAzStart()
    {
        return $this->azStart;
    }

    /**
     * @return mixed
     */
    public function getAzMax()
    {
        return $this->azMax;
    }

    /**
     * @return mixed
     */
    public function getAzEnd()
    {
        return $this->azEnd;
    }

    /**
     * @return mixed
     */
    public function getAzStartDegres()
    {
        return $this->azStartDegres;
    }

    /**
     * @return mixed
     */
    public function getAzMaxDegres()
    {
        return $this->azMaxDegres;
    }

    /**
     * @return mixed
     */
    public function getAzEndDegres()
    {
        return $this->azEndDegres;
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @return mixed
     */
    public function getMag()
    {
        return $this->mag;
    }

    /**
     * @return mixed
     */
    public function getDateStartExact()
    {
        return $this->dateStartExact;
    }

    /**
     * @return mixed
     */
    public function getDateEndExact()
    {
        return $this->dateEndExact;
    }

    /**
     * @return mixed
     */
    public function getDetailsPasseTotal()
    {
        return $this->detailsPasseTotal;
    }

    /**
     * @return mixed
     */
    public function getIndex()
    {
        return $this->index;
    }
}
