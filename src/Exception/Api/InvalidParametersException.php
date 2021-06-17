<?php


namespace App\Exception\Api;


use Throwable;

class InvalidParametersException extends \Exception
{

    public function __construct($message = "")
    {
        parent::__construct($message);
    }
}