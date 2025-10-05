<?php

declare(strict_types=1);

namespace App\Commands;

use Illuminate\Console\Command;

final class Validate extends Command
{
    protected $signature = 'validate';

    protected $description = 'Validate the dotfan config file';

    public function handle(): void {}
}
