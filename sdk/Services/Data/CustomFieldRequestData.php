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
 * This object captures the data required by the Custom Field API in
 * order to create / update custom fields.
 */
class CustomFieldRequestData
{
	private $data = array();


	/**
	 * The target type of the custom field. Valid types include: user.
	 * @return
	 */
	public function getTargetType() { return $this->data['targetType']; }
	public function setTargetType( $targetType ) { $this->data['targetType'] = $targetType; }


	/**
	 * The name of the custom field.
	 * @return
	 */
	public function getFieldName() { return $this->data['fieldName']; }
	public function setFieldName( $fieldName ) { $this->data['fieldName'] = $fieldName; }


	/**
	 * The type of the custom field. Valid types include: string and int.
	 * @return
	 */
	public function getFieldType() { return $this->data['fieldType']; }
	public function setFieldType( $fieldType ) { $this->data['fieldType'] = $fieldType; }


	/**
	 * Returns the current model as an array ready to
	 * be json_encoded
	 */
	public function getJsonString()
	{
		return json_encode( $this->data );
	}
}
?>
