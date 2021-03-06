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
 * This object captures the data required by the Behaviour API in
 * order to create / update simple behaviours
 */
class SimpleAttrs
{
	/**
	 * The type of attribute
	 * @return
	 */
	public function getType() { return 'simple'; }


	/**
	 * Return the JSON string equivalent of this object
	 */
	public function getJsonArray()
	{
		$json = array();
		$json['type'] = $this->getType();
		return $json;
	}
}
?>
