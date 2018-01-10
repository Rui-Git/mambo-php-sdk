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
 * This class encapsulates data related to a reward's scarcity.
 * Scarcity allows you to specify the overall number of times that
 * a particular reward can be unlocked. This effectively creates a
 * limited series reward which can only be unlocked X times.
 */
class Scarcity
{
	private $data = array();


	/**
	 * The limit represents the overall number of times that a particular
	 * reward can be unlocked.
	 * See the rewards page in administration panel for more information.
	 * @return
	 */
	public function getLimit() { return $this->data['limit']; }
	public function setLimit( $limit ) { $this->data['limit'] = $limit; }


	/**
	 * The counter represents the overall number of times that a particular
	 * reward has been unlocked. This is only used when a Reward is returned
	 * from the platform.
	 * See the rewards page in administration panel for more information.
	 * @return
	 */
	public function getCounter() { return $this->data['counter']; }
	public function setCounter( $counter ) { $this->data['counter'] = $counter; }


	/**
	 * Returns the current model as an array ready to
	 * be json_encoded
	 */
	public function getJsonArray()
	{
		return $this->data;
	}
}
?>
