<?php

namespace App\Providers;

use App\Translates\PluginManager;
use Illuminate\Support\ServiceProvider;
use LaravelLang\Publisher\Plugins\Provider;

class TranslateServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        if (class_exists(Provider::class)) {
            $this->app->register(PluginManager::class);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
