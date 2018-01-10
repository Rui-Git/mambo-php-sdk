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
 * The MamboCustomFieldsService class handles all CustomField related requests
 * to the Mambo API.
 */
class MamboCustomFieldsService extends MamboBaseAbstract
{
	/**
	 * CustomField service end custom field URI
	 * @var string
	 */
	const CUSTOM_FIELDS_URI = "/v1/custom_fields";
	const CUSTOM_FIELDS_ID_URI = "/v1/custom_fields/{id}";
	const CUSTOM_FIELDS_CLONE_URI = "/v1/custom_fields/{id}/clone";

	const CUSTOM_FIELDS_SITE_URI = "/v1/{site}/custom_fields";


	/**
	 * This method is used to create a new custom field.
	 *
	 * @param string siteUrl					The site to which the custom field belongs to
	 * @param CustomFieldRequestData data		The data sent to the API in order to create a custom field
	 * @return
	 */
	public static function create( $siteUrl, $data )
	{
		// Initialise the client if necessary
		self::initClient();

		// Check the request data is valid
		if( !( $data instanceof Data\CustomFieldRequestData ) )
		{
			trigger_error( "The data should be of type CustomFieldRequestData", E_USER_ERROR );
		}

		// Make the request
		return self::$client->request( self::getUrl( self::CUSTOM_FIELDS_SITE_URI, $siteUrl ),
				MamboClient::POST, $data->getJsonString() );
	}


	/**
	 * Update an existing custom field by ID.
	 *
	 * @param string id					The ID of the custom field to update
	 * @param CustomFieldRequestData data	The data with which to update the specified custom field object
	 * @return
	 */
	public static function update( $id, $data )
	{
		// Initialise the client if necessary
		self::initClient();

		// Check the request data is valid
		if( !( $data instanceof Data\CustomFieldRequestData ) )
		{
			trigger_error( "The data should be of type CustomFieldRequestData", E_USER_ERROR );
		}

		// Make the request
		return self::$client->request( self::getWithId( self::CUSTOM_FIELDS_ID_URI, $id ),
				MamboClient::PUT, $data->getJsonString() );
	}


	/**
	 * Clone a custom field
	 *
	 * @param string id		The ID of the custom field to clone
	 * @return
	 */
	public static function cloneCustomField( $id )
	{
		// Initialise the client if necessary
		self::initClient();

		// Make the request
		return self::$client->request( self::getWithId( self::CUSTOM_FIELDS_CLONE_URI, $id ), MamboClient::POST );
	}


	/**
	 * Delete a custom field by it's ID
	 *
	 * @param string id				The ID of the custom field to delete
	 * @return
	 */
	public static function delete( $id )
	{
		// Initialise the client if necessary
		self::initClient();

		// Make the request
		return self::$client->request( self::getWithId( self::CUSTOM_FIELDS_ID_URI, $id ), MamboClient::DELETE );
	}


	/**
	 * Delete a list of custom fields by their ID
	 *
	 * @param string ids		The list of IDs of the custom field to delete
	 * @return
	 */
	public static function deleteCustomFields( $data )
	{
		// Initialise the client if necessary
		self::initClient();

		// Check the request data is valid
		if( !( $data instanceof Data\DeleteRequestData ) )
		{
			trigger_error( "The data should be of type DeleteRequestData", E_USER_ERROR );
		}

		// Make the request
		return self::$client->request( self::CUSTOM_FIELDS_URI, MamboClient::DELETE, $data->getJsonString() );
	}


	/**
	 * Get a custom field by it's ID
	 *
	 * @param string id			The ID of the custom field to retrieve
	 * @return
	 */
	public static function get( $id )
	{
		// Initialise the client if necessary
		self::initClient();

		// Make the request
		return self::$client->request( self::getWithId( self::CUSTOM_FIELDS_ID_URI, $id ), MamboClient::GET );
	}


	/**
	 * Get the list of custom fields for the specified site
	 *
	 * @param string $siteUrl	The site for which to retrieve the list of custom fields
	 * @return
	 */
	public static function getCustomFields( $siteUrl )
	{
		// Initialise the client if necessary
		self::initClient();

		// Make the request
		return self::$client->request( self::getUrl( self::CUSTOM_FIELDS_SITE_URI, $siteUrl ), MamboClient::GET );
	}
}

?>
