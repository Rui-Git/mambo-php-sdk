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
 * This object captures the data required by the Reward API in
 * order to create / update rewards.
 */
class RewardRequestData extends AbstractHasTagRequestData
{

	/**
	 * Whether the image associated to the Behaviour should be removed
	 * @return boolean removeImage
	 */
	public function getRemoveImage() { return $this->data['removeImage']; }
	public function setRemoveImage( $removeImage ) { $this->data['removeImage'] = $removeImage; }

	/**
	 * The name of the reward. See the achievement or level pages in
	 * administration panel for more information.
	 * @return
	 */
	public function getName() { return $this->data['name']; }
	public function setName( $name ) { $this->data['name'] = $name; }

	/**
	 * Indicates whether the reward is active or not. See the achievement
	 * or level pages in administration panel for more information.
	 * @return
	 */
	public function getActive() { return $this->data['active']; }
	public function setActive( $active ) { $this->data['active'] = $active; }

	/**
	 * The message associated with the reward. See the achievement or
	 * level pages in administration panel for more information.
	 * @return
	 */
	public function getMessage() { return $this->data['message']; }
	public function setMessage( $message ) { $this->data['message'] = $message; }

	/**
	 * The hint associated with the reward. See the achievement or level
	 * pages in administration panel for more information.
	 * @return
	 */
	public function getHint() { return $this->data['hint']; }
	public function setHint( $hint ) { $this->data['hint'] = $hint; }

	/**
	 * Indicates whether the reward should be hidden or not. See the
	 * achievement or level pages in administration panel for more information.
	 * @return
	 */
	public function getHideInWidgets() { return $this->data['hideInWidgets']; }
	public function setHideInWidgets( $hideInWidgets ) { $this->data['hideInWidgets'] = $hideInWidgets; }

	/**
	 * The scarcity represents the overall number of times that a particular
	 * reward can be unlocked. This effectively creates a limited series
	 * reward which can only be unlocked X times.
	 * See the achievement or level pages in administration panel for more information.
	 * @return
	 */
	public function getScarcity() { return $this->data['scarcity']; }
	public function setScarcity( ScarcityDto $scarcity ) { $this->data['scarcity'] = $scarcity; }

	/**
	 * Determines how many of the reward's conditions need to be met in order
	 * for the reward to be unlocked. Set to zero if you require the user to
	 * complete all the conditions.
	 * For example: if you have an achievement composed of 5 different behaviour
	 * repetitions and you only require 3 of those to be completed, you would
	 * set hasAtLeast equal to 3.
	 * @return
	 */
	public function getHasAtLeast() { return $this->data['hasAtLeast']; }
	public function setHasAtLeast( $hasAtLeast ) { $this->data['hasAtLeast'] = $hasAtLeast; }

	/**
	 * This represents the date from which this reward can be unlocked by users.
	 * If no date is specified, the reward can always be unlocked.
	 * This must be a UTC timestamp in ISO 8601 format with
	 * millisecond precision: YYYY-MM-DDTHH:MM:SS.MMMZ.
	 * See the achievement or level pages in administration panel for more information.
	 * @return
	 */
	public function getStartDate() { return $this->data['startDate']; }
	public function setStartDate( $startDate ) { $this->data['startDate'] = $startDate; }

	/**
	 * This represents the date from which this reward can no longer be unlocked by users
	 * If no date is specified, the reward can always be unlocked.
	 * This must be a UTC timestamp in ISO 8601 format with
	 * millisecond precision: YYYY-MM-DDTHH:MM:SS.MMMZ.
	 * See the achievement or level pages in administration panel for more information.
	 * @return
	 */
	public function getEndDate() { return $this->data['endDate']; }
	public function setEndDate( $endDate ) { $this->data['endDate'] = $endDate; }

	/**
	 * The prizes object contains the prizes that a user will earn
	 * when unlocking this reward.
	 * @return
	 */
	public function getPrizes() { return $this->data['prizes']; }
	public function setPrizes( Nested\Prize $prizes ) { $this->data['prizes'] = $prizes; }

	/**
	 * The attributes of the reward. There are currently three types of
	 * attributes: AchievementAttrs, LevelAttrs and MissionAttrs.
	 * @return
	 */
	public function getAttrs() { return $this->data['attrs']; }
	public function setAttrs( $attrs ) { $this->data['attrs'] = $attrs; }

	/**
	 * Custom fields defined for the reward. These can contain additional
	 * data or any kind of information you would like to store which isn't a
	 * standard field of the reward.
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
	public function addTranslation( Nested\Translation\RewardTranslation $translation ) {
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

		if( isset( $json['prizes'] ) && !is_null( $json['prizes'] ) ) {
			$json['prizes'] = $json['prizes']->getJsonArray();
		}

		if( isset( $json['attrs'] ) && !is_null( $json['attrs'] ) ) {
			$json['attrs'] = $json['attrs']->getJsonArray();
		}

		if( isset( $json['scarcity'] ) && !is_null( $json['scarcity'] ) ) {
			$json['scarcity'] = $json['scarcity']->getJsonArray();
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
