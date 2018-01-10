<?php

namespace Mambo\Services\Data\Nested;

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
 * order to associate rate / count limits to a BehaviourRequestData.
 */
class Limit
{
	private $data = array();


	/**
	 * Get the count which determines the number of repetitions of this behaviour per user
	 * @return
	 */
	public function getCount() { return $this->data['count']; }
	public function setCount( $count ) { $this->data['count'] = $count; }


	/**
	 * Get the scope which is used to apply the count limit to a specific metadata's values.
	 * For example, you could limit the behaviour to one repetition per blog_id or per product_sku.
	 * Note: the count scope is only applied on Flexible Behaviours.
	 * @return
	 */
	public function getScope() { return $this->data['scope']; }
	public function setScope( $scope ) { $this->data['scope'] = $scope; }


	/**
	 * This determines how often the count is reset. This could be never (i.e. a finite repetition per user),
	 * or it could be a recurring period of fixed time (i.e. reset the count every 12 hours, or every 2 days).
	 * Limit supports the following types of resets: never and fixed_period
	 * @return
	 */
	public function getExpiration() { return $this->data['expiration']; }
	public function setExpiration( $expiration ) { $this->data['expiration'] = $expiration; }


	/**
	 * Return the JSON string equivalent of this object
	 */
	public function getJsonArray()
	{
		$json = $this->data;

		if( isset( $json['expiration'] ) && !is_null( $json['expiration'] ) ) {
			$json['expiration'] = $json['expiration']->getJsonArray();
		}

		return $json;
	}
}
?>
