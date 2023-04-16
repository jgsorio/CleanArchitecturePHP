<?php

namespace Core\Domain\Exceptions;

use Core\Domain\ValueObjects\RegistrationNumber;
use Exception;
use Throwable;

class RegistrationNotFoundException extends Exception
{
    public function __construct(RegistrationNumber $registrationNumber, int $code = 0, Throwable $previous = null)
    {
        $message = "{$registrationNumber->registrationNumber} not found";
        parent::__construct($message, $code, $previous);
    }
}
