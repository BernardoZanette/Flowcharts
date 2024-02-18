<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Concretes as Concretes;
use App\Domain\Contracts as Contracts;

class DomainServiceProvider extends ServiceProvider {
    
    public function register() {
        $this->app->singleton(Contracts\IFlowchartDomain::class, Concretes\FlowchartDomain::class);
        $this->app->singleton(Contracts\IStepDomain::class, Concretes\StepDomain::class);
        $this->app->singleton(Contracts\IStepParentDomain::class, Concretes\StepParentDomain::class);
    }

}