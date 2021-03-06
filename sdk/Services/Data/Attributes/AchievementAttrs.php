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
 * order to create / update achievements
 */
class AchievementAttrs
{
	private $data = array();

	/**
	 * The type of attribute
	 * @return
	 */
	public function getType() { return 'achievement'; }

	/**
	 * The list of behaviours and their repetitions associated to this achievement.
	 * See the achievement page in administration panel for more information.
	 * @return
	 */
	public function getBehaviours() { return $this->data['behaviours']; }
	public function setBehaviours( array $behaviours ) { $this->data['behaviours'] = $behaviours; }
	public function addBehaviour( AchievementBehaviour $behaviour ) {
		if( !isset( $this->data['behaviours'] ) ) {
			$this->data['behaviours'] = array();
		}
		array_push( $this->data['behaviours'], $behaviour );
	}

	/**
	 * If the achievement is expirable then this field should contain the general
	 * expiration information. See the {@link ExpirationData} object for more information.
	 * Achievements support the following types of reset: never, fixed_period and variable_period
	 * @return
	 */
	public function getExpiration() { return $this->data['expiration']; }
	public function setExpiration( $expiration ) { $this->data['expiration'] = $expiration; }

	/**
	 * Get the count limit which is used to limit the number of times the user
	 * can unlock this particular achievement
	 * @return
	 */
	public function getCountLimit() { return $this->data['countLimit']; }
	public function setCountLimit( $countLimit ) { $this->data['countLimit'] = $countLimit; }


	/**
	 * Return the JSON string equivalent of this object
	 */
	public function getJsonArray()
	{
		$json = $this->data;
		$json['type'] = $this->getType();

		if( isset( $json['expiration'] ) && !is_null( $json['expiration'] ) ) {
			$json['expiration'] = $json['expiration']->getJsonArray();
		}

		if( isset( $json['behaviours'] ) && !is_null( $json['behaviours'] ) ) {
			$behavioursArr = array();
			foreach( $json['behaviours'] as $behaviour ) {
				array_push( $behavioursArr, $behaviour->getJsonArray() );
			}
			$json['behaviours'] = $behavioursArr;
		}

		return $json;
	}
}
?>
