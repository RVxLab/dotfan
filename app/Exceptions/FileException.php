<?php

declare(strict_types=1);

namespace App\Exceptions;

use RuntimeException;

final class FileException extends RuntimeException
{
    public static function duplicateFile(string $path, string $packageName): self
    {
        return new self("Inserting '$path' would cause a conflict with the one defined by '$packageName'.");
    }
}
