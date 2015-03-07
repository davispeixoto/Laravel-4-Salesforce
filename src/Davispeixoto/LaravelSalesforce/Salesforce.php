<?php namespace Davispeixoto\LaravelSalesforce;

use Davispeixoto\ForceDotComToolkitForPhp\SforceEnterpriseClient as Client;
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
     * @var \Davispeixoto\ForceDotComToolkitForPhp\SforceBaseClient sfh The Salesforce Handler
     */
    public $sfh;

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

            $this->sfh->login($configExternal->get('laravel-salesforce::username'),
                $configExternal->get('laravel-salesforce::password') . $configExternal->get('laravel-salesforce::token'));
            return $this;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new SalesforceException('Exception no Construtor' . $e->getMessage() . "\n\n" . $e->getTraceAsString());
        }
    }

    /*
     * Enterprise client functions
     */

    /**
     * Create
     *
     * Create objetcts into salesforce
     *
     * @param array $sObjects An array of one or more (up to 200) stdClass representations of the object
     * @param string $type The Salesforce Object Type
     * @return mixed An array of successes/failures for this operation
     */
    public function create($sObjects, $type)
    {
        return $this->sfh->create($sObjects, $type);
    }

    /**
     * Update
     *
     * Create objetcts into salesforce using Salesforce ID
     *
     * @param array $sObjects An array of stdClass representations of the object
     * @param string $type The Salesforce Object Type
     * @param null $assignment_header Actually not used by official Salesforce implementation
     * @param null $mru_header Actually not used by official Salesforce implementation
     * @return \Davispeixoto\ForceDotComToolkitForPhp\UpdateResult An array of successes/failures for this operation
     */
    public function update($sObjects, $type, $assignment_header = null, $mru_header = null)
    {
        return $this->sfh->update($sObjects, $type, $assignment_header, $mru_header);
    }

    /**
     * Upsert
     *
     * Update objects into salesforce given their external ID
     * If its external ID is not found, creates the object into
     * Salesforce
     *
     * @param string $ext_Id The field name to be used as external ID
     * @param array $sObjects An array of stdClass representations of the object
     * @param string $type The Salesforce Object Type
     * @return \Davispeixoto\ForceDotComToolkitForPhp\UpsertResult An array of successes/failures for this operation
     */
    public function upsert($ext_Id, $sObjects, $type = 'Contact')
    {
        return $this->sfh->upsert($ext_Id, $sObjects, $type);
    }

    /**
     * Merge
     *
     * Merges up to 3 records into one.
     *
     * @param \stdClass $mergeRequest A mergeRequest object
     * @param string $type The Salesforce Object Type (actually can merge only Lead, Account and Contact objects)
     * @return \Davispeixoto\ForceDotComToolkitForPhp\MergeResult
     */
    public function merge($mergeRequest, $type)
    {
        return $this->sfh->merge($mergeRequest, $type);
    }

    /*
     * Base Client functions
     */
    public function getNamespace()
    {
        return $this->sfh->getNamespace();
    }

    public function printDebugInfo()
    {
        $this->sfh->printDebugInfo();
    }

    public function createConnection($wsdl, $proxy = null, $soap_options = array())
    {
        return $this->sfh->createConnection($wsdl, $proxy, $soap_options);
    }

    public function setCallOptions($header)
    {
        $this->sfh->setCallOptions($header);
    }

    /**
     * Login into salesforce
     *
     * Actually useless for this class
     * once the login is made on constructor
     *
     * @param string $username
     * @param string $password
     * @return \Davispeixoto\ForceDotComToolkitForPhp\LoginResult
     */
    public function login($username, $password)
    {
        return $this->sfh->login($username, $password);
    }

    /**
     * Logout
     *
     * @return \Davispeixoto\ForceDotComToolkitForPhp\LogoutResult
     */
    public function logout()
    {
        return $this->sfh->logout();
    }

    /**
     * Invalidate the current sessions
     *
     * @return \Davispeixoto\ForceDotComToolkitForPhp\invalidateSessionsResult
     */
    public function invalidateSessions()
    {
        return $this->sfh->invalidateSessions();
    }

    public function setEndpoint($location)
    {
        $this->sfh->setEndpoint($location);
    }

    public function setAssignmentRuleHeader($header)
    {
        $this->sfh->setAssignmentRuleHeader($header);
    }

    public function setEmailHeader($header)
    {
        $this->sfh->setEmailHeader($header);
    }

    public function setLoginScopeHeader($header)
    {
        $this->sfh->setLoginScopeHeader($header);
    }

    public function setMruHeader($header)
    {
        $this->sfh->setMruHeader($header);
    }

    public function setSessionHeader($id)
    {
        $this->sfh->setSessionHeader($id);
    }

    public function setUserTerritoryDeleteHeader($header)
    {
        $this->sfh->setUserTerritoryDeleteHeader($header);
    }

    /**
     * Set Query Options
     *
     * Sets the query batch size
     * Minimum is 200, Maximum is 2000
     * Defaults to 500
     *
     * @param \stdClass $header The Salesforce QueryOptions Object
     */
    public function setQueryOptions($header)
    {
        $this->sfh->setQueryOptions($header);
    }

    public function setAllowFieldTruncationHeader($header)
    {
        $this->sfh->setAllowFieldTruncationHeader($header);
    }

    public function setLocaleOptions($header)
    {
        $this->sfh->setLocaleOptions($header);
    }

    public function setPackageVersionHeader($header)
    {
        $this->sfh->setPackageVersionHeader($header);
    }

    public function getSessionId()
    {
        return $this->sfh->getSessionId();
    }

    public function getLocation()
    {
        return $this->sfh->getLocation();
    }

    public function getConnection()
    {
        return $this->sfh->getConnection();
    }

    public function getFunctions()
    {
        return $this->sfh->getFunctions();
    }

    public function getTypes()
    {
        return $this->sfh->getTypes();
    }

    public function getLastRequest()
    {
        return $this->sfh->getLastRequest();
    }

    public function getLastRequestHeaders()
    {
        return $this->sfh->getLastRequestHeaders();
    }

    public function getLastResponse()
    {
        return $this->sfh->getLastResponse();
    }

    public function getLastResponseHeaders()
    {
        return $this->sfh->getLastResponseHeaders();
    }

    public function sendSingleEmail($request)
    {
        return $this->sfh->sendSingleEmail($request);
    }

    public function sendMassEmail($request)
    {
        return $this->sfh->sendMassEmail($request);
    }

    /**
     * Convert Lead
     *
     * Converts a Lead into an Account and Contact,
     * as well as (optionally) an Opportunity.
     *
     * @param array $leadConverts The lead convert array (*check its specification!)
     * @return \Davispeixoto\ForceDotComToolkitForPhp\LeadConvertResult
     */
    public function convertLead($leadConverts)
    {
        return $this->sfh->convertLead($leadConverts);
    }

    /**
     * Delete
     *
     * Deletes on or more (up to 200) objects from Salesforce
     *
     * @param array $ids An array of Salesforce IDs
     * @return \Davispeixoto\ForceDotComToolkitForPhp\DeleteResult
     */
    public function delete($ids)
    {
        return $this->sfh->delete($ids);
    }

    /**
     * Undelete
     *
     * Undeletes on or more (up to 200) objects from Salesforce
     * deleted with delete, merge operation or moved to recycle bin
     *
     * @param array $ids An array of Salesforce IDs
     * @return \Davispeixoto\ForceDotComToolkitForPhp\DeleteResult
     */
    public function undelete($ids)
    {
        return $this->sfh->undelete($ids);
    }

    /**
     * Empty Recycle Bin
     *
     * Permanently delete objects from recycle bin
     *
     * The Recycle Bin lets you view and restore recently deleted records
     * for 15 days before they are permanently deleted.
     *
     * @param $ids
     * @return \Davispeixoto\ForceDotComToolkitForPhp\DeleteResult
     */
    public function emptyRecycleBin($ids)
    {
        return $this->sfh->emptyRecycleBin($ids);
    }

    public function processSubmitRequest($processRequestArray)
    {
        return $this->sfh->processSubmitRequest($processRequestArray);
    }

    public function processWorkitemRequest($processRequestArray)
    {
        return $this->sfh->processWorkitemRequest($processRequestArray);
    }

    public function describeGlobal()
    {
        return $this->sfh->describeGlobal();
    }

    public function describeLayout($type, array $recordTypeIds = null)
    {
        return $this->sfh->describeLayout($type, $recordTypeIds);
    }

    public function describeSObject($type)
    {
        return $this->sfh->describeSObject($type);
    }

    public function describeSObjects($arrayOfTypes)
    {
        return $this->sfh->describeSObjects($arrayOfTypes);
    }

    public function describeTabs()
    {
        return $this->sfh->describeTabs();
    }

    public function describeDataCategoryGroups($sObjectType)
    {
        return $this->sfh->describeDataCategoryGroups($sObjectType);
    }

    public function describeDataCategoryGroupStructures(array $pairs, $topCategoriesOnly)
    {
        return $this->sfh->describeDataCategoryGroupStructures($pairs, $topCategoriesOnly);
    }

    /**
     * Get deleted
     *
     * Get deleted records IDs between the given start and end datetime
     *
     * @param string $type The Salesforce Object Type
     * @param string $startDate The start datetime (according to Salesforce definition)
     * @param string $endDate The end datetime (according to Salesforce definition)
     * @return \Davispeixoto\ForceDotComToolkitForPhp\GetDeletedResult
     */
    public function getDeleted($type, $startDate, $endDate)
    {
        return $this->sfh->getDeleted($type, $startDate, $endDate);
    }

    /**
     * Get updated
     *
     * Get inserted and updated records IDs between the given start and end datetime
     *
     * @param string $type The Salesforce Object Type
     * @param string $startDate The start datetime (according to Salesforce definition)
     * @param string $endDate The end datetime (according to Salesforce definition)
     * @return \Davispeixoto\ForceDotComToolkitForPhp\GetUpdatedResult
     */
    public function getUpdated($type, $startDate, $endDate)
    {
        return $this->sfh->getUpdated($type, $startDate, $endDate);
    }

    /**
     * Query
     *
     * Executes a SOQL query
     * Returns a maximum of 500 records
     *
     * @param string $query The SOQL query
     * @return \Davispeixoto\ForceDotComToolkitForPhp\QueryResult
     */
    public function query($query)
    {
        return $this->sfh->query($query);
    }

    /**
     * Query More
     *
     * Retrieves the next batch for big result SOQL queries
     *
     * @param string $queryLocator The query locator returned on the previous SOQL query
     * @return \Davispeixoto\ForceDotComToolkitForPhp\QueryResult
     */
    public function queryMore($queryLocator)
    {
        return $this->sfh->queryMore($queryLocator);
    }

    /**
     * Query all
     *
     * Same as query but also returns deleted or merged records
     *
     * @param string $query The SOQL query
     * @param null $queryOptions The query options object (min size is 200, maximum is 2000, defaults to 500)
     * @return \Davispeixoto\ForceDotComToolkitForPhp\QueryResult
     */
    public function queryAll($query, $queryOptions = null)
    {
        return $this->sfh->queryAll($query, $queryOptions);
    }

    /**
     * Retrieve
     *
     * Retrieves one or more records based on the specified IDs.
     *
     * @param string $fieldList The fields you want to retrieve
     * @param string $sObjectType The Salesforce Object Type
     * @param array $ids An array of Salesforce IDs
     * @return \Davispeixoto\ForceDotComToolkitForPhp\sObject[]
     */
    public function retrieve($fieldList, $sObjectType, $ids)
    {
        return $this->sfh->retrieve($fieldList, $sObjectType, $ids);
    }

    /**
     * Search
     *
     * Performs a text search into Salesforce objects
     *
     * @param string $searchString A valid SOSL searchString
     * @return \Davispeixoto\ForceDotComToolkitForPhp\SearchResult
     */
    public function search($searchString)
    {
        return $this->sfh->search($searchString);
    }

    public function getServerTimestamp()
    {
        return $this->sfh->getServerTimestamp();
    }

    public function getUserInfo()
    {
        return $this->sfh->getUserInfo();
    }

    public function setPassword($userId, $password)
    {
        return $this->sfh->setPassword($userId, $password);
    }

    public function resetPassword($userId)
    {
        return $this->sfh->resetPassword($userId);
    }

    /*
     * Debugging functions
     */
    public function dump()
    {
        print_r($this, true);
    }
}

?>