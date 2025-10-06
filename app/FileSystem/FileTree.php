<?php

declare(strict_types=1);

namespace App\FileSystem;

use App\Exceptions\FileException;

use function implode;

final class FileTree
{
    /**
     * @var array<string, self>
     */
    public private(set) array $children = [];

    public function __construct(
        public readonly string $basePath,
        public readonly string $firstDeclaringPackage,
    ) {}

    public function insertFile(string $path, string $packageName): self
    {
        if (mb_trim($path) === '') {
            return $this;
        }

        $parts = explode(DIRECTORY_SEPARATOR, $path);
        $name = array_shift($parts);

        // If after the array_shift there are no more parts, this must be the file name
        $entryIsFile = count($parts) === 0;

        // If the same file is about to be inserted, we abort with an error
        // as we can't handle duplicate files in the file system
        if ($entryIsFile && isset($this->children[$name])) {
            $existingChild = $this->children[$name];

            throw FileException::duplicateFile("$this->basePath/$name", $existingChild->firstDeclaringPackage);
        }

        $this->children[$name] ??= new self("$this->basePath/$name", $packageName);
        $this->children[$name]->insertFile(implode(DIRECTORY_SEPARATOR, $parts), $packageName);

        return $this;
    }

    public function getFile(string $path): ?self
    {
        $parts = explode(DIRECTORY_SEPARATOR, $path);

        $current = $this;

        foreach ($parts as $part) {
            if (!isset($current->children[$part])) {
                return null;
            }

            $current = $current->children[$part];
        }

        return $current;
    }
}
