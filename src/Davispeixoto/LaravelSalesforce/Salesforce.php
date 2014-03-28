<?php namespace Davispeixoto\LaravelSalesforce;

use Davispeixoto\ForceDotComToolkitForPhp\SforceEnterpriseClient as Client;
use Illuminate\Config\Repository;

class Salesforce {
	protected $sfh;
	protected static $instance;
	
	public static function factory(Repository $configExternal)
	{
		if (empty(self::$instance->sfh) || empty($self::$instance)) {
			try {
				$c = __CLASS__;
				self::$instance = new $c;
				self::$instance->sfh = new Client();
				self::$instance->sfh->createConnection(__DIR__.'/Wsdl/enterprise.wsdl.xml');
				self::$instance->sfh->login($configExternal->get('username') , $configExternal->get('password') . $configExternal->get('token'));
				return self::$instance;
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
		return self::$instance->sfh->create($sObjects, $type);
	}
	
	public static function update($sObjects, $type, $assignment_header = NULL, $mru_header = NULL)
	{
		return self::$instance->sfh->update($sObjects, $type, $assignment_header, $mru_header);
	}
	
	public static function upsert($ext_Id, $sObjects, $type = 'Contact')
	{
		return self::$instance->sfh->upsert($ext_Id, $sObjects, $type);
	}
	
	public function merge($mergeRequest, $type)
	{
		return self::$instance->sfh->merge($mergeRequest, $type);
	}
	
	/*
	 * Base Client functions
	 */
	public static function getNamespace()
	{
		return self::$instance->sfh->getNamespace();
	}
	
	public static function printDebugInfo()
	{
		return self::$instance->sfh->printDebugInfo();
	}
	
	public static function createConnection($wsdl, $proxy = NULL, $soap_options = array())
	{
		return self::$instance->sfh->createConnection($wsdl, $proxy, $soap_options);
	}
	
	public static function setCallOptions($header)
	{
		return self::$instance->sfh->setCallOptions($header);
	}
	
	public static function login($username, $password)
	{
		return self::$instance->sfh->login($username, $password);
	}
	
	public static function logout()
	{
		return self::$instance->sfh->logout();
	}
	
	public static function invalidateSessions()
	{
		return self::$instance->sfh->invalidateSessions();
	}
	
	public static function setEndpoint($location)
	{
		return self::$instance->sfh->setEndpoint($location);
	}
	
	public static function setAssignmentRuleHeader($header)
	{
		return self::$instance->sfh->setAssignmentRuleHeader($header);
	}
	
	public static function setEmailHeader($header)
	{
		return self::$instance->sfh->setEmailHeader($header);
	}
	
	public static function setLoginScopeHeader($header)
	{
		return self::$instance->sfh->setLoginScopeHeader($header);
	}
	
	public static function setMruHeader($header)
	{
		return self::$instance->sfh->setMruHeader($header);
	}
	
	public static function setSessionHeader($id)
	{
		return self::$instance->sfh->setSessionHeader($id);
	}
	
	public static function setUserTerritoryDeleteHeader($header)
	{
		return self::$instance->sfh->setUserTerritoryDeleteHeader($header);
	}
	
	public static function setQueryOptions($header)
	{
		return self::$instance->sfh->setQueryOptions($header);
	}
	
	public static function setAllowFieldTruncationHeader($header)
	{
		return self::$instance->sfh->setAllowFieldTruncationHeader($header);
	}
	
	public static function setLocaleOptions($header)
	{
		return self::$instance->sfh->setLocaleOptions($header);
	}
	
	public static function setPackageVersionHeader($header)
	{
		return self::$instance->sfh->setPackageVersionHeader($header);
	}
	
	public static function getSessionId()
	{
		return self::$instance->sfh->getSessionId();
	}
	
	public static function getLocation()
	{
		return self::$instance->sfh->getLocation();
	}
	
	public static function getConnection()
	{
		return self::$instance->sfh->getConnection();
	}
	
	public static function getFunctions()
	{
		return self::$instance->sfh->getFunctions();
	}
	
	public static function getTypes()
	{
		return self::$instance->sfh->getTypes();
	}
	
	public static function getLastRequest()
	{
		return self::$instance->sfh->getLastRequest();
	}
	
	public static function getLastRequestHeaders()
	{
		return self::$instance->sfh->getLastRequestHeaders();
	}
	
	public static function getLastResponse()
	{
		return self::$instance->sfh->getLastResponse();
	}
	
	public static function getLastResponseHeaders()
	{
		return self::$instance->sfh->getLastResponseHeaders();
	}
	
	public static function sendSingleEmail($request)
	{
		return self::$instance->sfh->sendSingleEmail($request);
	}
	
	public static function sendMassEmail($request)
	{
		return self::$instance->sfh->sendMassEmail($request);
	}
	
	public static function convertLead($leadConverts)
	{
		return self::$instance->sfh->convertLead($leadConverts);
	}
	
	public static function delete($ids)
	{
		return self::$instance->sfh->delete($ids);
	}
	
	public static function undelete($ids)
	{
		return self::$instance->sfh->undelete($ids);
	}
	
	public static function emptyRecycleBin($ids)
	{
		return self::$instance->sfh->emptyRecycleBin($ids);
	}
	
	public static function processSubmitRequest($processRequestArray)
	{
		return self::$instance->sfh->processSubmitRequest($processRequestArray);
	}
	
	public static function processWorkitemRequest($processRequestArray)
	{
		return self::$instance->sfh->processWorkitemRequest($processRequestArray);
	}
	
	public static function describeGlobal()
	{
		return self::$instance->sfh->describeGlobal();
	}
	
	public static function describeLayout($type, array $recordTypeIds = NULL)
	{
		return self::$instance->sfh->describeLayout($type, $recordTypeIds);
	}
	
	public static function describeSObject($type)
	{
		return self::$instance->sfh->describeSObject($type);
	}
	
	public static function describeSObjects($arrayOfTypes)
	{
		return self::$instance->sfh->describeSObjects($arrayOfTypes);
	}
	
	public static function describeTabs()
	{
		return self::$instance->sfh->describeTabs();
	}
	
	public static function describeDataCategoryGroups($sObjectType)
	{
		return self::$instance->sfh->describeDataCategoryGroups($sObjectType);
	}
	
	public static function describeDataCategoryGroupStructures(array $pairs, $topCategoriesOnly)
	{
		return self::$instance->sfh->describeDataCategoryGroupStructures($pairs, $topCategoriesOnly);
	}
	
	public static function getDeleted($type, $startDate, $endDate)
	{
		return self::$instance->sfh->getDeleted($type, $startDate, $endDate);
	}
	
	public static function getUpdated($type, $startDate, $endDate)
	{
		return self::$instance->sfh->getUpdated($type, $startDate, $endDate);
	}
	
	public static function query($query)
	{
		return self::$instance->sfh->query($query);
	}
	
	public static function queryMore($queryLocator)
	{
		return self::$instance->sfh->queryMore($queryLocator);
	}
	
	public static function queryAll($query, $queryOptions = NULL)
	{
		return self::$instance->sfh->queryAll($query, $queryOptions);
	}
	
	public static function retrieve($fieldList, $sObjectType, $ids)
	{
		return self::$instance->sfh->retrieve($fieldList, $sObjectType, $ids);
	}
	
	public static function search($searchString)
	{
		return self::$instance->sfh->search($searchString);
	}
	
	public static function getServerTimestamp()
	{
		return self::$instance->sfh->getServerTimestamp();
	}
	
	public static function getUserInfo()
	{
		return self::$instance->sfh->getUserInfo();
	}
	
	public static function setPassword($userId, $password)
	{
		return self::$instance->sfh->setPassword($userId, $password);
	}
	
	public static function resetPassword($userId)
	{
		return self::$instance->sfh->resetPassword($userId);
	}
	
	/*
	 * Debugging functions
	 */
	public static function dump()
	{
		$str = print_r(self::$instance , true);
		$str .= print_r(self::$instance->sfh , true);
	}
}
?>
