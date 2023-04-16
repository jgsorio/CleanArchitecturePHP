<?php

namespace Core\Infrastructure\Http\Controllers;

interface Presentation
{
    public function output(array $data): string;
}
