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
 * This class encapsulates data related to a custom field.
 */
class CustomFieldValue
{
	private $data = array();


	/**
	 * The name of the custom field.
	 * @return
	 */
	public function getName() { return $this->data['name']; }
	public function setName( array $name ) { $this->data['name'] = $name; }


	/**
	 * The value of the custom field.
	 * @return
	 */
	public function getValue() { return $this->data['value']; }
	public function setValue( array $value ) { $this->data['value'] = $value; }


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
