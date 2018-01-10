<?php

namespace Mambo\Services\Data;

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
 * This object captures the data required by the User / Behaviour
 * and Reward objects to modify the custom fields
 */
class CustomFieldValueRequestData
{
	private $data = array();

	/**
	 * Custom fields to be changed in the desired object.
	 * @return
	 */
	public function getCustomFields() { return $this->data['customFields']; }
	public function setCustomFields( array $customFields ) { $this->data['customFields'] = $customFields; }


	/**
	 * Returns the current model as an array ready to
	 * be json_encoded
	 */
	public function getJsonString()
	{
		$json = $this->data;

		if( isset( $json['customFields'] ) && !is_null( $json['customFields'] ) ) {
			$customFieldsArr = array();
			foreach( $json['customFields'] as $customField ) {
				array_push( $customFieldsArr, $customField->getJsonArray() );
			}
			$json['customFields'] = $customFieldsArr;
		}

		return json_encode( $json );
	}
}
?>
