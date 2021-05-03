<?php


namespace App\Predict;


/**
 * Geodetic position data structure.
 *
 */
class PredictGeodetic
{
    public $lat; /*!< Lattitude [rad] */
    public $lon; /*!< Longitude [rad] */
    public $alt; /*!< Altitude [km] */
    public $theta;
}
