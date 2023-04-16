<?php

namespace Core\Infrastructure\Adapters;

use Core\Application\Contracts\Storage;
use Exception;

final class LocalStorageAdapter implements Storage
{
    public function store(string $fileName, string $path, string $content): bool
    {
        try {
            file_put_contents($path . DIRECTORY_SEPARATOR . $fileName, $content);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
