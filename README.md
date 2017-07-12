# ga-api-php
Simple Google Analytics Api library

## Install

1. DL vendor scripts. [here](https://github.com/google/google-api-php-client/releases)

## Examples

```php

class web_bounce_request extends ga_request
{
    function __construct($options = array())
    {
        $this->set_options($options);
        parent::__construct();
    }

    public function create($from, $to, $path, $channel, $segment)
    {
        $this->_request->setViewId(GA_PROFILES::WEB);

        // DateRange
        $dateRange = $this->get_date_range($from, $to);
        $this->_request->setDateRanges($dateRange);

        // Metrics
        $metrics = array();
        $metrics[] = $this->get_metric('ga:exitRate', 'exitRate');
        $metrics[] = $this->get_metric('ga:uniquePageviews', 'page_session');
        $metrics[] = $this->get_metric('ga:avgTimeOnPage', 'spent_time');
        $metrics[] = $this->get_metric('ga:bounceRate', 'bounce_rate');
        $metrics[] = $this->get_metric('ga:entrances', 'entraces');
        $this->_request->setMetrics($metrics);

        // Metric filter
        $metric_filters = array();
        $metric_filters[] = $this->get_metric_filter('ga:entrances', GA_METRIC_OPE::GREATER_THAN, $this->_min_land_views);
        $metric_filters[] = $this->get_metric_filter('ga:uniquePageviews', GA_METRIC_OPE::GREATER_THAN, $this->_min_unique_page_views);
        $this->_request->setMetricFilterClauses($metric_filters);

        // Dimensions
        $dimensions = array();
        $dimensions[] = $this->get_dimension('ga:pagePath');
        $dimensions[] = $this->get_dimension('ga:channelGrouping');
        $dimensions[] = $this->get_dimension('ga:segment');
        $this->_request->setDimensions($dimensions);

        // Dimension filter
        $dimension_filters = array();
        $dimension_filters[] = $this->get_dimension_filter('ga:pagePath', GA_DIMENSION_OPE::REGEXP, array($path));
        $dimension_filters[] = $this->get_dimension_filter('ga:channelGrouping', GA_DIMENSION_OPE::REGEXP, array($channel));
        $this->_request->setDimensionFilterClauses($dimension_filters);

        // Order by
        $session_order = $this->get_order_by('ga:bounceRate', 'VALUE', GA_ORDER::ASC);
        $this->_request->setOrderBys($session_order);

        // Segment
        $segments = array();
        $segments[] = $this->get_pc_segment();
        $this->_request->setSegments($segments);

        // Page size
        $this->_request->setPageSize($this->_size);
    }
}

$request = new web_bounce_request();
$request->create(
    $date_from, $date_to,
    $_path, $_channel, $_device
);
$report = $analytics->get_table(array($request->get_request()));

```
