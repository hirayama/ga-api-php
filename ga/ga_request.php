<?php

/**
 * ga_request
 * 
 * Google_Service_AnalyticsReporting_ReportRequestはoverrideできないので委譲します
 * 
 * operatorの一覧
 * https://developers.google.com/analytics/devguides/reporting/core/v4/rest/v4/reports/batchGet?hl=ja
 * Metric, Dimensionの一覧
 * https://developers.google.com/analytics/devguides/reporting/core/dimsmets
 * 
 * @author  Tomohiro Hirayama
 * @created 2017-07-07
 * @version 1.0
 */
class ga_request
{
	protected $_request = NULL;

	function __construct()
	{
		$this->_request = new Google_Service_AnalyticsReporting_ReportRequest();
	}

	public function get_request()
	{
		return $this->_request;
	}

	public function get_metric($name, $alias)
	{
        $metric = new Google_Service_AnalyticsReporting_Metric();
        $metric->setExpression($name);
        $metric->setAlias($alias);
		return $metric;
	}

	public function get_dimension($name)
	{
        $dimension = new Google_Service_AnalyticsReporting_Dimension();
        $dimension->setName($name);
		return $dimension;
	}

	public function get_dimension_filter($name, $ope, $exp)
	{
		// Create the DimensionFilter.
		$dimensionFilter = new Google_Service_AnalyticsReporting_DimensionFilter();
		$dimensionFilter->setDimensionName($name);
		$dimensionFilter->setOperator($ope);
		$dimensionFilter->setExpressions($exp);

		// Create the DimensionFilterClauses
		$dimensionFilterClause = new Google_Service_AnalyticsReporting_DimensionFilterClause();
		$dimensionFilterClause->setFilters(array($dimensionFilter));
		return $dimensionFilterClause;
	}

	public function get_metric_filter($name, $ope, $exp)
	{
		$metricFilter = new Google_Service_AnalyticsReporting_MetricFilter();
		$metricFilter->setMetricName($name);
		$metricFilter->setOperator($ope);
		$metricFilter->setComparisonValue($exp);

		$metricFilterClause = new Google_Service_AnalyticsReporting_MetricFilterClause();
		$metricFilterClause->setFilters(array($metricFilter));
		return $metricFilterClause;
	}

	public function get_order_by($name, $type, $order)
	{
        $orderby = new Google_Service_AnalyticsReporting_OrderBy();
        $orderby->setFieldName($name);
        $orderby->setOrderType($type);
        $orderby->setSortOrder($order);

		return $orderby;
	}

	public function get_date_range($from, $to)
	{
		$dateRange = new Google_Service_AnalyticsReporting_DateRange();
		$dateRange->setStartDate($from);
		$dateRange->setEndDate($to);

		return $dateRange;
	}
}