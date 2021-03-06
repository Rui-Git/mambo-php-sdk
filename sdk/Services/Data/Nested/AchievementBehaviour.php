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
 * This object captures the data required by the Reward API in
 * order to associate behaviours to an AchievementAttrs.
 */
class AchievementBehaviour
{
	private $data = array();


	/**
	 * The ID of the behaviour that must be performed by the user in order to
	 * unlock the achievement. Each behaviour has a corresponding behaviourId.
	 * See the achievement page in administration panel for more information.
	 * @return
	 */
	public function getBehaviourId() { return $this->data['behaviourId']; }
	public function setBehaviourId( $behaviourId ) { $this->data['behaviourId'] = (string) $behaviourId; }

	/**
	 * The total number of timers a user must repeat the behaviour in
	 * order to unlock the achievement. See the achievement page in
	 * administration panel for more information.
	 * @return
	 */
	public function getTimes() { return $this->data['times']; }
	public function setTimes( $times ) { $this->data['times'] = $times; }


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
