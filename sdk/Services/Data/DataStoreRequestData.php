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
 * This object captures the data required by the DataStore API in
 * order to create / update data stores.
 */
class DataStoreRequestData
{
	private $data = array();


	/**
	 * The name of the data store.
	 * @return
	 */
	public function getName() { return $this->data['name']; }
	public function setName( $name ) { $this->data['name'] = $name; }

	/**
	 * The type of the data store.
	 * @return
	 */
	public function getType() { return $this->data['type']; }
	public function setType( $type ) { $this->data['type'] = $type; }

	/**
	 * The data of the data store.
	 * @return
	 */
	public function getData() { return $this->data['data']; }
	public function setData( $data ) { $this->data['data'] = $data; }


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
