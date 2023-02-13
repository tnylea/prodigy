<?php

namespace ProdigyPHP\Prodigy;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\Compilers\BladeCompiler;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use ProdigyPHP\Prodigy\Commands\ProdigyCommand;
use Livewire\Livewire;

class ProdigyServiceProvider extends PackageServiceProvider {

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

    public function bootingPackage(): void
    {

        // Add livewire components
        Livewire::component('prodigy-page', ProdigyPage::class);
        Livewire::component('prodigy-editor', Editor::class);
        Livewire::component('prodigy-edit-block', EditBlock::class);

        // load blade components
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'prodigy');
		$this->configureComponents();
    }

    protected function configureComponents()
    {
		$this->callAfterResolving(BladeCompiler::class, function () {
			$this->registerComponent('structure.inner');
			$this->registerComponent('structure.wrapper');
			$this->registerComponent('blocks.row');
		});
	}

    protected function registerComponent(string $component)
    {
        Blade::component('prodigy::components.'.$component, 'prodigy-'.$component);
    }

    /**
     * Register the Prodigy gate.
     *
     * This gate determines who can access Prodigy in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewProdigy', function ($user) {
            return in_array($user->email, [
                'stephen@bate-man.com'
            ]);
        });
    }

}
