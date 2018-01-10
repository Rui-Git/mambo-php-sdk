<?php

namespace Mambo\Services;

use Mambo\Common\MamboBaseAbstract;
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
 * The MamboCouponsService class handles all Coupon related requests
 * to the Mambo API.
 */
class MamboCouponsService extends MamboBaseAbstract
{
	/**
	 * Coupon service end point URI
	 * @var string
	 */
	const COUPONS_URI = "/v1/coupons";
	const COUPONS_ID_URI = "/v1/coupons/{id}";
	const COUPONS_IMAGE_URI = "/v1/coupons/{id}/image";
	const COUPONS_CLONE_URI = "/v1/coupons/{id}/clone";

	const COUPONS_SITE_URI = "/v1/{site}/coupons";
	const COUPONS_BUYABLE_URI = "/v1/{site}/coupons/buyable";
	const COUPONS_REGULAR_URI = "/v1/{site}/coupons/regular";
	const VALIDATE_COUPON_URI = "/v1/{site}/coupons/validate";


	/**
	 * This method is used to create a new coupon.
	 *
	 * @param string siteUrl				The site to which the coupon belongs to
	 * @param CouponRequestData data		The data sent to the API in order to create a coupon
	 * @return
	 */
	public static function create( $siteUrl, $data )
	{
		// Initialise the client if necessary
		self::initClient();

		// Check the request data is valid
		if( !( $data instanceof Data\CouponRequestData ) )
		{
			trigger_error( "The data should be of type CouponRequestData", E_USER_ERROR );
		}

		// Make the request
		return self::$client->request( self::getUrl( self::COUPONS_SITE_URI, $siteUrl ),
				MamboClient::POST, $data->getJsonString() );
	}


	/**
	 * Update an existing coupon by ID.
	 *
	 * @param string id					The ID of the coupon to update
	 * @param CouponRequestData data	The data with which to update the specified coupon object
	 * @return
	 */
	public static function update( $id, $data )
	{
		// Initialise the client if necessary
		self::initClient();

		// Check the request data is valid
		if( !( $data instanceof Data\CouponRequestData ) )
		{
			trigger_error( "The data should be of type CouponRequestData", E_USER_ERROR );
		}

		// Make the request
		return self::$client->request( self::getWithId( self::COUPONS_ID_URI, $id ),
				MamboClient::PUT, $data->getJsonString() );
	}


	/**
	 * Upload an image for the coupon
	 *
	 * @param string id		The coupon for which to upload the image
	 * @param data image 	The image to upload for the coupon
	 * @return
	 */
	public static function uploadImage( $id, $image )
	{
		// Initialise the client if necessary
		self::initClient();

		// Check the request data is valid
		if( is_null( $image ) || empty( $image ) )
		{
			trigger_error( "The image must not be empty", E_USER_ERROR );
		}

		// Make the request
		return self::$client->upload( self::getWithId( self::COUPONS_IMAGE_URI, $id ), $image );
	}


	/**
	 * Clone a coupon
	 *
	 * @param string id		The ID of the coupon to clone
	 * @return
	 */
	public static function cloneCoupon( $id )
	{
		// Initialise the client if necessary
		self::initClient();

		// Make the request
		return self::$client->request( self::getWithId( self::COUPONS_CLONE_URI, $id ), MamboClient::POST );
	}


	/**
	 * Delete a coupon by it's ID
	 *
	 * @param string id				The ID of the coupon to delete
	 * @return
	 */
	public static function delete( $id )
	{
		// Initialise the client if necessary
		self::initClient();

		// Make the request
		return self::$client->request( self::getWithId( self::COUPONS_ID_URI, $id ), MamboClient::DELETE );
	}


	/**
	 * Delete a list of coupons by their ID
	 *
	 * @param string ids		The list of IDs of the coupon to delete
	 * @return
	 */
	public static function deleteCoupons( $data )
	{
		// Initialise the client if necessary
		self::initClient();

		// Check the request data is valid
		if( !( $data instanceof Data\DeleteRequestData ) )
		{
			trigger_error( "The data should be of type DeleteRequestData", E_USER_ERROR );
		}

		// Make the request
		return self::$client->request( self::COUPONS_URI, MamboClient::DELETE, $data->getJsonString() );
	}


	/**
	 * Get a coupon by it's ID
	 *
	 * @param string id			The ID of the coupon to retrieve
	 * @return
	 */
	public static function get( $id )
	{
		// Initialise the client if necessary
		self::initClient();

		// Make the request
		return self::$client->request( self::getWithId( self::COUPONS_ID_URI, $id ), MamboClient::GET );
	}


	/**
	 * This method is used to validate a coupon for the specified user.
	 *
	 * @param string siteUrl		The site to which the user and coupon belong to
	 * @param string uuid			The Unique User ID of the user against which we will validate the coupon code
	 * @param string couponCode		The code of the coupon we should validate against the specified user
	 * @return
	 */
	public static function validate( $siteUrl, $uuid, $couponCode )
	{
		// Initialise the client if necessary
		self::initClient();

		// Prepare the request
		$data = new Data\CouponUserRequestData();
		$data->setUuid( $uuid );
		$data->setCouponCode( $couponCode );

		// Make the request
		return self::$client->request( self::getUrl( self::VALIDATE_COUPON_URI, $siteUrl ), MamboClient::POST, $data->getJsonString() );
	}


	/**
	 * Get the list of coupons for the specified site
	 *
	 * @param string siteUrl	The site for which to retrieve the list of coupons
	 * @param array tags		The list of tags to filter by (if any)
	 * @param string tagsJoin	Whether the tags should return items containing any one of the tags or
	 * 							whether the tags should return only items containing all of the tags.
	 * 							Possible values: hasAnyOf / hasAllOf
	 * @param string tagUuid	The tagUuid to use to filter the list by personalization tags
	 * @return
	 */
	public static function getCoupons( $siteUrl, $tags = null, $tagsJoin = null, $tagUuid = null )
	{
		// Initialise the client if necessary
		self::initClient();

		// Prepare the URL
		$builder = new APIUrlBuilder();
		$url = self::getUrl( self::COUPONS_SITE_URI, $siteUrl );
		$fullUrl = $builder->url( $url )
						  ->tags( $tags )
						  ->tagsJoin( $tagsJoin )
						  ->tagUuid( $tagUuid )
						  ->build();

		// Make the request
		return self::$client->request( $fullUrl, MamboClient::GET );
	}


	/**
	 * Get the list of buyable coupons for the specified site
	 *
	 * @param string $siteUrl	The site for which to retrieve the list of buyable coupons
	 * @param array tags		The list of tags to filter by (if any)
	 * @param string tagsJoin	Whether the tags should return items containing any one of the tags or
	 * 							whether the tags should return only items containing all of the tags.
	 * 							Possible values: hasAnyOf / hasAllOf
	 * @param string tagUuid	The tagUuid to use to filter the list by personalization tags
	 * @return
	 */
	public static function getBuyableCoupons( $siteUrl, $tags = null, $tagsJoin = null, $tagUuid = null )
	{
		// Initialise the client if necessary
		self::initClient();

		// Prepare the URL
		$builder = new APIUrlBuilder();
		$url = self::getUrl( self::COUPONS_BUYABLE_URI, $siteUrl );
		$fullUrl = $builder->url( $url )
						  ->tags( $tags )
						  ->tagsJoin( $tagsJoin )
						  ->tagUuid( $tagUuid )
						  ->build();

		// Make the request
		return self::$client->request( $fullUrl, MamboClient::GET );
	}


	/**
	 * Get the list of regular (non-buyable) coupons for the specified site
	 *
	 * @param string $siteUrl	The site for which to retrieve the list of regular (non-buyable) coupons
	 * @param array tags		The list of tags to filter by (if any)
	 * @param string tagsJoin	Whether the tags should return items containing any one of the tags or
	 * 							whether the tags should return only items containing all of the tags.
	 * 							Possible values: hasAnyOf / hasAllOf
	 * @param string tagUuid	The tagUuid to use to filter the list by personalization tags
	 * @return
	 */
	public static function getRegularCoupons( $siteUrl, $tags = null, $tagsJoin = null, $tagUuid = null )
	{
		// Initialise the client if necessary
		self::initClient();

		// Prepare the URL
		$builder = new APIUrlBuilder();
		$url = self::getUrl( self::COUPONS_REGULAR_URI, $siteUrl );
		$fullUrl = $builder->url( $url )
						  ->tags( $tags )
						  ->tagsJoin( $tagsJoin )
						  ->tagUuid( $tagUuid )
						  ->build();

		// Make the request
		return self::$client->request( $fullUrl, MamboClient::GET );
	}
}

?>
