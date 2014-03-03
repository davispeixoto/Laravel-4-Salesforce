<?php namespace Davispeixoto\LaravelSalesforce;

use Davispeixoto\ForceDotComToolkitForPhp\SforceEnterpriseClient as Client;

class Salesforce {
	protected $sfh;
	
	public function __construct($username , $password , $token)
	{
		try {
			$this->sfh = new Client();
			$this->sfh->createConnection(__DIR__.'/Wsdl/enterprise.wsdl.xml');
			$this->sfh->login($username, $password.$token);
		} catch (Exception $e) {
			Log::error($e->getMessage());
			throw $e;
		}
	}
	
	/*
	 * Enterprise client functions
	 */
	public static function create($sObjects, $type)
	{
		return $this->sfh->create($sObjects, $type);
	}
	
	public static function update($sObjects, $type, $assignment_header = NULL, $mru_header = NULL)
	{
		return $this->sfh->update($sObjects, $type, $assignment_header, $mru_header);
	}
	
	public static function upsert($ext_Id, $sObjects, $type = 'Contact')
	{
		return $this->sfh->upsert($ext_Id, $sObjects, $type);
	}
	
	public function merge($mergeRequest, $type)
	{
		return $this->sfh->merge($mergeRequest, $type);
	}
	
	/*
	 * Base Client functions
	 */
	public static function getNamespace()
	{
		return $this->sfh->getNamespace();
	}
	
	public static function printDebugInfo()
	{
		return $this->sfh->printDebugInfo();
	}
	
	public static function createConnection($wsdl, $proxy = NULL, $soap_options = array())
	{
		return $this->sfh->createConnection($wsdl, $proxy, $soap_options);
	}
	
	public static function setCallOptions($header)
	{
		return $this->sfh->setCallOptions($header);
	}
	
	public static function login($username, $password)
	{
		return $this->sfh->login($username, $password);
	}
	
	public static function logout()
	{
		return $this->sfh->logout();
	}
	
	public static function invalidateSessions()
	{
		return $this->sfh->invalidateSessions();
	}
	
	public static function setEndpoint($location)
	{
		return $this->sfh->setEndpoint($location);
	}
	
	public static function setAssignmentRuleHeader($header)
	{
		return $this->sfh->setAssignmentRuleHeader($header);
	}
	
	public static function setEmailHeader($header)
	{
		return $this->sfh->setEmailHeader($header);
	}
	
	public static function setLoginScopeHeader($header)
	{
		return $this->sfh->setLoginScopeHeader($header);
	}
	
	public static function setMruHeader($header)
	{
		return $this->sfh->setMruHeader($header);
	}
	
	public static function setSessionHeader($id)
	{
		return $this->sfh->setSessionHeader($id);
	}
	
	public static function setUserTerritoryDeleteHeader($header)
	{
		return $this->sfh->setUserTerritoryDeleteHeader($header);
	}
	
	public static function setQueryOptions($header)
	{
		return $this->sfh->setQueryOptions($header);
	}
	
	public static function setAllowFieldTruncationHeader($header)
	{
		return $this->sfh->setAllowFieldTruncationHeader($header);
	}
	
	public static function setLocaleOptions($header)
	{
		return $this->sfh->setLocaleOptions($header);
	}
	
	public static function setPackageVersionHeader($header)
	{
		return $this->sfh->setPackageVersionHeader($header);
	}
	
	public static function getSessionId()
	{
		return $this->sfh->getSessionId();
	}
	
	public static function getLocation()
	{
		return $this->sfh->getLocation();
	}
	
	public static function getConnection()
	{
		return $this->sfh->getConnection();
	}
	
	public static function getFunctions()
	{
		return $this->sfh->getFunctions();
	}
	
	public static function getTypes()
	{
		return $this->sfh->getTypes();
	}
	
	public static function getLastRequest()
	{
		return $this->sfh->getLastRequest();
	}
	
	public static function getLastRequestHeaders()
	{
		return $this->sfh->getLastRequestHeaders();
	}
	
	public static function getLastResponse()
	{
		return $this->sfh->getLastResponse();
	}
	
	public static function getLastResponseHeaders()
	{
		return $this->sfh->getLastResponseHeaders();
	}
	
	public static function sendSingleEmail($request)
	{
		return $this->sfh->sendSingleEmail($request);
	}
	
	public static function sendMassEmail($request)
	{
		return $this->sfh->sendMassEmail($request);
	}
	
	public static function convertLead($leadConverts)
	{
		return $this->sfh->convertLead($leadConverts);
	}
	
	public static function delete($ids)
	{
		return $this->sfh->delete($ids);
	}
	
	public static function undelete($ids)
	{
		return $this->sfh->undelete($ids);
	}
	
	public static function emptyRecycleBin($ids)
	{
		return $this->sfh->emptyRecycleBin($ids);
	}
	
	public static function processSubmitRequest($processRequestArray)
	{
		return $this->sfh->processSubmitRequest($processRequestArray);
	}
	
	public static function processWorkitemRequest($processRequestArray)
	{
		return $this->sfh->processWorkitemRequest($processRequestArray);
	}
	
	public static function describeGlobal()
	{
		return $this->sfh->describeGlobal();
	}
	
	public static function describeLayout($type, array $recordTypeIds = NULL)
	{
		return $this->sfh->describeLayout($type, $recordTypeIds);
	}
	
	public static function describeSObject($type)
	{
		return $this->sfh->describeSObject($type);
	}
	
	public static function describeSObjects($arrayOfTypes)
	{
		return $this->sfh->describeSObjects($arrayOfTypes);
	}
	
	public static function describeTabs()
	{
		return $this->sfh->describeTabs();
	}
	
	public static function describeDataCategoryGroups($sObjectType)
	{
		return $this->sfh->describeDataCategoryGroups($sObjectType);
	}
	
	public static function describeDataCategoryGroupStructures(array $pairs, $topCategoriesOnly)
	{
		return $this->sfh->describeDataCategoryGroupStructures($pairs, $topCategoriesOnly);
	}
	
	public static function getDeleted($type, $startDate, $endDate)
	{
		return $this->sfh->getDeleted($type, $startDate, $endDate);
	}
	
	public static function getUpdated($type, $startDate, $endDate)
	{
		return $this->sfh->getUpdated($type, $startDate, $endDate);
	}
	
	public static function query($query)
	{
		return $this->sfh->query($query);
	}
	
	public static function queryMore($queryLocator)
	{
		return $this->sfh->queryMore($queryLocator);
	}
	
	public static function queryAll($query, $queryOptions = NULL)
	{
		return $this->sfh->queryAll($query, $queryOptions);
	}
	
	public static function retrieve($fieldList, $sObjectType, $ids)
	{
		return $this->sfh->retrieve($fieldList, $sObjectType, $ids);
	}
	
	public static function search($searchString)
	{
		return $this->sfh->search($searchString);
	}
	
	public static function getServerTimestamp()
	{
		return $this->sfh->getServerTimestamp();
	}
	
	public static function getUserInfo()
	{
		return $this->sfh->getUserInfo();
	}
	
	public static function setPassword($userId, $password)
	{
		return $this->sfh->setPassword($userId, $password);
	}
	
	public static function resetPassword($userId)
	{
		return $this->sfh->resetPassword($userId);
	}
}
?>