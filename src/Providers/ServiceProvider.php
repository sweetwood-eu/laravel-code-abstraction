<?php

namespace SweetwoodEU\Laravel\CodeAbstraction\Providers;

use Illuminate\Support\ServiceProvider As BaseServiceProvider;
use SweetwoodEU\Laravel\CodeAbstraction\Console\Command\ActionMakeCommand;
use SweetwoodEU\Laravel\CodeAbstraction\Console\Command\QueryMakeCommand;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ActionMakeCommand::class,
                QueryMakeCommand::class,
            ]);
        }
    }
}