<?php namespace Davispeixoto\LaravelSalesforce\Facades;

use Illuminate\Support\Facades\Facade;

class Salesforce extends Facades {
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() {
		return 'salesforce';
	}
}