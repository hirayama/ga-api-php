<?php

/**
 * ga_analytics
 * 
 * - google analyticsのapiを継承したクラスです
 * - gaに繋いで情報処理する他のcoreファイルから継承されることを想定しており、共通処理を記述します
 * 
 * @author  Tomohiro Hirayama
 * @created 2017-07-07
 * @version 1.0
 */
require_once(dirname(__FILE__) . '/ga_api/vendor/autoload.php');
require_once(dirname(__FILE__) . '/ga_constants.php');
require_once(dirname(__FILE__) . '/ga_request.php');
class ga_analytics extends Google_Service_AnalyticsReporting
{
	function __construct($scope)
	{
		// load client
		$client = $this->_make_client($scope);

		// make Google Service Analytics
		parent::__construct($client);
	}

	public function get_table($requests)
	{
		$report = $this->get_report($requests);
		$data = $report[0]->getData()->getRows();
		$header = $report[0]->getColumnHeader();
		$dimensions = array_map(function($e) { return preg_replace('/ga:/','',$e); }, $header->getDimensions());
		$metrics = array_map(function($e) { return $e->getName();; }, $header->getMetricHeader()->getMetricHeaderEntries());
		$cols = array_merge($dimensions, $metrics);
		$rows = array_map(function($row) {
			$_metrics = $row->getMetrics();
			return array_merge($row->getDimensions(), $_metrics[0]->getValues());
		}, $data); 
		return array('cols' => $cols, 'rows' => $rows);
	}

	public function get_report($requests)
	{
		// Create the GetReportsRequest object.
		$getReport = new Google_Service_AnalyticsReporting_GetReportsRequest();
		$getReport->setReportRequests($requests);
		$response = $this->reports->batchGet($getReport);

		return $response->getReports();
	}

	/**
	 * 接続に必要なクライアントインスタンスを作成する
	 *
	 * @param [type] $scope
	 * @return void
	 */
	private function _make_client($scope)
	{
		$client = new Google_Client();
		$client->setApplicationName("Hello Analytics Reporting");
		$client->setAuthConfig(KEY_FILE_LOCATION);
		$client->setScopes([GA_SCOPE::READONLY]);
		return $client;
	}
}