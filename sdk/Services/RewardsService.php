<?php

namespace Mambo\Services;

use Mambo\Common\MamboBaseAbstract;
use Mambo\Common\APIUrlBuilder;
use Mambo\Common\MamboClient;

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
 * The MamboRewardsService class handles all Reward related requests
 * to the Mambo API.
 */
class MamboRewardsService extends MamboBaseAbstract
{
	/**
	 * Reward service end point URIs
	 * @var string
	 */
	const REWARDS_URI = "/v1/rewards";
	const REWARDS_ID_URI = "/v1/rewards/{id}";
	const REWARDS_IMAGE_URI = "/v1/rewards/{id}/image";
	const REWARDS_CLONE_URI = "/v1/rewards/{id}/clone";
	const REWARDS_CUSTOM_URI = "/v1/rewards/{id}/custom_fields";

	const REWARDS_SITE_URI = "/v1/{site}/rewards";
	const ACHIEVEMENTS_SITE_URI = "/v1/{site}/rewards/achievements";
	const LEVELS_SITE_URI = "/v1/{site}/rewards/levels";
	const MISSIONS_SITE_URI = "/v1/{site}/rewards/missions";
	const GIFTS_SITE_URI = "/v1/{site}/rewards/gifts";


	/**
	 * This method is used to create a new reward.
	 *
	 * @param string siteUrl				The site to which the reward belongs to
	 * @param RewardRequestData data		The data sent to the API in order to create a reward
	 * @param boolean withInternalPoints	Whether internalOnly points should be returned in the response
	 * @return
	 */
	public static function create( $siteUrl, $data, $withInternalPoints = null )
	{
		// Initialise the client if necessary
		self::initClient();

		// Check the request data is valid
		if( !( $data instanceof Data\RewardRequestData ) )
		{
			trigger_error( "The data should be of type RewardRequestData", E_USER_ERROR );
		}

		// Prepare the URL
		$builder = new APIUrlBuilder();
		$url = self::getUrl( self::REWARDS_SITE_URI, $siteUrl );
		$fullUrl = $builder->url( $url )
						  ->withInternalPoints( $withInternalPoints )
						  ->build();

		// Make the request
		return self::$client->request( $fullUrl, MamboClient::POST, $data->getJsonString() );
	}


	/**
	 * Update an existing reward by ID.
	 *
	 * @param string id					The ID of the reward to update
	 * @param RewardRequestData data	The data with which to update the specified reward object
	 * @param boolean withInternalPoints	Whether internalOnly points should be returned in the response
	 * @return
	 */
	public static function update( $id, $data, $withInternalPoints = null )
	{
		// Initialise the client if necessary
		self::initClient();

		// Check the request data is valid
		if( !( $data instanceof Data\RewardRequestData ) )
		{
			trigger_error( "The data should be of type RewardRequestData", E_USER_ERROR );
		}

		// Prepare the URL
		$builder = new APIUrlBuilder();
		$url = self::getWithId( self::REWARDS_ID_URI, $id );
		$fullUrl = $builder->url( $url )
						  ->withInternalPoints( $withInternalPoints )
						  ->build();

		// Make the request
		return self::$client->request( $fullUrl, MamboClient::PUT, $data->getJsonString() );
	}


	/**
	 * Upload an image for the reward
	 *
	 * @param string id		The reward for which to upload the image
	 * @param data image 	The image to upload for the reward
	 * @param boolean withInternalPoints	Whether internalOnly points should be returned in the response
	 * @return
	 */
	public static function uploadImage( $id, $image, $withInternalPoints = null )
	{
		// Initialise the client if necessary
		self::initClient();

		// Check the request data is valid
		if( is_null( $image ) || empty( $image ) )
		{
			trigger_error( "The image must not be empty", E_USER_ERROR );
		}

		// Prepare the URL
		$builder = new APIUrlBuilder();
		$url = self::getWithId( self::REWARDS_IMAGE_URI, $id );
		$fullUrl = $builder->url( $url )
						  ->withInternalPoints( $withInternalPoints )
						  ->build();

		// Make the request
		return self::$client->upload( $fullUrl, $image );
	}


	/**
	 * Clone a reward
	 *
	 * @param string id		The ID of the reward to clone
	 * @return
	 */
	public static function cloneReward( $id )
	{
		// Initialise the client if necessary
		self::initClient();

		// Make the request
		return self::$client->request( self::getWithId( self::REWARDS_CLONE_URI, $id ), MamboClient::POST );
	}


	/**
	 * Delete a reward by it's ID
	 *
	 * @param string id				The ID of the reward to delete
	 * @return
	 */
	public static function delete( $id )
	{
		// Initialise the client if necessary
		self::initClient();

		// Make the request
		return self::$client->request( self::getWithId( self::REWARDS_ID_URI, $id ), MamboClient::DELETE );
	}


	/**
	 * Delete a list of rewards by their ID
	 *
	 * @param string ids		The list of IDs of the reward to delete
	 * @return
	 */
	public static function deleteRewards( $data )
	{
		// Initialise the client if necessary
		self::initClient();

		// Check the request data is valid
		if( !( $data instanceof Data\DeleteRequestData ) )
		{
			trigger_error( "The data should be of type DeleteRequestData", E_USER_ERROR );
		}

		// Make the request
		return self::$client->request( self::REWARDS_URI, MamboClient::DELETE, $data->getJsonString() );
	}


	/**
	 * Get a reward by it's ID
	 *
	 * @param string id			The ID of the reward to retrieve
	 * @param boolean withInternalPoints	Whether internalOnly points should be returned in the response
	 * @return
	 */
	public static function get( $id, $withInternalPoints = null )
	{
		// Initialise the client if necessary
		self::initClient();

		// Prepare the URL
		$builder = new APIUrlBuilder();
		$url = self::getWithId( self::REWARDS_ID_URI, $id );
		$fullUrl = $builder->url( $url )
						  ->withInternalPoints( $withInternalPoints )
						  ->build();

		// Make the request
		return self::$client->request( $fullUrl, MamboClient::GET );
	}


	/**
	 * Get the list of rewards for the specified site
	 *
	 * @param string $siteUrl	The site for which to retrieve the list of rewards
	 * @param array tags		The list of tags to filter by (if any)
	 * @param string tagsJoin	Whether the tags should return items containing any one of the tags or
	 * 							whether the tags should return only items containing all of the tags.
	 * 							Possible values: hasAnyOf / hasAllOf
	 * @param string tagUuid	The tagUuid to use to filter the list by personalization tags
	 * @param boolean withInternalPoints	Whether internalOnly points should be returned in the response
	 * @param array pointIds	The list of point IDs to filter by (if any)
	 * @return
	 */
	public static function getRewards( $siteUrl, $tags = null, $tagsJoin = null, $tagUuid = null, $withInternalPoints = null, $pointIds = null )
	{
		// Initialise the client if necessary
		self::initClient();

		// Prepare the URL
		$builder = new APIUrlBuilder();
		$url = self::getUrl( self::REWARDS_SITE_URI, $siteUrl );
		$fullUrl = $builder->url( $url )
						  ->tags( $tags )
						  ->tagsJoin( $tagsJoin )
						  ->tagUuid( $tagUuid )
						  ->withInternalPoints( $withInternalPoints )
						  ->pointIds( $pointIds )
						  ->build();

		// Make the request
		return self::$client->request( $fullUrl, MamboClient::GET );
	}


	/**
	 * Get the list of achievements for the specified site
	 *
	 * @param string $siteUrl	The site for which to retrieve the list of achievements
	 * @param array tags		The list of tags to filter by (if any)
	 * @param string tagsJoin	Whether the tags should return items containing any one of the tags or
	 * 							whether the tags should return only items containing all of the tags.
	 * 							Possible values: hasAnyOf / hasAllOf
	 * @param string tagUuid	The tagUuid to use to filter the list by personalization tags
	 * @param boolean withInternalPoints	Whether internalOnly points should be returned in the response
	 * @param array pointIds	The list of point IDs to filter by (if any)
	 * @return
	 */
	public static function getAchievements( $siteUrl, $tags = null, $tagsJoin = null, $tagUuid = null, $withInternalPoints = null, $pointIds = null )
	{
		// Initialise the client if necessary
		self::initClient();

		// Prepare the URL
		$builder = new APIUrlBuilder();
		$url = self::getUrl( self::ACHIEVEMENTS_SITE_URI, $siteUrl );
		$fullUrl = $builder->url( $url )
						  ->tags( $tags )
						  ->tagsJoin( $tagsJoin )
						  ->tagUuid( $tagUuid )
						  ->withInternalPoints( $withInternalPoints )
						  ->pointIds( $pointIds )
						  ->build();

		// Make the request
		return self::$client->request( $fullUrl, MamboClient::GET );
	}


	/**
	 * Get the list of levels for the specified site
	 *
	 * @param string $siteUrl	The site for which to retrieve the list of levels
	 * @param array tags		The list of tags to filter by (if any)
	 * @param string tagsJoin	Whether the tags should return items containing any one of the tags or
	 * 							whether the tags should return only items containing all of the tags.
	 * 							Possible values: hasAnyOf / hasAllOf
	 * @param string tagUuid	The tagUuid to use to filter the list by personalization tags
	 * @param boolean withInternalPoints	Whether internalOnly points should be returned in the response
	 * @param array pointIds	The list of point IDs to filter by (if any)
	 * @return
	 */
	public static function getLevels( $siteUrl, $tags = null, $tagsJoin = null, $tagUuid = null, $withInternalPoints = null, $pointIds = null )
	{
		// Initialise the client if necessary
		self::initClient();

		// Prepare the URL
		$builder = new APIUrlBuilder();
		$url = self::getUrl( self::LEVELS_SITE_URI, $siteUrl );
		$fullUrl = $builder->url( $url )
						  ->tags( $tags )
						  ->tagsJoin( $tagsJoin )
						  ->tagUuid( $tagUuid )
						  ->withInternalPoints( $withInternalPoints )
						  ->pointIds( $pointIds )
						  ->build();

		// Make the request
		return self::$client->request( $fullUrl, MamboClient::GET );
	}


	/**
	 * Get the list of missions for the specified site
	 *
	 * @param string $siteUrl	The site for which to retrieve the list of missions
	 * @param array tags		The list of tags to filter by (if any)
	 * @param string tagsJoin	Whether the tags should return items containing any one of the tags or
	 * 							whether the tags should return only items containing all of the tags.
	 * 							Possible values: hasAnyOf / hasAllOf
	 * @param string tagUuid	The tagUuid to use to filter the list by personalization tags
	 * @param boolean withInternalPoints	Whether internalOnly points should be returned in the response
	 * @param array pointIds	The list of point IDs to filter by (if any)
	 * @return
	 */
	public static function getMissions( $siteUrl, $tags = null, $tagsJoin = null, $tagUuid = null, $withInternalPoints = null, $pointIds = null )
	{
		// Initialise the client if necessary
		self::initClient();

		// Prepare the URL
		$builder = new APIUrlBuilder();
		$url = self::getUrl( self::MISSIONS_SITE_URI, $siteUrl );
		$fullUrl = $builder->url( $url )
						  ->tags( $tags )
						  ->tagsJoin( $tagsJoin )
						  ->tagUuid( $tagUuid )
						  ->withInternalPoints( $withInternalPoints )
						  ->pointIds( $pointIds )
						  ->build();

		// Make the request
		return self::$client->request( $fullUrl, MamboClient::GET );
	}


	/**
	 * Get the list of gifts for the specified site
	 *
	 * @param string $siteUrl	The site for which to retrieve the list of gifts
	 * @param array tags		The list of tags to filter by (if any)
	 * @param string tagsJoin	Whether the tags should return items containing any one of the tags or
	 * 							whether the tags should return only items containing all of the tags.
	 * 							Possible values: hasAnyOf / hasAllOf
	 * @param string tagUuid	The tagUuid to use to filter the list by personalization tags
	 * @param boolean withInternalPoints	Whether internalOnly points should be returned in the response
	 * @param array pointIds	The list of point IDs to filter by (if any)
	 * @return
	 */
	public static function getGifts( $siteUrl, $tags = null, $tagsJoin = null, $tagUuid = null, $withInternalPoints = null, $pointIds = null )
	{
		// Initialise the client if necessary
		self::initClient();

		// Prepare the URL
		$builder = new APIUrlBuilder();
		$url = self::getUrl( self::GIFTS_SITE_URI, $siteUrl );
		$fullUrl = $builder->url( $url )
						  ->tags( $tags )
						  ->tagsJoin( $tagsJoin )
						  ->tagUuid( $tagUuid )
						  ->withInternalPoints( $withInternalPoints )
						  ->pointIds( $pointIds )
						  ->build();

		// Make the request
		return self::$client->request( $fullUrl, MamboClient::GET );
	}


	/**
	 * This method is used to add custom fields to an existing reward
	 *
	 * @param string id						The ID of the reward to update
	 * @param CustomFieldsRequestData data	The list of custom fields to add
	 * @param boolean withInternalPoints	Whether internalOnly points should be returned in the response
	 * @return
	 */
	public static function addCustomFields( $id, $data, $withInternalPoints = null ) {
		return modCustomFields( MamboClient::POST, $id, $data, $withInternalPoints );
	}


	/**
	 * This method is used to update custom fields in an existing reward
	 *
	 * @param string id						The ID of the reward to update
	 * @param CustomFieldsRequestData data	The list of custom fields to update
	 * @param boolean withInternalPoints	Whether internalOnly points should be returned in the response
	 * @return
	 */
	public static function updateCustomFields( $id, $data, $withInternalPoints = null ) {
		return modCustomFields( MamboClient::PUT, $id, $data, $withInternalPoints );
	}


	/**
	 * This method is used to delete custom fields in an existing reward
	 *
	 * @param string id						The ID of the reward to update
	 * @param CustomFieldsRequestData data	The list of custom fields to update
	 * @param boolean withInternalPoints	Whether internalOnly points should be returned in the response
	 * @return
	 */
	public static function deleteCustomFields( $id, $data, $withInternalPoints = null ) {
		return modCustomFields( MamboClient::DELETE, $id, $data, $withInternalPoints );
	}


	/**
	 * Modifying custom fields
	 */
	private static function modCustomFields( $method, $id, $data, $withInternalPoints = null )
	{
		// Initialise the client if necessary
		self::initClient();

		// Check the request data is valid
		if( !( $data instanceof Data\CustomFieldRequestData ) ) {
			trigger_error( "The data should be of type CustomFieldsRequestData", E_USER_ERROR );
		}

		// Prepare the URL
		$builder = new APIUrlBuilder();
		$url = self::getWithId( self::REWARDS_CUSTOM_URI, $id );
		$fullUrl = $builder->url( $url )
						  ->withInternalPoints( $withInternalPoints )
						  ->build();

		// Make the request
		return self::$client->request( $fullUrl, $method, $data->getJsonString() );
	}
}

?>
