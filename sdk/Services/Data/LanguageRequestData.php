<?php

namespace Mambo\Services\Data;

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
 * This object captures the data required by the Language API in
 * order to create / update languages.
 */
class LanguageRequestData
{
	private $data = array();

	/**
	 * The name of the language.
	 * See the language page in administration panel for more information.
	 * @return string name
	 */
	public function getName() { return $this->data['name']; }
	public function setName( $name ) { $this->data['name'] = $name; }


	/**
	 * This is the language code which is used in the "Accept-Language" header
	 * when making requests to the server. This value must only contain letters,
	 * numbers and underscores. The language code must be unique in order to
	 * identify the specific Language.
	 * See the language page in administration panel for more information.
	 * @return string url
	 */
	public function getLanguageCode() { return $this->data['languageCode']; }
	public function setLanguageCode( $languageCode ) { $this->data['languageCode'] = $languageCode; }


	/**
	 * Indicates whether this is the default language to be used for the site.
	 * The default language is the one used when no "Accept-Language" header
	 * is provided. There must always be at least one default language.
	 * See the language page in administration panel for more information.
	 * @return string url
	 */
	public function getIsDefault() { return $this->data['isDefault']; }
	public function setIsDefault( $isDefault ) { $this->data['isDefault'] = $isDefault; }


	/**
	 * The Security object is used to define the security settings for the site.
	 * @return Security security
	 */
	public function getSecurity() { return $this->data['security']; }
	public function setSecurity( $security ) { $this->data['security'] = $security; }


	/**
	 * Return the JSON string equivalent of this object
	 */
	public function getJsonString()
	{
		$json = $this->data;

		if( isset( $json['security'] ) && !is_null( $json['security'] ) ) {
			$json['security'] = $json['security']->getJsonArray();
		}

		return json_encode( $json );
	}
}
?>
