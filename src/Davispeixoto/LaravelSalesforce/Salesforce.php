<?php namespace Davispeixoto\LaravelSalesforce;

use Davispeixoto\ForceDotComToolkitForPhp\SforceEnterpriseClient as Client;
use Illuminate\Config\Repository;

class Salesforce {
	protected static $sfh;
	protected static $config;
	
	public function __construct(Repository $configExternal)
	{
		self::$config = $configExternal;
	}
	
	/**
	 * Force.com Toolkit Instance
	 * @throws Exception
	 */
	private static function getClient()
	{
		if (empty(self::$sfh)) {
			try {
				self::$sfh = new Client();
				self::$sfh->createConnection(__DIR__.'/Wsdl/enterprise.wsdl.xml');
				self::$sfh->login(self::$config->get('salesforce::username') , self::$config->get('salesforce::password') . self::$config->get('salesforce::token'));
			} catch (Exception $e) {
				Log::error($e->getMessage());
				throw $e;
			}
		}
	}
	
	/*
	 * Enterprise client functions
	 */
	public static function create($sObjects, $type)
	{
		self::getClient();
		return self::$sfh->create($sObjects, $type);
	}
	
	public static function update($sObjects, $type, $assignment_header = NULL, $mru_header = NULL)
	{
		self::getClient();
		return self::$sfh->update($sObjects, $type, $assignment_header, $mru_header);
	}
	
	public static function upsert($ext_Id, $sObjects, $type = 'Contact')
	{
		self::getClient();
		return self::$sfh->upsert($ext_Id, $sObjects, $type);
	}
	
	public function merge($mergeRequest, $type)
	{
		self::getClient();
		return self::$sfh->merge($mergeRequest, $type);
	}
	
	/*
	 * Base Client functions
	 */
	public static function getNamespace()
	{
		self::getClient();
		return self::$sfh->getNamespace();
	}
	
	public static function printDebugInfo()
	{
		self::getClient();
		return self::$sfh->printDebugInfo();
	}
	
	public static function createConnection($wsdl, $proxy = NULL, $soap_options = array())
	{
		self::getClient();
		return self::$sfh->createConnection($wsdl, $proxy, $soap_options);
	}
	
	public static function setCallOptions($header)
	{
		self::getClient();
		return self::$sfh->setCallOptions($header);
	}
	
	public static function login($username, $password)
	{
		self::getClient();
		return self::$sfh->login($username, $password);
	}
	
	public static function logout()
	{
		self::getClient();
		return self::$sfh->logout();
	}
	
	public static function invalidateSessions()
	{
		self::getClient();
		return self::$sfh->invalidateSessions();
	}
	
	public static function setEndpoint($location)
	{
		self::getClient();
		return self::$sfh->setEndpoint($location);
	}
	
	public static function setAssignmentRuleHeader($header)
	{
		self::getClient();
		return self::$sfh->setAssignmentRuleHeader($header);
	}
	
	public static function setEmailHeader($header)
	{
		self::getClient();
		return self::$sfh->setEmailHeader($header);
	}
	
	public static function setLoginScopeHeader($header)
	{
		self::getClient();
		return self::$sfh->setLoginScopeHeader($header);
	}
	
	public static function setMruHeader($header)
	{
		self::getClient();
		return self::$sfh->setMruHeader($header);
	}
	
	public static function setSessionHeader($id)
	{
		self::getClient();
		return self::$sfh->setSessionHeader($id);
	}
	
	public static function setUserTerritoryDeleteHeader($header)
	{
		self::getClient();
		return self::$sfh->setUserTerritoryDeleteHeader($header);
	}
	
	public static function setQueryOptions($header)
	{
		self::getClient();
		return self::$sfh->setQueryOptions($header);
	}
	
	public static function setAllowFieldTruncationHeader($header)
	{
		self::getClient();
		return self::$sfh->setAllowFieldTruncationHeader($header);
	}
	
	public static function setLocaleOptions($header)
	{
		self::getClient();
		return self::$sfh->setLocaleOptions($header);
	}
	
	public static function setPackageVersionHeader($header)
	{
		self::getClient();
		return self::$sfh->setPackageVersionHeader($header);
	}
	
	public static function getSessionId()
	{
		self::getClient();
		return self::$sfh->getSessionId();
	}
	
	public static function getLocation()
	{
		self::getClient();
		return self::$sfh->getLocation();
	}
	
	public static function getConnection()
	{
		self::getClient();
		return self::$sfh->getConnection();
	}
	
	public static function getFunctions()
	{
		self::getClient();
		return self::$sfh->getFunctions();
	}
	
	public static function getTypes()
	{
		self::getClient();
		return self::$sfh->getTypes();
	}
	
	public static function getLastRequest()
	{
		self::getClient();
		return self::$sfh->getLastRequest();
	}
	
	public static function getLastRequestHeaders()
	{
		self::getClient();
		return self::$sfh->getLastRequestHeaders();
	}
	
	public static function getLastResponse()
	{
		self::getClient();
		return self::$sfh->getLastResponse();
	}
	
	public static function getLastResponseHeaders()
	{
		self::getClient();
		return self::$sfh->getLastResponseHeaders();
	}
	
	public static function sendSingleEmail($request)
	{
		self::getClient();
		return self::$sfh->sendSingleEmail($request);
	}
	
	public static function sendMassEmail($request)
	{
		self::getClient();
		return self::$sfh->sendMassEmail($request);
	}
	
	public static function convertLead($leadConverts)
	{
		self::getClient();
		return self::$sfh->convertLead($leadConverts);
	}
	
	public static function delete($ids)
	{
		self::getClient();
		return self::$sfh->delete($ids);
	}
	
	public static function undelete($ids)
	{
		self::getClient();
		return self::$sfh->undelete($ids);
	}
	
	public static function emptyRecycleBin($ids)
	{
		self::getClient();
		return self::$sfh->emptyRecycleBin($ids);
	}
	
	public static function processSubmitRequest($processRequestArray)
	{
		self::getClient();
		return self::$sfh->processSubmitRequest($processRequestArray);
	}
	
	public static function processWorkitemRequest($processRequestArray)
	{
		self::getClient();
		return self::$sfh->processWorkitemRequest($processRequestArray);
	}
	
	public static function describeGlobal()
	{
		self::getClient();
		return self::$sfh->describeGlobal();
	}
	
	public static function describeLayout($type, array $recordTypeIds = NULL)
	{
		self::getClient();
		return self::$sfh->describeLayout($type, $recordTypeIds);
	}
	
	public static function describeSObject($type)
	{
		self::getClient();
		return self::$sfh->describeSObject($type);
	}
	
	public static function describeSObjects($arrayOfTypes)
	{
		self::getClient();
		return self::$sfh->describeSObjects($arrayOfTypes);
	}
	
	public static function describeTabs()
	{
		self::getClient();
		return self::$sfh->describeTabs();
	}
	
	public static function describeDataCategoryGroups($sObjectType)
	{
		self::getClient();
		return self::$sfh->describeDataCategoryGroups($sObjectType);
	}
	
	public static function describeDataCategoryGroupStructures(array $pairs, $topCategoriesOnly)
	{
		self::getClient();
		return self::$sfh->describeDataCategoryGroupStructures($pairs, $topCategoriesOnly);
	}
	
	public static function getDeleted($type, $startDate, $endDate)
	{
		self::getClient();
		return self::$sfh->getDeleted($type, $startDate, $endDate);
	}
	
	public static function getUpdated($type, $startDate, $endDate)
	{
		self::getClient();
		return self::$sfh->getUpdated($type, $startDate, $endDate);
	}
	
	public static function query($query)
	{
		self::getClient();
		return self::$sfh->query($query);
	}
	
	public static function queryMore($queryLocator)
	{
		self::getClient();
		return self::$sfh->queryMore($queryLocator);
	}
	
	public static function queryAll($query, $queryOptions = NULL)
	{
		self::getClient();
		return self::$sfh->queryAll($query, $queryOptions);
	}
	
	public static function retrieve($fieldList, $sObjectType, $ids)
	{
		self::getClient();
		return self::$sfh->retrieve($fieldList, $sObjectType, $ids);
	}
	
	public static function search($searchString)
	{
		self::getClient();
		return self::$sfh->search($searchString);
	}
	
	public static function getServerTimestamp()
	{
		self::getClient();
		return self::$sfh->getServerTimestamp();
	}
	
	public static function getUserInfo()
	{
		self::getClient();
		return self::$sfh->getUserInfo();
	}
	
	public static function setPassword($userId, $password)
	{
		self::getClient();
		return self::$sfh->setPassword($userId, $password);
	}
	
	public static function resetPassword($userId)
	{
		self::getClient();
		return self::$sfh->resetPassword($userId);
	}
}
?>
