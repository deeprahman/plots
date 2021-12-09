<?php


namespace Plots\Exceptions;
use \Exception;

class AbstractException extends Exception
{
    public function __construct($message = null)
    {
        $message = $message?: 'Something Wrong!';
        parent::__construct($message);
    }
}