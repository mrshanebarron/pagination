<?php

namespace MrShaneBarron\pagination;

use Illuminate\Support\ServiceProvider;
use MrShaneBarron\pagination\Livewire\pagination;
use MrShaneBarron\pagination\View\Components\pagination as Bladepagination;
use Livewire\Livewire;

class paginationServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/ld-pagination.php', 'ld-pagination');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'ld-pagination');

        Livewire::component('ld-pagination', pagination::class);

        $this->loadViewComponentsAs('ld', [
            Bladepagination::class,
        ]);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/ld-pagination.php' => config_path('ld-pagination.php'),
            ], 'ld-pagination-config');

            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/ld-pagination'),
            ], 'ld-pagination-views');
        }
    }
}
