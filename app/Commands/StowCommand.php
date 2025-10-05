<?php

declare(strict_types=1);

namespace App\Commands;

use Illuminate\Console\Command;

final class StowCommand extends Command
{
    protected $signature = 'stow';

    protected $description = 'Stow the dotfiles';

    public function handle(): void {}
}
