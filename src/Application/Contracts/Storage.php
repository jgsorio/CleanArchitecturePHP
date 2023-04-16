<?php

namespace Core\Application\Contracts;

interface Storage
{
    public function store(string $fileName, string $path, string $content): bool;
}
