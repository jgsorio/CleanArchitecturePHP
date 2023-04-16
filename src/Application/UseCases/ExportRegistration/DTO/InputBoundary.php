<?php

namespace Core\Application\UseCases\ExportRegistration\DTO;

final class InputBoundary
{
    public function __construct(
        public string $registrationNumber,
        public string $fileName,
        public string $path
    ){}
}
