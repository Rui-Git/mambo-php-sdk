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
 * This object captures the data required by the Behaviour API in
 * order to create / update behaviours.
 */
class BehaviourRequestData extends AbstractHasTagRequestData
{

	/**
	 * Whether the image associated to the Behaviour should be removed
	 * @return boolean removeImage
	 */
	public function getRemoveImage() { return $this->data['removeImage']; }
	public function setRemoveImage( $removeImage ) { $this->data['removeImage'] = $removeImage; }

	/**
	 * The Behaviour's name
	 * @return
	 */
	public function getName() { return $this->data['name']; }
	public function setName( $name ) { $this->data['name'] = $name; }

	/**
	 * The Behaviour's verb. This is used when tracking an
	 * event.
	 * @return
	 */
	public function getVerb() { return $this->data['verb']; }
	public function setVerb( $verb ) { $this->data['verb'] = $verb; }

	/**
	 * The Behaviour's coolOff period. The time in seconds which must
	 * elapse before the user can earn points for this behaviour again.
	 * @return
	 */
	public function getCoolOff() { return $this->data['coolOff']; }
	public function setCoolOff( $coolOff ) { $this->data['coolOff'] = $coolOff; }

	/**
	 * The message associated with the behaviour.
	 * This will be displayed in the notifications.
	 * @return
	 */
	public function getMessage() { return $this->data['message']; }
	public function setMessage( $message ) { $this->data['message'] = $message; }

	/**
	 * The Behaviour's hint. This is displayed to the end user when you
	 * wish to make them aware of what behaviours you are rewarding.
	 * @return
	 */
	public function getHint() { return $this->data['hint']; }
	public function setHint( $hint ) { $this->data['hint'] = $hint; }

	/**
	 * Whether the Behaviour should be shown or not.
	 * @return
	 */
	public function getHideInWidgets() { return $this->data['hideInWidgets']; }
	public function setHideInWidgets( $hideInWidgets ) { $this->data['hideInWidgets'] = $hideInWidgets; }

	/**
	 * Whether the Behaviour can be tracked directly through the Events JavaScript API
	 * @return
	 */
	public function getJsTrackable() { return $this->data['jsTrackable']; }
	public function setJsTrackable( $jsTrackable ) { $this->data['jsTrackable'] = $jsTrackable; }

	/**
	 * Indicates that this behaviour should be awarded to a user only if one of the
	 * following criteria is matched:
	 * 1) User and Behaviour have at least one personalization tag that matches
	 * 2) Behaviour has no personalization tags
	 * 3) User has no personalization tags
	 * @return
	 */
	public function getTagFilter() { return $this->data['tagFilter']; }
	public function setTagFilter( $tagFilter ) { $this->data['tagFilter'] = $tagFilter; }

	/**
	 * The attributes of the behaviour. There are currently two types of
	 * attributes: SimpleAttrs and FlexibleAttrs.
	 * @return
	 */
	public function getAttrs() { return $this->data['attrs']; }
	public function setAttrs( $attrs ) { $this->data['attrs'] = $attrs; }

	/**
	 * The limit object is used to define whether there is a repetition
	 * limit on the behaviour. Limits can be either: 1) a hard limit,
	 * for example: 5 repetitions; 2) or a limit that expires, for example:
	 * 10 repetitions in a day
	 * @return
	 */
	public function getLimit() { return $this->data['limit']; }
	public function setLimit( Limit $limit ) { $this->data['limit'] = $limit; }

	/**
	 * The prizes object contains the prizes that a user will earn
	 * when performing this behaviour.
	 * @return
	 */
	public function getPrizes() { return $this->data['prizes']; }
	public function setPrizes( Prize $prizes ) { $this->data['prizes'] = $prizes; }

	/**
	 * The activity object is used to define the text to be used
	 * in the activity stream.
	 * @return
	 */
	public function getActivity() { return $this->data['activity']; }
	public function setActivity( ActivityStream $activity ) { $this->data['activity'] = $activity; }

	/**
	 * Custom fields defined for the behaviour. These can contain additional
	 * data or any kind of information you would like to store which isn't a
	 * standard field of the behaviour.
	 * @return
	 */
	public function getCustomFields() { return $this->data['customFields']; }
	public function setCustomFields( array $customFields ) { $this->data['customFields'] = $customFields; }


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
	public function addTranslation( BehaviourTranslation $translation ) {
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

		if( isset( $json['limit'] ) && !is_null( $json['limit'] ) ) {
			$json['limit'] = $json['limit']->getJsonArray();
		}

		if( isset( $json['prizes'] ) && !is_null( $json['prizes'] ) ) {
			$json['prizes'] = $json['prizes']->getJsonArray();
		}

		if( isset( $json['activity'] ) && !is_null( $json['activity'] ) ) {
			$json['activity'] = $json['activity']->getJsonArray();
		}

		if( isset( $json['attrs'] ) && !is_null( $json['attrs'] ) ) {
			$json['attrs'] = $json['attrs']->getJsonArray();
		}

		if( isset( $json['customFields'] ) && !is_null( $json['customFields'] ) ) {
			$customFieldsArr = array();
			foreach( $json['customFields'] as $customField ) {
				array_push( $customFieldsArr, $customField->getJsonArray() );
			}
			$json['customFields'] = $customFieldsArr;
		}

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
