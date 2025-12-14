<?php

namespace MrShaneBarron\Pagination;

use Illuminate\Support\ServiceProvider;

class PaginationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (class_exists(\Livewire\Livewire::class)) {
            \Livewire\Livewire::component('ld-pagination', Livewire\Pagination::class);
        }
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'ld-pagination');
    }
}
