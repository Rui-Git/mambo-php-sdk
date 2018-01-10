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
 * The MamboDataStoresService class handles all DataStore related requests
 * to the Mambo API.
 */
class MamboDataStoresService extends MamboBaseAbstract
{
	/**
	 * DataStore service end data store URI
	 * @var string
	 */
	const DATA_STORES_URI = "/v1/data_stores";
	const DATA_STORES_ID_URI = "/v1/data_stores/{id}";
	const DATA_STORES_CLONE_URI = "/v1/data_stores/{id}/clone";

	const DATA_STORES_SITE_URI = "/v1/{site}/data_stores";
	const DATA_STORES_TYPE_SITE_URI = "/v1/{site}/data_stores/{type}";


	/**
	 * This method is used to create a new data store.
	 *
	 * @param string siteUrl					The site to which the data store belongs to
	 * @param DataStoreRequestData data		The data sent to the API in order to create a data store
	 * @return
	 */
	public static function create( $siteUrl, $data )
	{
		// Initialise the client if necessary
		self::initClient();

		// Check the request data is valid
		if( !( $data instanceof Data\DataStoreRequestData ) )
		{
			trigger_error( "The data should be of type DataStoreRequestData", E_USER_ERROR );
		}

		// Make the request
		return self::$client->request( self::getUrl( self::DATA_STORES_SITE_URI, $siteUrl ),
				MamboClient::POST, $data->getJsonString() );
	}


	/**
	 * Update an existing data store by ID.
	 *
	 * @param string id					The ID of the data store to update
	 * @param DataStoreRequestData data	The data with which to update the specified data store object
	 * @return
	 */
	public static function update( $id, $data )
	{
		// Initialise the client if necessary
		self::initClient();

		// Check the request data is valid
		if( !( $data instanceof DataStoreRequestData ) )
		{
			trigger_error( "The data should be of type DataStoreRequestData", E_USER_ERROR );
		}

		// Make the request
		return self::$client->request( self::getWithId( self::DATA_STORES_ID_URI, $id ),
				MamboClient::PUT, $data->getJsonString() );
	}


	/**
	 * Clone a data store
	 *
	 * @param string id		The ID of the data store to clone
	 * @return
	 */
	public static function cloneDataStore( $id )
	{
		// Initialise the client if necessary
		self::initClient();

		// Make the request
		return self::$client->request( self::getWithId( self::DATA_STORES_CLONE_URI, $id ), MamboClient::POST );
	}


	/**
	 * Delete a data store by it's ID
	 *
	 * @param string id				The ID of the data store to delete
	 * @return
	 */
	public static function delete( $id )
	{
		// Initialise the client if necessary
		self::initClient();

		// Make the request
		return self::$client->request( self::getWithId( self::DATA_STORES_ID_URI, $id ), MamboClient::DELETE );
	}


	/**
	 * Delete a list of data stores by their ID
	 *
	 * @param string ids		The list of IDs of the data store to delete
	 * @return
	 */
	public static function deleteDataStores( $data )
	{
		// Initialise the client if necessary
		self::initClient();

		// Check the request data is valid
		if( !( $data instanceof DeleteRequestData ) )
		{
			trigger_error( "The data should be of type DeleteRequestData", E_USER_ERROR );
		}

		// Make the request
		return self::$client->request( self::DATA_STORES_URI, MamboClient::DELETE, $data->getJsonString() );
	}


	/**
	 * Get a data store by it's ID
	 *
	 * @param string id			The ID of the data store to retrieve
	 * @return
	 */
	public static function get( $id )
	{
		// Initialise the client if necessary
		self::initClient();

		// Make the request
		return self::$client->request( self::getWithId( self::DATA_STORES_ID_URI, $id ), MamboClient::GET );
	}


	/**
	 * Get the list of data stores for the specified site
	 *
	 * @param string $siteUrl	The site for which to retrieve the list of data stores
	 * @return
	 */
	public static function getDataStores( $siteUrl )
	{
		// Initialise the client if necessary
		self::initClient();

		// Make the request
		return self::$client->request( self::getUrl( self::DATA_STORES_SITE_URI, $siteUrl ), MamboClient::GET );
	}


	/**
	 * Get the list of data stores for the specified site and type
	 *
	 * @param string $siteUrl	The site for which to retrieve the list of data stores
	 * @param string $type		The type of data stores to retrieve
	 * @return
	 */
	public static function getDataStoresByType( $siteUrl, $type )
	{
		// Initialise the client if necessary
		self::initClient();

		$url = self::getUrl( self::DATA_STORES_TYPE_SITE_URI, $siteUrl );
		$url = self::substitute( $url, "type", (string) $type );

		// Make the request
		return self::$client->request( $url, MamboClient::GET );
	}
}

?>
