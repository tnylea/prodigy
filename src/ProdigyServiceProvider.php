<?php

namespace ProdigyPHP\Prodigy;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use ProdigyPHP\Prodigy\Commands\ProdigyCommand;

class ProdigyServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('prodigy')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_prodigy_table')
            ->hasCommand(ProdigyCommand::class);
    }
}