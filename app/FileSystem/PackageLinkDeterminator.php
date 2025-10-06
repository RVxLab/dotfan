<?php

declare(strict_types=1);

namespace App\FileSystem;

use App\ValueObjects\FileInfo;
use Symfony\Component\Finder\Finder;

use const DIRECTORY_SEPARATOR;

final class PackageLinkDeterminator
{
    public function __construct(
        public string $sourceDir,
        public string $destDir,
    ) {}

    /**
     * @return list<FileInfo>
     */
    public function findLinkableFiles(): array
    {
        $finder = new Finder()
            ->files()
            ->ignoreDotFiles(false)
            ->in($this->sourceDir);

        $tree = new FileTree($this->sourceDir, 'root');

        foreach ($finder as $file) {
            [$packageName, $path] = explode(DIRECTORY_SEPARATOR, $file->getRelativePathname(), 2);

            $tree->insertFile($path, $packageName);
        }

        dd($tree);
    }
}
