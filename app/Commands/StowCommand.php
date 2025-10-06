<?php

declare(strict_types=1);

namespace App\Commands;

use DirectoryIterator;
use Illuminate\Console\Command;

final class StowCommand extends Command
{
    protected $signature = <<<SIG
        stow
        {--d|dir= : The directory that contains your dotfiles. Defaults to the current directory}
        {--t|target= : The directory to stow into. Defaults to the parent of the current directory}

    SIG;

    protected $description = 'Stow the dotfiles';

    public function handle(): void
    {
        $pwd = getcwd();

        $stowDir = (string) ($this->option('dir') ?? $pwd);
        $targetDir = $this->option('target') ?? "$pwd/..";

        $dirIter = new DirectoryIterator($stowDir);

        /** @var DirectoryIterator $dir */
        foreach ($dirIter as $dir) {
            if ($dir->isFile()) {
                continue;
            }
            if ($dir->isDot()) {
                continue;
            }
            $this->walkDir($dir->getPath(), $dir->getBasename(), $targetDir);

            break;
        }
    }

    private function walkDir(string $baseDir, string $baseName, string $targetBaseDir): void
    {
        $base = "$baseDir/$baseName";
        $dirIter = new DirectoryIterator($base);

        foreach ($dirIter as $dir) {
            if ($dir->isFile()) {
                continue;
            }
            if ($dir->isDot()) {
                continue;
            }
            $target = sprintf('%s/%s', $targetBaseDir, $dir->getBasename());

            if (file_exists($target)) {
                continue;
            }

            echo $target;
        }
    }
}
