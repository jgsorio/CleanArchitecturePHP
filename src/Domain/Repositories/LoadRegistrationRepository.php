<?php

namespace Core\Domain\Repositories;

use Core\Domain\Entities\Registration;
use Core\Domain\ValueObjects\RegistrationNumber;

interface LoadRegistrationRepository
{
    public function loadByRegistrationNumber(RegistrationNumber $registrationNumber): Registration;
}
