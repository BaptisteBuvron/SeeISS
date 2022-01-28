<?php

namespace App\Entity;


use ApiPlatform\Core\Action\NotFoundAction;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Predict\PredictVector;
use JetBrains\PhpStorm\ArrayShape;


#[ApiResource(
    description: "Return a list of all visible passes of the ISS",
    collectionOperations: ['get' => [
        "method" => "GET",
        "openapi_context" => [
            "parameters" => [
                [
                    "name" => "lat",
                    "in" => "query",
                    "description" => "Choose the latitude of passes. If incorrect value is given, it will be converted to 0. ",
                    "required" => true,
                    "type" => "float"
                ],
                [
                    "name" => "lon",
                    "in" => "query",
                    "description" => "Choose the longitude of passes  If incorrect value is given, it will be converted to 0.",
                    "required" => true,
                    "type" => "float"
                ],
                [
                    "name" => "day",
                    "in" => "query",
                    "description" => "How many day will be calculated ?",
                    "required" => false,
                    "type" => "integer"
                ],
                [
                    "name" => "lang",
                    "in" => "query",
                    "description" => "Choose the lang of the date",
                    "required" => false,
                    "type" => "string"
                ]
            ]
        ]
    ]],
    itemOperations: [
        'get' => [
            'controller' => NotFoundAction::class,
            'read' => false,
            'output' => false,
        ],
    ], paginationEnabled: false
)]
class Passe
{

    #[ApiProperty(identifier: true)]
    private int $index;
    private float $utcStart;
    private float $utcMax;
    private float $utcEnd;
    private string $azStartDegres;
    private string $azMaxDegres;
    private string $azEndDegres;
    private string $azStartDirection;
    private string $azMaxDirection;
    private string $azEndDirection;
    private float $startEl;
    private float $maxEl;
    private float $endEl;
    private float $magnitude;
    private int $duration;

    #[ArrayShape([
            "time",
            "pos" => PredictVector::class,
            "vel" => PredictVector::class,
            "velo",
            "az",
            "el",
            "range",
            "range_rate",
            "lat",
            "lon",
            "alt",
            "ma",
            "phase",
            "footprint",
            "vis",
            "orbit"
        ]
    )]
    private array $passeDetails;

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
     * @param array $passeDetails
     */
    public function __construct(int $index, float $utcStart, float $utcMax, float $utcEnd, string $azStartDegres, string $azMaxDegres, string $azEndDegres, string $azStartDirection, string $azMaxDirection, string $azEndDirection, float $startEl, float $maxEl, float $endEl, float $magnitude, int $duration, array $passeDetails)
    {
        $this->index = $index;
        $this->utcStart = $utcStart;
        $this->utcMax = $utcMax;
        $this->utcEnd = $utcEnd;
        $this->azStartDegres = $azStartDegres;
        $this->azMaxDegres = $azMaxDegres;
        $this->azEndDegres = $azEndDegres;
        $this->startEl = $startEl;
        $this->maxEl = $maxEl;
        $this->endEl = $endEl;
        $this->magnitude = $magnitude;
        $this->duration = $duration;
        $this->passeDetails = $passeDetails;
        $this->azStartDirection = $azStartDirection;
        $this->azMaxDirection = $azMaxDirection;
        $this->azEndDirection = $azEndDirection;
    }


    /**
     * @return int
     */
    public function getIndex(): int
    {
        return $this->index;
    }

    /**
     * @param int $index
     */
    public function setIndex(int $index): void
    {
        $this->index = $index;
    }

    /**
     * @return float
     */
    public function getUtcStart(): float
    {
        return $this->utcStart;
    }

    /**
     * @param float $utcStart
     */
    public function setUtcStart(float $utcStart): void
    {
        $this->utcStart = $utcStart;
    }

    /**
     * @return float
     */
    public function getUtcMax(): float
    {
        return $this->utcMax;
    }

    /**
     * @param float $utcMax
     */
    public function setUtcMax(float $utcMax): void
    {
        $this->utcMax = $utcMax;
    }

    /**
     * @return float
     */
    public function getUtcEnd(): float
    {
        return $this->utcEnd;
    }

    /**
     * @param float $utcEnd
     */
    public function setUtcEnd(float $utcEnd): void
    {
        $this->utcEnd = $utcEnd;
    }

    /**
     * @return string
     */
    public function getAzStartDegres(): string
    {
        return $this->azStartDegres;
    }

    /**
     * @param string $azStartDegres
     */
    public function setAzStartDegres(string $azStartDegres): void
    {
        $this->azStartDegres = $azStartDegres;
    }

    /**
     * @return string
     */
    public function getAzMaxDegres(): string
    {
        return $this->azMaxDegres;
    }

    /**
     * @param string $azMaxDegres
     */
    public function setAzMaxDegres(string $azMaxDegres): void
    {
        $this->azMaxDegres = $azMaxDegres;
    }

    /**
     * @return string
     */
    public function getAzEndDegres(): string
    {
        return $this->azEndDegres;
    }

    /**
     * @param string $azEndDegres
     */
    public function setAzEndDegres(string $azEndDegres): void
    {
        $this->azEndDegres = $azEndDegres;
    }

    /**
     * @return float
     */
    public function getMagnitude(): float
    {
        return $this->magnitude;
    }

    /**
     * @param float $magnitude
     */
    public function setMagnitude(float $magnitude): void
    {
        $this->magnitude = $magnitude;
    }

    /**
     * @return int
     */
    public function getDuration(): int
    {
        return $this->duration;
    }

    /**
     * @param int $duration
     */
    public function setDuration(int $duration): void
    {
        $this->duration = $duration;
    }

    /**
     * @return array
     */
    public function getPasseDetails(): array
    {
        return $this->passeDetails;
    }

    /**
     * @param array $passeDetails
     */
    public function setPasseDetails(array $passeDetails): void
    {
        $this->passeDetails = $passeDetails;
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

    /**
     * @return float
     */
    public function getStartEl(): float
    {
        return $this->startEl;
    }

    /**
     * @param float $startEl
     */
    public function setStartEl(float $startEl): void
    {
        $this->startEl = $startEl;
    }

    /**
     * @return float
     */
    public function getMaxEl(): float
    {
        return $this->maxEl;
    }

    /**
     * @param float $maxEl
     */
    public function setMaxEl(float $maxEl): void
    {
        $this->maxEl = $maxEl;
    }

    /**
     * @return float
     */
    public function getEndEl(): float
    {
        return $this->endEl;
    }

    /**
     * @param float $endEl
     */
    public function setEndEl(float $endEl): void
    {
        $this->endEl = $endEl;
    }


}