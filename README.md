# Dotfan

**Dotf**ile M**an**ager is a CLI application to manage your dotfiles.

> 🚧 This application is a work in progress

## Installing

> 🚧 This section is a stub

## Building From Source

Building from source requires the following installed:

- PHP 8.4
- Composer
- [ext-sodium](https://www.php.net/manual/en/sodium.installation.php) (pre-installed by default)

Pull in all the dependencies, then run the build script:

```shell
composer install
composer build:all
```

If you wish to run each step separately, run the following:

```shell
composer run build:clean
composer run build:phar
composer run build:static
```

Builds will be available in the `./builds` directory.

## Contributing

> 🚧 This section is a stub

## License

Dotfan is released under the Apache-2.0 License.
