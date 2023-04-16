<?php

namespace Core\Application\Contracts;

use Core\Domain\Entities\Registration;

interface PdfExporter
{
    public function generate(Registration $registration): string;
}
