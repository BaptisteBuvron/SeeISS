<?php

namespace App\Entity;

use ApiPlatform\Core\Action\NotFoundAction;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use phpDocumentor\Reflection\Types\Integer;

#[ApiResource(
    description: "Return a list of all visible passes of the ISS",
    collectionOperations: ['get'=> [
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
    private string $date;
    private string $dateStart;
    private string $dateMax;
    private string $dateEnd;
    private string $azStart;
    private string $azMax;
    private string $azEnd;
    private string $azStartDegres;
    private string $azMaxDegres;
    private string $azEndDegres;
    private int $duration;
    private float $mag;
    private string $dateStartExact;
    private string $dateEndExact;
    private ?array $detailsPasseTotal;




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
    public function __construct(int $index, $date, $dateStart, $dateStartExact, $dateMax, $dateEnd, $dateEndExact, $azStart, $azMax, $azEnd, $azStartDegres, $azMaxDegres, $azEndDegres, $duration, $mag,  array $detailsPasseTotal = null)
    {
        $this->date = $date;
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
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getDateStart(): string
    {
        return $this->dateStart;
    }

    /**
     * @return string
     */
    public function getDateMax(): string
    {
        return $this->dateMax;
    }

    /**
     * @return string
     */
    public function getDateEnd(): string
    {
        return $this->dateEnd;
    }

    /**
     * @return string
     */
    public function getAzStart(): string
    {
        return $this->azStart;
    }

    /**
     * @return string
     */
    public function getAzMax(): string
    {
        return $this->azMax;
    }

    /**
     * @return string
     */
    public function getAzEnd(): string
    {
        return $this->azEnd;
    }

    /**
     * @return string
     */
    public function getAzStartDegres(): string
    {
        return $this->azStartDegres;
    }

    /**
     * @return string
     */
    public function getAzMaxDegres(): string
    {
        return $this->azMaxDegres;
    }

    /**
     * @return string
     */
    public function getAzEndDegres(): string
    {
        return $this->azEndDegres;
    }

    /**
     * @return integer
     */
    public function getDuration(): int
    {
        return $this->duration;
    }

    /**
     * @return float
     */
    public function getMag(): float
    {
        return $this->mag;
    }

    /**
     * @return string
     */
    public function getDateStartExact(): string
    {
        return $this->dateStartExact;
    }

    /**
     * @return string
     */
    public function getDateEndExact(): string
    {
        return $this->dateEndExact;
    }

    /**
     * @return array|null
     */
    public function getDetailsPasseTotal(): ?array
    {
        return $this->detailsPasseTotal;
    }

    /**
     * @return int
     */
    public function getIndex(): int
    {
        return $this->index;
    }


}
