<?php

declare(strict_types=1);

namespace App\Commands;

use Illuminate\Console\Command;

final class InitCommand extends Command
{
    protected $signature = 'init';

    protected $description = 'Initialize a new dotfan config file';

    public function handle(): void {}
}
