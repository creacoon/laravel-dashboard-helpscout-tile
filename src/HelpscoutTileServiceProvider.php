<?php

namespace Creacoon\HelpscoutTile;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class HelpscoutTileServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                FetchDataFromHelpscoutCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/dashboard-helpscout-tile'),
        ], 'dashboard-helpscout-tile-views');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'dashboard-helpscout-tile');

        Livewire::component('helpscout-tile', HelpscoutTileComponent::class);
    }
}
