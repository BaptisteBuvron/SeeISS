<?php

namespace App\Entity;


use phpDocumentor\Reflection\Types\Integer;



class PasseDisplay extends Passe
{


    private string $date;
    private string $dateStart;
    private string $dateMax;
    private string $dateEnd;
    private string $timeZone;
    private string $dateStartExact;
    private string $azStartDirection;
    private string $azMaxDirection;
    private string $azEndDirection;


    /**
     * @param string $date
     * @param string $dateStart
     * @param string $dateMax
     * @param string $dateEnd
     * @param string $timeZone
     * @param string $dateStartExact
     * @param string $dateEndExact
     */
    public function __construct(int $index, float $UTCstart, float $UTCmax, float $UTCend, string $AzStartDegres, string $AzMaxDegres, string $AzEndDegres, float $magnitude, int $duration, array $detailsPasse, string $azStartDirection, string $azMaxDirection, string $azEndDirection, string $date, string $dateStart, string $dateMax, string $dateEnd, string $timeZone, string $dateStartExact)
    {
        parent::__construct( $index,  $UTCstart,  $UTCmax,  $UTCend,  $AzStartDegres,  $AzMaxDegres,  $AzEndDegres,  $magnitude,  $duration,  $detailsPasse);
        $this->azStartDirection = $azStartDirection;
        $this->azMaxDirection = $azMaxDirection;
        $this->azEndDirection = $azEndDirection;

        $this->date = $date;
        $this->dateStart = $dateStart;
        $this->dateMax = $dateMax;
        $this->dateEnd = $dateEnd;
        $this->timeZone = $timeZone;
        $this->dateStartExact = $dateStartExact;
    }


    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getDateStart(): string
    {
        return $this->dateStart;
    }

    /**
     * @param string $dateStart
     */
    public function setDateStart(string $dateStart): void
    {
        $this->dateStart = $dateStart;
    }

    /**
     * @return string
     */
    public function getDateMax(): string
    {
        return $this->dateMax;
    }

    /**
     * @param string $dateMax
     */
    public function setDateMax(string $dateMax): void
    {
        $this->dateMax = $dateMax;
    }

    /**
     * @return string
     */
    public function getDateEnd(): string
    {
        return $this->dateEnd;
    }

    /**
     * @param string $dateEnd
     */
    public function setDateEnd(string $dateEnd): void
    {
        $this->dateEnd = $dateEnd;
    }

    /**
     * @return string
     */
    public function getTimeZone(): string
    {
        return $this->timeZone;
    }

    /**
     * @param string $timeZone
     */
    public function setTimeZone(string $timeZone): void
    {
        $this->timeZone = $timeZone;
    }

    /**
     * @return string
     */
    public function getDateStartExact(): string
    {
        return $this->dateStartExact;
    }

    /**
     * @param string $dateStartExact
     */
    public function setDateStartExact(string $dateStartExact): void
    {
        $this->dateStartExact = $dateStartExact;
    }

    /**
     * @return string
     */
    public function getDateEndExact(): string
    {
        return $this->dateEndExact;
    }

    /**
     * @param string $dateEndExact
     */
    public function setDateEndExact(string $dateEndExact): void
    {
        $this->dateEndExact = $dateEndExact;
    }

    /**
     * @return string
     */
    public function getAzStartDirection(): string
    {
        return $this->azStartDirection;
    }

    /**
     * @param string $azStartDirection
     */
    public function setAzStartDirection(string $azStartDirection): void
    {
        $this->azStartDirection = $azStartDirection;
    }

    /**
     * @return string
     */
    public function getAzMaxDirection(): string
    {
        return $this->azMaxDirection;
    }

    /**
     * @param string $azMaxDirection
     */
    public function setAzMaxDirection(string $azMaxDirection): void
    {
        $this->azMaxDirection = $azMaxDirection;
    }

    /**
     * @return string
     */
    public function getAzEndDirection(): string
    {
        return $this->azEndDirection;
    }

    /**
     * @param string $azEndDirection
     */
    public function setAzEndDirection(string $azEndDirection): void
    {
        $this->azEndDirection = $azEndDirection;
    }







}
