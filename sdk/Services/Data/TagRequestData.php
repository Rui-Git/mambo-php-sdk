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
 * This object captures the data required by the Tag API in
 * order to create / update tags.
 */
class TagRequestData
{
	private $data = array();

	/**
	 * The name of the tag.
	 * See the tag page in administration panel for more information.
	 * @return string name
	 */
	public function getName() { return $this->data['name']; }
	public function setName( $name ) { $this->data['name'] = $name; }


	/**
	 * This is the tag value that will be used when retrieving data from
	 * the API. This value must only contain letters, numbers and underscores.
	 * The tag value must be unique in order to identify this specific Tag.
	 * See the tags page in administration panel for more information.
	 * @return string tag
	 */
	public function getTag() { return $this->data['tag']; }
	public function setTag( $tag ) { $this->data['tag'] = $tag; }


	/**
	 * Indicates whether this tag is a personalization tag. Personalization
	 * tags can be used to auto-filter points, behaviours, rewards, etc by user. Assign to a user a
	 * personalization tag and they will only see the rewards, points, behaviours,
	 * etc which have a matching tag (or which have no personalization tags at all).
	 * If the user has no specific personalization tags, they will see all the points,
	 * behaviours, rewards, etc configured in the platform.
	 * See the tags page in administration panel for more information.
	 * @return string personalization
	 */
	public function getPersonalization() { return $this->data['personalization']; }
	public function setPersonalization( $personalization ) { $this->data['personalization'] = $personalization; }


	/**
	 * Whether the Tag should be shown or not.
	 * @return
	 */
	public function getHideInWidgets() { return $this->data['hideInWidgets']; }
	public function setHideInWidgets( $hideInWidgets ) { $this->data['hideInWidgets'] = $hideInWidgets; }


	/**
	 * This contains the list of the translations which must be used with the object.
	 * Setting a property directly on the object (such as using setName()) will add
	 * the property to the list of translations using the default language of the server.
	 * If you set a property on the object directly (such as setName()) and then set
	 * the same property using setTranslations(), then the setTranslations() property
	 * will take priority.
	 * @return
	 */
	public function getTranslations() { return $this->data['translations']; }
	public function setTranslations( array $translations ) { $this->data['translations'] = $translations; }
	public function addTranslation( Nested\Translation\TagTranslation $translation ) {
		if( !isset( $this->data['translations'] ) ) {
			$this->data['translations'] = array();
		}
		array_push( $this->data['translations'], $translation );
	}


	/**
	 * Return the JSON string equivalent of this object
	 */
	public function getJsonString()
	{
		$json = $this->data;

		if( isset( $json['translations'] ) && !is_null( $json['translations'] ) ) {
			$translationsArr = array();
			foreach( $json['translations'] as $translation ) {
				array_push( $translationsArr, $translation->getJsonArray() );
			}
			$json['translations'] = $translationsArr;
		}

		return json_encode( $json );
	}
}
?>
