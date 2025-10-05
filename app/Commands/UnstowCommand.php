<?php

declare(strict_types=1);

namespace App\Commands;

use Illuminate\Console\Command;

final class UnstowCommand extends Command
{
    protected $signature = 'unstow';

    protected $description = 'Unstow the dotfiles';

    public function handle(): void {}
}
