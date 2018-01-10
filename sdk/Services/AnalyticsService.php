<?php

namespace Mambo\Services;

use Mambo\Common\MamboBaseAbstract;
use Mambo\Common\MamboClient;
use Mambo\Common\APIUrlBuilder;

/*
 * Copyright (C) 2014-2017 Mambo Solutions Ltd.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
/**
 * The MamboAnalyticsService class handles all Analytic related requests
 * to the Mambo API.
 */
class MamboAnalyticsService extends MamboBaseAbstract
{
	/**
	 * Analytic service end point URI
	 * @var string
	 */
	const ANALYTICS_SITE_URI = "/v1/{site}/analytics";
	const ANALYTICS_REGENERATE_URI = "/v1/{site}/analytics/regenerate";


	/**
	 * Regenerate a analytic's for a site from the ground up.
	 * Note: this can take some time depending on the number of activities
	 * that need to be processed. The processing will happen asynchronously.
	 *
	 * @param string $siteUrl	The site for which to regenerate the analytics
	 * @return
	 */
	public static function regenerate( $siteUrl )
	{
		// Initialise the client if necessary
		self::initClient();

		// Make the request
		return self::$client->request( self::getUrl( self::ANALYTICS_REGENERATE_URI, $siteUrl ), MamboClient::POST );
	}


	/**
	 * Get the list of analytics for the specified site.
	 *
	 * @param string $siteUrl		The site for which to retrieve the list of analytics
     * @param string dataType		Specifies the type of analytics data to return
     * @param string reportType		Specifies the analytics report type to return
	 * @param string $startDate		Specifies the start date of the date range filter
	 * @param string $endDate		Specifies the end date of the date range filter
	 * @param boolean $withHours	Whether the analytics object should contain the hourly breakdown.
	 								Note that only the daily reports have hourly breakdowns available.
	 * @param integer page			Specifies the page of results to retrieve
	 * @param integer count			Specifies the number of results to retrieve, up to a maximum of 100
	 * @return
	 */
	public static function getAnalytics( $siteUrl, $dataType, $reportType, $startDate = null, $endDate = null,
										$withHours = null, $page = null, $count = null )
	{
		// Initialise the client if necessary
		self::initClient();

		// Prepare the URL
		$builder = new APIUrlBuilder();
		$url = self::getUrl( self::ANALYTICS_SITE_URI, $siteUrl );
		$fullUrl = $builder->url( $url )
						  ->dataType( $dataType )
						  ->reportType( $reportType )
						  ->startDate( $startDate )
						  ->endDate( $endDate )
						  ->withHours( $withHours )
						  ->page( $page )
						  ->count( $count )
						  ->build();

		// Make the request
		return self::$client->request( $fullUrl, MamboClient::GET );
	}
}

?>
