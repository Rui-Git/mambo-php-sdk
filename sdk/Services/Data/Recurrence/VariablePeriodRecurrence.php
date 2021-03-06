<?php

namespace Mambo\Services\Data\Recurrence;

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
 * Represents an object which recurs on a variable time interval
 * which begins from the date the object was created.
 * For example:
 * - 2 hours after creation
 * - 3 days after creation
 * - 4 weeks after creation
 * - 5 months after creation
 * - 6 years after creation
 */
class VariablePeriodRecurrence
{
	private $data = array();


	/**
	 * The type of recurrence: variable_period
	 * This field cannot be null.
	 * @return
	 */
	public function getType() { return 'variable_period'; }


	/**
	 * Defines a period of time after which an object should recur.
	 * See the {@link VariablePeriod} object for more information.
	 * @return
	 */
	public function getPeriod() { return $this->data['period']; }
	public function setPeriod( $period ) { $this->data['period'] = $period; }


	/**
	 * Returns the current model as an array ready to
	 * be json_encoded
	 */
	public function getJsonArray()
	{
		$json = $this->data;
		$json['type'] = $this->getType();

		if( isset( $json['period'] ) && !is_null( $json['period'] ) ) {
			$json['period'] = $json['period']->getJsonArray();
		}

		return $json;
	}
}
?>
