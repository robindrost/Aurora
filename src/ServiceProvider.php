<?php

namespace RobinDrost\Aurora;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{

    protected $routeConfig = [
        'namespace' => 'RobinDrost\Aurora\Http\Controllers',
        'prefix' => 'aurora',
    ];

    protected $configPath = [
        '../config/aurora.php',
    ];

    public function boot()
    {
        $this->setupRoutes();
        $this->setupConfig();
    }

    protected function setupRoutes()
    {
        $this->app['router']->group($this->routeConfig, function (Router $router) {
            $router->get('dashboard', [
                'uses' => 'DashboardController@index',
                'as' => 'aurora.dashboard'
            ]);
        });
    }

    protected function setupConfig()
    {
        $this->publishes($this->configPath, 'config');
    }

}