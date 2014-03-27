<?php namespace Davispeixoto\LaravelSalesforce;

use Illuminate\Support\ServiceProvider;

class LaravelSalesforceServiceProvider extends ServiceProvider {

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
		$this->app['salesforce'] = $this->app->share(function($app) {
			return new Salesforce($app['config']);
		});
		
		$this->app->booting(function() {
			$loader = \Illuminate\Foundation\AliasLoader::getInstance();
			$loader->alias('Salesforce', 'Davispeixoto\LaravelSalesforce\Facades\Salesforce');
			$loader->alias('SF', 'Davispeixoto\LaravelSalesforce\Facades\Salesforce');
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