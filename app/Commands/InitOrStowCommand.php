<?php

declare(strict_types=1);

namespace App\Commands;

use Illuminate\Console\Command;

final class InitOrStowCommand extends Command
{
    protected $signature = 'init-or-stow';

    protected $description = 'Initialize a new dotfan config if one does not exist, otherwise stow the dotfiles';

    public function handle(): void
    {
        //
    }
}
