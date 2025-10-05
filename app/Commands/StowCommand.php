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
        $this->option('target') ?? "$pwd/..";

        $dirIter = new DirectoryIterator($stowDir);

        foreach ($dirIter as $dir) {
            if ($dir->isDot()) {
                continue;
            }

            dump($dir->getPathname());
        }
    }
}
