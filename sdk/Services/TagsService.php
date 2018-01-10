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
 * The MamboTagsService class handles all Tag related requests
 * to the Mambo API.
 */
class MamboTagsService extends MamboBaseAbstract
{
	/**
	 * Tag service end tag URI
	 * @var string
	 */
	const TAGS_URI = "/v1/tags";
	const TAGS_ID_URI = "/v1/tags/{id}";
	const TAGS_CLONE_URI = "/v1/tags/{id}/clone";

	const TAGS_SITE_URI = "/v1/{site}/tags";


	/**
	 * This method is used to create a new tag.
	 *
	 * @param string siteUrl				The site to which the tag belongs to
	 * @param TagRequestData data		The data sent to the API in order to create a tag
	 * @return
	 */
	public static function create( $siteUrl, $data )
	{
		// Initialise the client if necessary
		self::initClient();

		// Check the request data is valid
		if( !( $data instanceof Data\TagRequestData ) )
		{
			trigger_error( "The data should be of type TagRequestData", E_USER_ERROR );
		}

		// Make the request
		return self::$client->request( self::getUrl( self::TAGS_SITE_URI, $siteUrl ),
				MamboClient::POST, $data->getJsonString() );
	}


	/**
	 * Update an existing tag by ID.
	 *
	 * @param string id					The ID of the tag to update
	 * @param TagRequestData data	The data with which to update the specified tag object
	 * @return
	 */
	public static function update( $id, $data )
	{
		// Initialise the client if necessary
		self::initClient();

		// Check the request data is valid
		if( !( $data instanceof Data\TagRequestData ) )
		{
			trigger_error( "The data should be of type TagRequestData", E_USER_ERROR );
		}

		// Make the request
		return self::$client->request( self::getWithId( self::TAGS_ID_URI, $id ),
				MamboClient::PUT, $data->getJsonString() );
	}


	/**
	 * Clone a tag
	 *
	 * @param string id		The ID of the tag to clone
	 * @return
	 */
	public static function cloneTag( $id )
	{
		// Initialise the client if necessary
		self::initClient();

		// Make the request
		return self::$client->request( self::getWithId( self::TAGS_CLONE_URI, $id ), MamboClient::POST );
	}


	/**
	 * Delete a tag by it's ID
	 *
	 * @param string id				The ID of the tag to delete
	 * @return
	 */
	public static function delete( $id )
	{
		// Initialise the client if necessary
		self::initClient();

		// Make the request
		return self::$client->request( self::getWithId( self::TAGS_ID_URI, $id ), MamboClient::DELETE );
	}


	/**
	 * Delete a list of tags by their ID
	 *
	 * @param string ids		The list of IDs of the tag to delete
	 * @return
	 */
	public static function deleteTags( $data )
	{
		// Initialise the client if necessary
		self::initClient();

		// Check the request data is valid
		if( !( $data instanceof Data\DeleteRequestData ) )
		{
			trigger_error( "The data should be of type DeleteRequestData", E_USER_ERROR );
		}

		// Make the request
		return self::$client->request( self::TAGS_URI, MamboClient::DELETE, $data->getJsonString() );
	}


	/**
	 * Get a tag by it's ID
	 *
	 * @param string id			The ID of the tag to retrieve
	 * @return
	 */
	public static function get( $id )
	{
		// Initialise the client if necessary
		self::initClient();

		// Make the request
		return self::$client->request( self::getWithId( self::TAGS_ID_URI, $id ), MamboClient::GET );
	}


	/**
	 * Get the list of tags for the specified site
	 *
	 * @param string $siteUrl	The site for which to retrieve the list of tags
	 * @return
	 */
	public static function getTags( $siteUrl )
	{
		// Initialise the client if necessary
		self::initClient();

		// Make the request
		return self::$client->request( self::getUrl( self::TAGS_SITE_URI, $siteUrl ), MamboClient::GET );
	}
}

?>
