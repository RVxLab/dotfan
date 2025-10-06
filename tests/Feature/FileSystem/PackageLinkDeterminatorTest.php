<?php

declare(strict_types=1);

use App\FileSystem\PackageLinkDeterminator;
use Spatie\TemporaryDirectory\TemporaryDirectory;

it('works', function (): void {
    $dir = new TemporaryDirectory()
        ->deleteWhenDestroyed()
        ->create();

    $entries = new PackageLinkDeterminator(
        base_path('tests/Fixtures'),
        $dir->path(),
    )->findLinkableFiles();
});
