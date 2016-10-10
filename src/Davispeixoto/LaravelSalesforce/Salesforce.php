<?php namespace Davispeixoto\LaravelSalesforce;

use Davispeixoto\ForceDotComToolkitForPhp\SforceEnterpriseClient as Client;
use Exception;

/**
 * Class Salesforce
 *
 * Provides an easy binding to Salesforce
 * on Laravel 4 applications through SOAP
 * Data Integration.
 *
 * @package Davispeixoto\LaravelSalesforce
 */
class Salesforce
{
    /**
     * @var Client $sfh The Salesforce Handler
     */
    public $sfh;

    /**
     * Salesforce constructor.
     *
     * @param Client $sfh
     * @throws SalesforceException
     */
    public function __construct(Client $sfh)
    {
        $this->sfh = $sfh;
    }

    /**
     * @param $method
     * @param $args
     * @return mixed
     */
    public function __call($method, $args)
    {
        return call_user_func_array(array($this->sfh, $method), $args);
    }

    /**
     * Authenticates into Salesforce according to
     * the provided credentials and WSDL file
     *
     * @param $configExternal
     * @throws SalesforceException
     */

    public function connect($configExternal)
    {
        $wsdl = $configExternal->get('laravel-salesforce::wsdl');

        if (empty($wsdl)) {
            $wsdl = __DIR__ . '/Wsdl/enterprise.wsdl.xml';
        }

        $username = $configExternal->get('laravel-salesforce::username');
        $password = $configExternal->get('laravel-salesforce::password');
        $token = $configExternal->get('laravel-salesforce::token');

        try {
            $this->sfh->createConnection($wsdl);
            $this->sfh->login($username, $password . $token);
        } catch (Exception $e) {
            throw new SalesforceException('Exception at Constructor' . $e->getMessage() . "\n\n" . $e->getTraceAsString());
        }
    }

    /*
     * Debugging functions
     */

    /**
     * @return mixed
     */
    public function dump()
    {
        return print_r($this, true);
    }
}
