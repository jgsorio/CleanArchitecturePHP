<?php

namespace Core\Infrastructure\Presentation;

use Core\Infrastructure\Http\Controllers\Presentation;

final class ExportRegistrationPresentation implements Presentation
{
    public function output(array $data): string
    {
        return json_encode($data);
    }
}
