<?php namespace Davispeixoto\LaravelSalesforce;

use Davispeixoto\ForceDotComToolkitForPhp\SforceEnterpriseClient as Client;

class Salesforce {
	protected $connection;
	
	public function __construct($username , $password , $token)
	{
		try {
			$this->connection = new Client();
			$this->connection->createConnection(__DIR__.'/enterprise.wsdl.xml');
			$this->connection->login($username, $password.$token);
		} catch (Exception $e) {
			Log::error($e->getMessage());
			throw $e;
		}
	}
	
	public function create()
	{
		//
	}
	
	public function update()
	{
		//
	}
	
	public function upsert()
	{
		//
	}
	
	public function merge()
	{
		//
	}
}
?>