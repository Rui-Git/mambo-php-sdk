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
 * This object captures the data required by the Behaviour API in
 * order to associate activity stream text to a BehaviourRequestData.
 */
class LeafMetadataCondition
{
	private $data = array();


	/**
	 * Constructor which takes the name, operator and value
	 */
    public function __construct( $name, $value, $operator ) {
        $this->data['name'] = $name;
        $this->data['value'] = $value;
        $this->data['operator'] = $operator;
    }


	/**
	 * The type of condition: leaf
	 * @return
	 */
	public function getType() { return 'leaf'; }


	/**
	 * This is the name of the metadata on which we wish to execute the operator.
	 * See the behaviours page in administration panel for more information.
	 * @return
	 */
	public function getName() { return $this->data['name']; }
	public function setName( $name ) { $this->data['name'] = $name; }


	/**
	 * This is the value of the metadata which will be used with the operator.
	 * See the behaviours page in administration panel for more information.
	 * @return
	 */
	public function getValue() { return $this->data['value']; }
	public function setValue( $value ) { $this->data['value'] = $value; }


	/**
	 * This is the operator we wish to use when checking the specified metadata.
	 * Valid operators include:
	 * $gt - greaterThan
	 * $gte - greaterThanOrEqualTo
	 * $lt - lessThan
	 * $lte - lessThanOrEqualTo
	 * $on - on
	 * $non - notOn
	 * $after - after
	 * $onafter - onOrAfter
	 * $before - before
	 * $onbefore - onOrBefore
	 * $eq - equalTo
	 * $neq - notEqualTo
	 * $in - contains
	 * $nin - notContains
	 * $sw - startsWith
	 * $nsw - notStartsWith
	 * $ew - endsWith
	 * $new - notEndsWith
	 * See the behaviours page in administration panel for more information.
	 * @return
	 */
	public function getOperator() { return $this->data['operator']; }
	public function setOperator( $operator ) { $this->data['operator'] = $operator; }


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
