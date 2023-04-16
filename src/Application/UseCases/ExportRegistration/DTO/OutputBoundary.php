<?php

namespace Core\Application\UseCases\ExportRegistration\DTO;

final class OutputBoundary
{
    public function __construct(
        public string $fullFileName
    ){}
}
