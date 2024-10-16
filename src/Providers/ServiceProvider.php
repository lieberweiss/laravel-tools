<?php

namespace Liwe\Tools\Providers;

use Liwe\Tools\Commands\Dump;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    
    public function boot()
    {
        $this->registerCommands();
    }
    
    
    private function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Dump::class,
            ]);
        }
    }
}
