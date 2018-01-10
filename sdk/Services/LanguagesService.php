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
 * The MamboLanguagesService class handles all Language related requests
 * to the Mambo API.
 */
class MamboLanguagesService extends MamboBaseAbstract
{
	/**
	 * Language service end language URI
	 * @var string
	 */
	const LANGUAGES_URI = "/v1/languages";
	const LANGUAGES_ID_URI = "/v1/languages/{id}";
	const LANGUAGES_CLONE_URI = "/v1/languages/{id}/clone";

	const LANGUAGES_SITE_URI = "/v1/{site}/languages";


	/**
	 * This method is used to create a new language.
	 *
	 * @param string siteUrl				The site to which the language belongs to
	 * @param LanguageRequestData data		The data sent to the API in order to create a language
	 * @return
	 */
	public static function create( $siteUrl, $data )
	{
		// Initialise the client if necessary
		self::initClient();

		// Check the request data is valid
		if( !( $data instanceof Data\LanguageRequestData ) )
		{
			trigger_error( "The data should be of type LanguageRequestData", E_USER_ERROR );
		}

		// Make the request
		return self::$client->request( self::getUrl( self::LANGUAGES_SITE_URI, $siteUrl ),
				MamboClient::POST, $data->getJsonString() );
	}


	/**
	 * Update an existing language by ID.
	 *
	 * @param string id					The ID of the language to update
	 * @param LanguageRequestData data	The data with which to update the specified language object
	 * @return
	 */
	public static function update( $id, $data )
	{
		// Initialise the client if necessary
		self::initClient();

		// Check the request data is valid
		if( !( $data instanceof Data\LanguageRequestData ) )
		{
			trigger_error( "The data should be of type LanguageRequestData", E_USER_ERROR );
		}

		// Make the request
		return self::$client->request( self::getWithId( self::LANGUAGES_ID_URI, $id ),
				MamboClient::PUT, $data->getJsonString() );
	}


	/**
	 * Clone a language
	 *
	 * @param string id		The ID of the language to clone
	 * @return
	 */
	public static function cloneLanguage( $id )
	{
		// Initialise the client if necessary
		self::initClient();

		// Make the request
		return self::$client->request( self::getWithId( self::LANGUAGES_CLONE_URI, $id ), MamboClient::POST );
	}


	/**
	 * Delete a language by it's ID
	 *
	 * @param string id				The ID of the language to delete
	 * @return
	 */
	public static function delete( $id )
	{
		// Initialise the client if necessary
		self::initClient();

		// Make the request
		return self::$client->request( self::getWithId( self::LANGUAGES_ID_URI, $id ), MamboClient::DELETE );
	}


	/**
	 * Delete a list of languages by their ID
	 *
	 * @param string ids		The list of IDs of the language to delete
	 * @return
	 */
	public static function deleteLanguages( $data )
	{
		// Initialise the client if necessary
		self::initClient();

		// Check the request data is valid
		if( !( $data instanceof Data\DeleteRequestData ) )
		{
			trigger_error( "The data should be of type DeleteRequestData", E_USER_ERROR );
		}

		// Make the request
		return self::$client->request( self::LANGUAGES_URI, MamboClient::DELETE, $data->getJsonString() );
	}


	/**
	 * Get a language by it's ID
	 *
	 * @param string id			The ID of the language to retrieve
	 * @return
	 */
	public static function get( $id )
	{
		// Initialise the client if necessary
		self::initClient();

		// Make the request
		return self::$client->request( self::getWithId( self::LANGUAGES_ID_URI, $id ), MamboClient::GET );
	}


	/**
	 * Get the list of languages for the specified site
	 *
	 * @param string $siteUrl	The site for which to retrieve the list of languages
	 * @return
	 */
	public static function getLanguages( $siteUrl )
	{
		// Initialise the client if necessary
		self::initClient();

		// Make the request
		return self::$client->request( self::getUrl( self::LANGUAGES_SITE_URI, $siteUrl ), MamboClient::GET );
	}
}

?>
