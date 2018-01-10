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
 * Represents an object which recurs on specific weeks of a month and days.
 * For example:
 * - On the 1st and 2nd week on the Monday and Friday
 */
class FixedPeriodCriteriaWeeksOfMonth
{
	private $data = array();


	/**
	 * The type of fixed period criteria: weeksOfMonth
	 * This field cannot be null.
	 * @return
	 */
	public function getType() { return 'weeksOfMonth'; }


	/**
	 * The days indicates the days of the week on which the object should recur.
	 * Valid values range from 0 to 6 where 0 indicates Monday and 6 indicates Sunday.
	 * This field cannot be null.
	 * @return
	 */
	public function getDaysOfWeek() { return $this->data['daysOfWeek']; }
	public function setDaysOfWeek( array $daysOfWeek ) { $this->data['daysOfWeek'] = $daysOfWeek; }


	/**
	 * The weeks of month indicate on which weeks of the month the object should recur.
	 * Valid values range from 1 to 5 where 1 is the 1st week and 5 is "the last week" of the month.
	 * This field cannot be null.
	 * @return
	 */
	public function getWeeksOfMonth() { return $this->data['weeksOfMonth']; }
	public function setWeeksOfMonth( array $weeksOfMonth ) { $this->data['weeksOfMonth'] = $weeksOfMonth; }


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
