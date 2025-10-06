<?php

declare(strict_types=1);

use App\Exceptions\FileException;
use App\FileSystem\FileTree;

it('can insert a file', function (): void {
    $tree = new FileTree('/tmp', 'root');
    $tree->insertFile('foo/bar/baz.txt', 'one');

    expect($tree->getFile('foo/bar/baz.txt')?->basePath)
        ->toBe('/tmp/foo/bar/baz.txt');
});

it('can insert multiple files', function (): void {
    $tree = new FileTree('/tmp', 'root');
    $tree
        ->insertFile('foo/bar/baz.txt', 'one')
        ->insertFile('foo/bar/qux.txt', 'two');

    expect($tree->getFile('foo/bar/baz.txt')?->basePath)
        ->toBe('/tmp/foo/bar/baz.txt')
        ->and($tree->getFile('foo/bar/qux.txt')?->basePath)
        ->toBe('/tmp/foo/bar/qux.txt');
});

it('will throw an error if duplicate files are to be inserted', function (): void {
    $tree = new FileTree('/tmp', 'root');
    $tree->insertFile('foo/bar/baz.txt', 'one');

    expect(fn (): FileTree => $tree->insertFile('foo/bar/baz.txt', 'two'))
        ->toThrow(FileException::duplicateFile('/tmp/foo/bar/baz.txt', 'one'));
});
