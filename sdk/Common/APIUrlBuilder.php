<?php

namespace Mambo\Common;

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
 * Utility class used to build the relevant query strings
 */
class APIUrlBuilder
{
	private $queryString = "";
	private $url = null;


	public function url( $url ) {
		$this->url = $url;
		return $this;
	}


	public function page( $page )
	{
		if( is_null( $page ) )
			return $this;

		$this->queryString .= "&page=";
		$this->queryString .= $page;
		return $this;
	}


	public function count( $count )
	{
		if( is_null( $count ) )
			return $this;

		$this->queryString .= "&count=";
		$this->queryString .= $count;
		return $this;
	}


	public function contextual( $contextual )
	{
		if( is_null( $contextual ) )
			return $this;

		$this->queryString .= "&contextual=";
		$this->queryString .= $contextual;
		return $this;
	}


	public function tags( $tags )
	{
		if( is_null( $tags ) || !is_array( $tags ) || empty( $tags ) )
			return $this;

		foreach( $tags as $tag ) {
			$this->queryString .= "&tags=";
			$this->queryString .= $tag;
		}
		return $this;
	}


	public function tagsJoin( $tagsJoin )
	{
		if( is_null( $tagsJoin ) )
			return $this;

		$this->queryString .= "&tagsJoin=";
		$this->queryString .= $tagsJoin;
		return $this;
	}


	public function tagUuid( $tagUuid )
	{
		if( is_null( $tagUuid ) )
			return $this;

		$this->queryString .= "&tagUuid=";
		$this->queryString .= $tagUuid;
		return $this;
	}


	public function tag( $tag )
	{
		if( is_null( $tag ) )
			return $this;

		$this->queryString .= "&tag=";
		$this->queryString .= $tag;
		return $this;
	}


	public function period( $period )
	{
		if( is_null( $period ) )
			return $this;

		if( strcmp( $period, 'day') != 0 &&
			strcmp( $period, 'week') != 0 &&
			strcmp( $period, 'month') != 0 &&
			strcmp( $period, 'all') != 0 )
		{
			trigger_error( "The value specified for period is invalid. Allowed values: day, week, month, all", E_USER_ERROR );
		}

		$this->queryString .= "&period=";
		$this->queryString .= $period;
		return $this;
	}


	public function withUsers( $withUsers )
	{
		if( is_null( $withUsers ) )
			return $this;

		$this->queryString .= "&withUsers=";
		$this->queryString .= $withUsers;
		return $this;
	}


	public function withPersonalization( $withPersonalization )
	{
		if( is_null( $withPersonalization ) )
			return $this;

		$this->queryString .= "&withPersonalization=";
		$this->queryString .= $withPersonalization;
		return $this;
	}


	public function withActivities( $withActivities )
	{
		if( is_null( $withActivities ) )
			return $this;

		$this->queryString .= "&withActivities=";
		$this->queryString .= $withActivities;
		return $this;
	}


	public function withRead( $withRead )
	{
		if( is_null( $withRead ) )
			return $this;

		$this->queryString .= "&withRead=";
		$this->queryString .= $withRead;
		return $this;
	}


	public function withBehavioursOnly( $withBehavioursOnly )
	{
		if( is_null( $withBehavioursOnly ) )
			return $this;

		$this->queryString .= "&withBehavioursOnly=";
		$this->queryString .= $withBehavioursOnly;
		return $this;
	}


	public function withRewardsOnly( $withRewardsOnly )
	{
		if( is_null( $withRewardsOnly ) )
			return $this;

		$this->queryString .= "&withRewardsOnly=";
		$this->queryString .= $withRewardsOnly;
		return $this;
	}


	public function withMissionsOnly( $withMissionsOnly )
	{
		if( is_null( $withMissionsOnly ) )
			return $this;

		$this->queryString .= "&withMissionsOnly=";
		$this->queryString .= $withMissionsOnly;
		return $this;
	}


	public function withLevelsOnly( $withLevelsOnly )
	{
		if( is_null( $withLevelsOnly ) )
			return $this;

		$this->queryString .= "&withLevelsOnly=";
		$this->queryString .= $withLevelsOnly;
		return $this;
	}


	public function withAchievementsOnly( $withAchievementsOnly )
	{
		if( is_null( $withAchievementsOnly ) )
			return $this;

		$this->queryString .= "&withAchievementsOnly=";
		$this->queryString .= $withAchievementsOnly;
		return $this;
	}


	public function withGiftsOnly( $withGiftsOnly )
	{
		if( is_null( $withGiftsOnly ) )
			return $this;

		$this->queryString .= "&withGiftsOnly=";
		$this->queryString .= $withGiftsOnly;
		return $this;
	}


	public function withTargetUser( $withTargetUser )
	{
		if( is_null( $withTargetUser ) )
			return $this;

		$this->queryString .= "&withTargetUser=";
		$this->queryString .= $withTargetUser;
		return $this;
	}


	public function withInternalPoints( $withInternalPoints )
	{
		if( is_null( $withInternalPoints ) )
			return $this;

		$this->queryString .= "&withInternalPoints=";
		$this->queryString .= $withInternalPoints;
		return $this;
	}


	public function withExceptions( $withExceptions )
	{
		if( is_null( $withExceptions ) )
			return $this;

		$this->queryString .= "&withExceptions=";
		$this->queryString .= $withExceptions;
		return $this;
	}


	public function dataType( $dataType )
	{
		if( is_null( $dataType ) )
			return $this;

		$this->queryString .= "&dataType=";
		$this->queryString .= $dataType;
		return $this;
	}


	public function reportType( $reportType )
	{
		if( is_null( $reportType ) )
			return $this;

		$this->queryString .= "&reportType=";
		$this->queryString .= $reportType;
		return $this;
	}


	public function startDate( $startDate )
	{
		if( is_null( $startDate ) )
			return $this;

		$this->queryString .= "&startDate=";
		$this->queryString .= $startDate;
		return $this;
	}


	public function endDate( $endDate )
	{
		if( is_null( $endDate ) )
			return $this;

		$this->queryString .= "&endDate=";
		$this->queryString .= $endDate;
		return $this;
	}


	public function withHours( $withHours )
	{
		if( is_null( $withHours ) )
			return $this;

		$this->queryString .= "&withHours=";
		$this->queryString .= $withHours;
		return $this;
	}


	public function orderBy( $orderBy )
	{
		if( is_null( $orderBy ) )
			return $this;

		if( strcmp( $orderBy, 'uuid') != 0 && strcmp( $orderBy, 'email') != 0 &&
				strcmp( $orderBy, 'createdOn') != 0 && strcmp( $orderBy, 'totalPoints') != 0 &&
				strcmp( $orderBy, 'totalSpend') != 0 && strcmp( $orderBy, 'totalCouponSpend') != 0 &&
				strcmp( $orderBy, 'avgSpend') != 0 && strcmp( $orderBy, 'avgCouponSpend') != 0 &&
				strcmp( $orderBy, 'achievements') != 0 && strcmp( $orderBy, 'levels') != 0 &&
				strcmp( $orderBy, 'missions') != 0 && strcmp( $orderBy, 'rewards') != 0 &&
				strcmp( $orderBy, 'purchases') != 0 && strcmp( $orderBy, 'couponPurchases') != 0 &&
				strcmp( $orderBy, 'coupons') != 0 && strcmp( $orderBy, 'isMember') != 0 &&
				strcmp( $orderBy, 'lastSeenOn') != 0 && strcmp( $orderBy, 'memberSince') != 0 &&
				strcmp( $orderBy, 'pointsSpent') != 0 && strcmp( $orderBy, 'pointsBalance') != 0 )
		{
			trigger_error( "The value specified for orderBy is invalid. Allowed values: uuid, email,
					createdOn, totalPoints, pointsSpent, pointsBalance, totalSpend, totalCouponSpend,
					avgSpend, avgCouponSpend, achievements, levels, missions, rewards, purchases,
					couponPurchases, coupons, isMember, lastSeenOn, memberSince, pointsSpent, pointsBalance", E_USER_ERROR );
		}

		$this->queryString .= "&orderBy=";
		$this->queryString .= $orderBy;
		return $this;
	}


	public function order( $order )
	{
		if( is_null( $order ) )
			return $this;

		if( strcmp( $order, 'desc') != 0 &&
			strcmp( $order, 'asc') != 0 )
		{
			trigger_error( "The value specified for order is invalid. Allowed values: asc, desc", E_USER_ERROR );
		}

		$this->queryString .= "&order=";
		$this->queryString .= $order;
		return $this;
	}


	public function query( $query )
	{
		if( is_null( $query ) )
			return $this;

		$this->queryString .= "&query=";
		$this->queryString .= $query;
		return $this;
	}


	public function pointIds( $pointIds )
	{
		if( is_null( $pointIds ) || !is_array( $pointIds ) || empty( $pointIds ) )
			return $this;

		foreach( $pointIds as $pointId ) {
			$this->queryString .= "&pointIds=";
			$this->queryString .= $pointId;
		}
		return $this;
	}


	public function rewardIds( $rewardIds )
	{
		if( is_null( $rewardIds ) || !is_array( $rewardIds ) || empty( $rewardIds ) )
			return $this;

		foreach( $rewardIds as $rewardId ) {
			$this->queryString .= "&rewardIds=";
			$this->queryString .= $rewardId;
		}
		return $this;
	}


	public function behaviourIds( $behaviourIds )
	{
		if( is_null( $behaviourIds ) || !is_array( $behaviourIds ) || empty( $behaviourIds ) )
			return $this;

		foreach( $behaviourIds as $behaviourId ) {
			$this->queryString .= "&behaviourIds=";
			$this->queryString .= $behaviourId;
		}
		return $this;
	}


	public function build()
	{
		if( is_null( $this->url ) ) {
			trigger_error( "Did you forget to add a URL?", E_USER_ERROR );
		}

		return $this->url . $this->getFormattedQueryString();
	}


	private function getFormattedQueryString()
	{
		if( empty( $this->queryString ) )
			return "";

		return preg_replace( '/&/', '?', $this->queryString, 1 );
	}
}
?>
