<?php

namespace Core\Domain\Entities;

use Core\Domain\ValueObjects\Email;
use Core\Domain\ValueObjects\RegistrationNumber;
use DateTimeInterface;

final class Registration
{
    public function __construct(
        public string $name,
        public Email $email,
        public RegistrationNumber $registrationNumber,
        public DateTimeInterface $birthDate,
        public DateTimeInterface $createdAt,
    ){}
}
