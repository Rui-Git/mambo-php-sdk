<?php

namespace Mambo\Services\Data\Recurrence\Period;

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
 * Represents an object which recurs on a fixed yearly interval.
 * For example:
 * - Yearly in January on the 20th at 13:00PM
 */
class FixedPeriodYearly
{
	private $data = array();


	/**
	 * The type of fixed period: yearly
	 * This field cannot be null.
	 * @return
	 */
	public function getType() { return 'yearly'; }


	/**
	 * The hour indicates the hour on which the object should recur.
	 * Valid values range from 0 to 23 where 0 indicates midnight.
	 * This field cannot be null.
	 * @return
	 */
	public function getHour() { return $this->data['hour']; }
	public function setHour( $hour ) { $this->data['hour'] = $hour; }


	/**
	 * The months indicates the months of the year on which the object should recur. Note that
	 * if you use the WeeksOfYear criteria then these months will be ignored and the weeks will
	 * take precedence over the months.
	 * Valid values range from 1 to 12 where 1 indicates January and 12 indicates December.
	 * This field cannot be null.
	 * @return
	 */
	public function getMonths() { return $this->data['months']; }
	public function setMonths( array $months ) { $this->data['months'] = $months; }


	/**
	 * The year interval indicates every how many years the object should recur.
	 * Valid values range from 1 to 10.
	 * This field cannot be null.
	 * @return
	 */
	public function getYearInterval() { return $this->data['yearInterval']; }
	public function setYearInterval( $yearInterval ) { $this->data['yearInterval'] = $yearInterval; }


	/**
	 * The criteria field indicates on what criteria we should base the recurrence.
	 * The monthly fixed period accepts the following criteria: daysOfMonth and weeksOfMonth
	 * This field cannot be null.
	 * @return
	 */
	public function getCriteria() { return $this->data['criteria']; }
	public function setCriteria( $criteria ) { $this->data['criteria'] = $criteria; }


	/**
	 * The period start date indicates the date from which the interval should start.
	 * Note that only the date portion of the time stamp will be used.
	 * This will be a UTC time stamp in ISO 8601 format with
	 * millisecond precision: YYYY-MM-DDTHH:MM:SS.MMMZ<br>
	 * For example: 2013-01-20T20:43:24.094Z
	 * This field cannot be null.
	 * @return
	 */
	public function getPeriodStart() { return $this->data['periodStart']; }
	public function setPeriodStart( $periodStart ) { $this->data['periodStart'] = $periodStart; }


	/**
	 * Returns the current model as an array ready to
	 * be json_encoded
	 */
	public function getJsonArray()
	{
		$json = $this->data;
		$json['type'] = $this->getType();

		if( isset( $json['criteria'] ) && !is_null( $json['criteria'] ) ) {
			$json['criteria'] = $json['criteria']->getJsonArray();
		}

		return $json;
	}
}
?>
