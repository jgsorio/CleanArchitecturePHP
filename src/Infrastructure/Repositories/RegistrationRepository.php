<?php

namespace Core\Infrastructure\Repositories;

use Core\Domain\Entities\Registration;
use Core\Domain\Exceptions\RegistrationNotFoundException;
use Core\Domain\Repositories\LoadRegistrationRepository;
use Core\Domain\ValueObjects\Email;
use Core\Domain\ValueObjects\RegistrationNumber;
use DateTimeImmutable;
use PDO;

final class RegistrationRepository implements LoadRegistrationRepository
{
    public function __construct(protected PDO $pdo){}

    public function loadByRegistrationNumber(RegistrationNumber $registrationNumber): Registration
    {
        $statement = $this->pdo->prepare('SELECT * FROM `registrations` WHERE `cpf` = :cpf');
        $statement->execute([':cpf' => $registrationNumber->registrationNumber]);
        $record = $statement->fetch();

        if (!$record) {
            throw new RegistrationNotFoundException($registrationNumber);
        }

        return new Registration(
            name: $record->name,
            email: new Email($record->email),
            registrationNumber: new RegistrationNumber($record->cpf),
            birthDate: new DateTimeImmutable($record->birth_date),
            createdAt: new DateTimeImmutable($record->created_at)
        );
    }
}
