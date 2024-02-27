<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Application\Concretes as Concretes;
use App\Application\Contracts as Contracts;

class ApplicationServiceProvider extends ServiceProvider {
    
    public function register() {
        $this->app->singleton(Contracts\IFlowchartApplication::class, Concretes\FlowchartApplication::class);
        $this->app->singleton(Contracts\IStepApplication::class, Concretes\StepApplication::class);
        $this->app->singleton(Contracts\IFlowchartStructureApplication::class, Concretes\FlowchartStructureApplication::class);
    }

}