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
 * This class encapsulates data related to prizes
 */
class PrizeTags
{
	private $data = array();


	/**
	 * This should contain the list of the IDs of the tags which
	 * must be added to or remove from a user when the prize is unlocked.
	 * @return
	 */
	public function getTagIds() { return $this->data['tagIds']; }
	public function setTagIds( array $tagIds ) { $this->data['tagIds'] = $tagIds; }


	/**
	 * This should contain the list of the tags which must be added to or remove from a user when the prize is unlocked.
	 * This method accepts the actual tag value, for example: hr_dept, finance_dept, etc.
	 * @return
	 */
	public function getTagTags() { return $this->data['tagTags']; }
	public function setTagTags( array $tagTags ) { $this->data['tagTags'] = $tagTags; }


	/**
	 * Return the JSON string equivalent of this object
	 */
	public function getJsonArray()
	{
		return $this->data;
	}
}
?>
