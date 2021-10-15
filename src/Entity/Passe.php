<?php

namespace App\Entity;



use ApiPlatform\Core\Action\NotFoundAction;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;


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
    private float $UTCstart;
    private float $UTCmax;
    private float $UTCend;
    private string $AzStartDegres;
    private string $AzMaxDegres;
    private string $AzEndDegres;
    private float $magnitude;
    private int $duration;
    private array $PasseDetails;

    /**
     * @param int $index
     * @param float $UTCstart
     * @param float $UTCmax
     * @param float $UTCend
     * @param string $AzStartDegres
     * @param string $AzMaxDegres
     * @param string $AzEndDegres
     * @param float $magnitude
     * @param int $duration
     * @param array $passeDetails
     */
    public function __construct(int $index, float $UTCstart, float $UTCmax, float $UTCend, string $AzStartDegres, string $AzMaxDegres, string $AzEndDegres, float $magnitude, int $duration, array $passeDetails)
    {
        $this->index = $index;
        $this->UTCstart = $UTCstart;
        $this->UTCmax = $UTCmax;
        $this->UTCend = $UTCend;
        $this->AzStartDegres = $AzStartDegres;
        $this->AzMaxDegres = $AzMaxDegres;
        $this->AzEndDegres = $AzEndDegres;
        $this->magnitude = $magnitude;
        $this->duration = $duration;
        $this->PasseDetails = $passeDetails;
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
    public function getUTCstart(): float
    {
        return $this->UTCstart;
    }

    /**
     * @param float $UTCstart
     */
    public function setUTCstart(float $UTCstart): void
    {
        $this->UTCstart = $UTCstart;
    }

    /**
     * @return float
     */
    public function getUTCmax(): float
    {
        return $this->UTCmax;
    }

    /**
     * @param float $UTCmax
     */
    public function setUTCmax(float $UTCmax): void
    {
        $this->UTCmax = $UTCmax;
    }

    /**
     * @return float
     */
    public function getUTCend(): float
    {
        return $this->UTCend;
    }

    /**
     * @param float $UTCend
     */
    public function setUTCend(float $UTCend): void
    {
        $this->UTCend = $UTCend;
    }

    /**
     * @return string
     */
    public function getAzStartDegres(): string
    {
        return $this->AzStartDegres;
    }

    /**
     * @param string $AzStartDegres
     */
    public function setAzStartDegres(string $AzStartDegres): void
    {
        $this->AzStartDegres = $AzStartDegres;
    }

    /**
     * @return string
     */
    public function getAzMaxDegres(): string
    {
        return $this->AzMaxDegres;
    }

    /**
     * @param string $AzMaxDegres
     */
    public function setAzMaxDegres(string $AzMaxDegres): void
    {
        $this->AzMaxDegres = $AzMaxDegres;
    }

    /**
     * @return string
     */
    public function getAzEndDegres(): string
    {
        return $this->AzEndDegres;
    }

    /**
     * @param string $AzEndDegres
     */
    public function setAzEndDegres(string $AzEndDegres): void
    {
        $this->AzEndDegres = $AzEndDegres;
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
        return $this->PasseDetails;
    }

    /**
     * @param array $PasseDetails
     */
    public function setPasseDetails(array $PasseDetails): void
    {
        $this->PasseDetails = $PasseDetails;
    }





}