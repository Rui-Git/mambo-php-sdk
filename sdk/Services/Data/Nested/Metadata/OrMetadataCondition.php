<?php

namespace Mambo\Services\Data\Metadata;

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
 * Contains a list of metadata conditions joined by a logical OR operator.
 */
class OrMetadataCondition
{
	private $data = array();

	/**
	 * The type of condition: or
	 * @return
	 */
	public function getType() { return 'or'; }


	/**
     * Contains all the conditions which need to be joined
     * together with an "or" logical operator.
	 * @return
	 */
	public function getConditions() { return $this->data['conditions']; }
	public function setConditions( $conditions ) { $this->data['conditions'] = $conditions; }


	/**
	 * Returns the current model as an array ready to
	 * be json_encoded
	 */
	public function getJsonArray()
	{
		$json = $this->data;
		$json['type'] = $this->getType();

		if( isset( $json['conditions'] ) && !is_null( $json['conditions'] ) ) {
			$conditionsArr = array();
			foreach( $json['conditions'] as $condition ) {
				array_push( $conditionsArr, $condition->getJsonArray() );
			}
			$json['conditions'] = $conditionsArr;
		}

		return $json;
	}
}
?>
