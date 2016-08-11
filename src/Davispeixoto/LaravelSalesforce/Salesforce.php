<?php namespace Davispeixoto\LaravelSalesforce;

use Davispeixoto\ForceDotComToolkitForPhp\SforceEnterpriseClient as Client;
use SalesforceException;
use Exception;
use Illuminate\Config\Repository;

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
    private $sfh;

    /**
     * The constructor.
     *
     * Authenticates into Salesforce according to
     * the provided credentials and WSDL file
     *
     * @param Repository $configExternal
     * @throws SalesforceException
     */
    public function __construct(Repository $configExternal)
    {
        try {
            $this->sfh = new Client();

            $wsdl = $configExternal->get('laravel-salesforce::wsdl');

            if (empty($wsdl)) {
                $wsdl = __DIR__ . '/Wsdl/enterprise.wsdl.xml';
            }

            $this->sfh->createConnection($wsdl);

            $username = $configExternal->get('laravel-salesforce::username');
            $password = $configExternal->get('laravel-salesforce::password');
            $token = $configExternal->get('laravel-salesforce::token');

            $this->sfh->login($username, $password . $token);
            
        } catch (Exception $e) {
            throw new SalesforceException('Exception at Constructor' . $e->getMessage() . "\n\n" . $e->getTraceAsString());
        }
    }

    public function __call($method, $args)
    {
        return call_user_func_array(array($this->sfh, $method), $args);
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
