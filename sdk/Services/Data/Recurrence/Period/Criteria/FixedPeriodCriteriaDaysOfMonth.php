<?php

namespace Mambo\Services\Data\Recurrence\Period\Criteria;

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
 * Represents an object which recurs on specific days of the month.
 * For example:
 * - On the 12th and 24th
 */
class FixedPeriodCriteriaDaysOfMonth
{
	private $data = array();


	/**
	 * The type of fixed period criteria: daysOfMonth
	 * This field cannot be null.
	 * @return
	 */
	public function getType() { return 'daysOfMonth'; }


	/**
	 * The days of month field indicates the days of the month on which the object should recur.
	 * Valid values range from 1 to 31 where 1 indicates the first day of the month.
	 * This field cannot be null.
	 * @return
	 */
	public function getDaysOfMonth() { return $this->data['daysOfMonth']; }
	public function setDaysOfMonth( array $daysOfMonth ) { $this->data['daysOfMonth'] = $daysOfMonth; }


	/**
	 * Returns the current model as an array ready to
	 * be json_encoded
	 */
	public function getJsonArray()
	{
		$json = $this->data;
		$json['type'] = $this->getType();
		return $json;
	}
}
?>
