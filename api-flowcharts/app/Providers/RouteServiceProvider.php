<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

class RouteServiceProvider extends ServiceProvider
{

    protected $namespace = 'App\Http\Controllers';
    
    public function map(Router $router): void
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http\Routes\FlowchartControllerRoutes.php');
            require app_path('Http\Routes\StepControllerRoutes.php');
        });
    }

}
