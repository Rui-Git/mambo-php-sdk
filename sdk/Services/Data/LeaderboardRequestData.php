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
 * This object captures the data required by the Event API in
 * order to track a behaviour performed by a specific user.
 */
class LeaderboardRequestData extends AbstractHasTagRequestData
{

	/**
	 * The name of the leaderboard. See the leaderboard page in
	 * administration panel for more information.
	 * @return
	 */
	public function getName() { return $this->data['name']; }
	public function setName( $name ) { $this->data['name'] = $name; }

	/**
	 * Indicates whether the leaderboard should have ranking calculated.
	 * If set to true then this will schedule the ranking job to execute
	 * for this leaderboard.
	 * @return
	 */
	public function getWithRanking() { return $this->data['withRanking']; }
	public function setWithRanking( $withRanking ) { $this->data['withRanking'] = $withRanking; }

	/**
	 * Indicates whether the leaderboard is a one tag only leaderboard.
	 * One tag only leaderboards will create a leaderboard for a single tag
	 * which should be specified using the filtertableByTags field.
	 * When retrieving the leaderboard it will be automatically filtered
	 * for that tag. There will be no non-tag leaderboard available.
	 * Only the leaderboard for the one tag will be created.
	 * @return
	 */
	public function getWithOneTagOnly() { return $this->data['withOneTagOnly']; }
	public function setWithOneTagOnly( $withOneTagOnly ) { $this->data['withOneTagOnly'] = $withOneTagOnly; }

	/**
	 * This should contain the list of the tag IDs by which this
	 * leaderboard can be filtered.
	 * @return
	 */
	public function getFilterableByTagIds() { return $this->data['filterableByTagIds']; }
	public function setFilterableByTagIds( array $filterableByTagIds ) { $this->data['filterableByTagIds'] = $filterableByTagIds; }

	/**
	 * This must contain the list of the IDs of the points which must
	 * be added together for this leaderboard score.
	 * @return
	 */
	public function getPointIds() { return $this->data['pointIds']; }
	public function setPointIds( array $pointIds ) { $this->data['pointIds'] = $pointIds; }
	public function addPointId( $pointId ) {
		if( !isset( $this->data['pointIds'] ) ) {
			$this->data['pointIds'] = array();
		}
		array_push( $this->data['pointIds'], (string) $pointId );
	}

	/**
	 * The attributes of the leaderboard. There are currently two types of
	 * attributes: LeaderboardBehaviourAttrs and LeaderboardPointAttrs.
	 * @return
	 */
	public function getAttrs() { return $this->data['attrs']; }
	public function setAttrs( $attrs ) { $this->data['attrs'] = $attrs; }


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
	public function addTranslation( Nested\Translation\LeaderboardTranslation $translation ) {
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

		if( isset( $json['attrs'] ) && !is_null( $json['attrs'] ) ) {
			$json['attrs'] = $json['attrs']->getJsonArray();
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
