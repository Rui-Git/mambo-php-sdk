<?php

namespace Mambo\Services\Data\Attributes;

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
 * order to create / update levels
 */
class LevelAttrs
{
	private $data = array();

	/**
	 * The type of attribute
	 * @return
	 */
	public function getType() { return 'level'; }

	/**
	 * The total number of points a user must have to unlock the level.
	 * Note: points attached to a level will never be filtered by tags
	 * only by the internalOnlyPoints.
	 * See the level page in administration panel for more information.
	 * @return
	 */
	public function getPoints() { return $this->data['points']; }
	public function setPoints( array $points ) { $this->data['points'] = $points; }
	public function addPoint( SimplePoint $point ) {
		if( !isset( $this->data['points'] ) ) {
			$this->data['points'] = array();
		}
		array_push( $this->data['points'], $point );
	}

	/**
	 * The reputation flag determines if this is a reputation level or
	 * a regular level. Reputation levels will fluctuate based on the
	 * number of points the user currently has. This means that users
	 * can lose a reputation level if they lose the points necessary
	 * to maintain that level. For example:
	 * Reputation Level 1 = 1 points
	 * Reputation Level 2 = 100 points
	 * If the user has 100 points but then loses 10 points, they will
	 * move from Reputation Level 2 to Reputation Level 1.
	 * @return
	 */
	public function getReputation() { return $this->data['reputation']; }
	public function setReputation( $reputation ) { $this->data['reputation'] = $reputation; }


	/**
	 * Return the JSON string equivalent of this object
	 */
	public function getJsonArray()
	{
		$json = $this->data;
		$json['type'] = $this->getType();

		if( isset( $json['points'] ) && !is_null( $json['points'] ) ) {
			$pointsArr = array();
			foreach( $json['points'] as $point ) {
				array_push( $pointsArr, $point->getJsonArray() );
			}
			$json['points'] = $pointsArr;
		}

		return $json;
	}
}
?>
