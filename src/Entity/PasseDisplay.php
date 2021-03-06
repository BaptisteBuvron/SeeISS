<?php

namespace App\Entity;


class PasseDisplay extends Passe
{


    private string $date;
    private string $dateStart;
    private string $dateMax;
    private string $dateEnd;
    private string $timeZone;
    private string $dateStartExact;


    /**
     * @param int $index
     * @param float $utcStart
     * @param float $utcMax
     * @param float $utcEnd
     * @param string $azStartDegres
     * @param string $azMaxDegres
     * @param string $azEndDegres
     * @param string $azStartDirection
     * @param string $azMaxDirection
     * @param string $azEndDirection
     * @param float $startEl
     * @param float $maxEl
     * @param float $endEl
     * @param float $magnitude
     * @param int $duration
     * @param array $detailsPasse
     * @param string $date
     * @param string $dateStart
     * @param string $dateMax
     * @param string $dateEnd
     * @param string $timeZone
     * @param string $dateStartExact
     */
    public function __construct(int $index, float $utcStart, float $utcMax, float $utcEnd, string $azStartDegres, string $azMaxDegres, string $azEndDegres, string $azStartDirection, string $azMaxDirection, string $azEndDirection, float $startEl, float $maxEl, float $endEl, float $magnitude, int $duration, array $detailsPasse, string $date, string $dateStart, string $dateMax, string $dateEnd, string $timeZone, string $dateStartExact)
    {
        parent::__construct($index, $utcStart, $utcMax, $utcEnd, $azStartDegres, $azMaxDegres, $azEndDegres, $azStartDirection, $azMaxDirection, $azEndDirection, $startEl, $maxEl, $endEl, $magnitude, $duration, $detailsPasse, $timeZone);
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


}
