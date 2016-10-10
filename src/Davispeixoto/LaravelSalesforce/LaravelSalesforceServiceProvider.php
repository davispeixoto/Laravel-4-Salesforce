<?php
namespace Davispeixoto\LaravelSalesforce;

use Illuminate\Support\ServiceProvider;
use Davispeixoto\ForceDotComToolkitForPhp\SforceEnterpriseClient as Client;

/**
 * Class LaravelSalesforceServiceProvider
 * @package Davispeixoto\LaravelSalesforce
 */
class LaravelSalesforceServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('davispeixoto/laravel-salesforce');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('salesforce', function ($app) {
            $sf = new Salesforce(new Client());
            $sf->connect($app['config']);

            return $sf;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('salesforce');
    }

}
