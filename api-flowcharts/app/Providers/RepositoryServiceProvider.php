<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Data\Repositories\Concretes as Concretes;
use App\Data\Repositories\Contracts as Contracts;

class RepositoryServiceProvider extends ServiceProvider {
    
    public function register() {
        $this->app->singleton(Contracts\IFlowchartRepository::class, Concretes\FlowchartRepository::class);
        $this->app->singleton(Contracts\IStepRepository::class, Concretes\StepRepository::class);
        $this->app->singleton(Contracts\IStepParentRepository::class, Concretes\StepParentRepository::class);
    }

}