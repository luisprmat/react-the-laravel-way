<?php

namespace App\Translates;

use LaravelLang\Publisher\Plugins\Plugin;

class AppPlugin extends Plugin
{
    public function files(): array
    {
        return [
            '../../../../lang_source/app.json' => '{locale}.json',
        ];
    }
}
