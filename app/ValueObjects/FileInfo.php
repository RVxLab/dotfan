<?php

declare(strict_types=1);

namespace App\ValueObjects;

final readonly class FileInfo
{
    public function __construct(
        public string $sourceBaseDir,
        public string $relativeSourceFilePath,
        public string $targetBaseDir,
    ) {}
}
