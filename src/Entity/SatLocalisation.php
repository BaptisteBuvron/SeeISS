<?php

namespace App\Entity;

use ApiPlatform\Core\Action\NotFoundAction;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource(
    description: "Liste of localisations of a satellite from 1h30 before to 1h30 after the current time",
    collectionOperations: ['get' => [
        'method' => 'GET',
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
class SatLocalisation
{

    #[ApiProperty(identifier: true)]
    private string $name;
    private float $latitude;
    private float $longitude;
    #[ApiProperty(description: "Altitude of the satellite in km")]
    private float $altitude;
    #[ApiProperty(description: "Velocity of the satellite in km/h")]
    private float $velocity;
    #[ApiProperty(description: "Time in timestamp of the data")]
    private float $timestamp;
    #[ApiProperty(description: "Azimuth from the current position of the user")]
    private float $azimuth;
    private float $elevation;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     */
    public function setLatitude(float $latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     */
    public function setLongitude(float $longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * @return float
     */
    public function getAltitude(): float
    {
        return $this->altitude;
    }

    /**
     * @param float $altitude
     */
    public function setAltitude(float $altitude): void
    {
        $this->altitude = $altitude;
    }

    /**
     * @return float
     */
    public function getVelocity(): float
    {
        return $this->velocity;
    }

    /**
     * @param float $velocity
     */
    public function setVelocity(float $velocity): void
    {
        $this->velocity = $velocity;
    }

    /**
     * @return float
     */
    public function getTimestamp(): float
    {
        return $this->timestamp;
    }

    /**
     * @param float $timestamp
     */
    public function setTimestamp(float $timestamp): void
    {
        $this->timestamp = $timestamp;
    }

    /**
     * @return float
     */
    public function getAzimuth(): float
    {
        return $this->azimuth;
    }

    /**
     * @param float $azimuth
     */
    public function setAzimuth(float $azimuth): void
    {
        $this->azimuth = $azimuth;
    }

    /**
     * @return float
     */
    public function getElevation(): float
    {
        return $this->elevation;
    }

    /**
     * @param float $elevation
     */
    public function setElevation(float $elevation): void
    {
        $this->elevation = $elevation;
    }


}
