<?php

namespace App\Translates;

use LaravelLang\Publisher\Plugins\Provider;

class PluginManager extends Provider
{
    protected string $base_path = __DIR__.'/../../translations/';

    protected array $plugins = [
        AppPlugin::class,
    ];
}
