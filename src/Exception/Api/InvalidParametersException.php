<?php


namespace App\Exception\Api;


use JetBrains\PhpStorm\Pure;
use Throwable;

class InvalidParametersException extends \Exception
{

    #[Pure] public function __construct($message = "")
    {
        parent::__construct($message);
    }
}