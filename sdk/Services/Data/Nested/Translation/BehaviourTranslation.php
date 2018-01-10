<?php

namespace Mambo\Services\Data\Nested\Translation;

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
 * order to associate translations to a Behaviour.
 */
class BehaviourTranslation extends AbstractTranslation
{

	/**
	 * The Behaviour's name
	 * @return
	 */
	public function getName() { return $this->data['name']; }
	public function setName( $name ) { $this->data['name'] = $name; }

	/**
	 * The message associated with the behaviour.
	 * This will be displayed in the notifications.
	 * @return
	 */
	public function getMessage() { return $this->data['message']; }
	public function setMessage( $message ) { $this->data['message'] = $message; }

	/**
	 * The Behaviour's hint. This is displayed to the end user when you
	 * wish to make them aware of what behaviours you are rewarding.
	 * @return
	 */
	public function getHint() { return $this->data['hint']; }
	public function setHint( $hint ) { $this->data['hint'] = $hint; }

	/**
	 * The text that prefixes the content object in the activity stream.
	 * The activity stream has the following format:
	 * User [contentPrefix] content-object [targetPrefix] target-object
	 * For example: John Doe [has posted] an article [to their] wall
	 * See the behaviours page in administration panel for more information.
	 * @return
	 */
	public function getContentPrefix() { return $this->data['contentPrefix']; }
	public function setContentPrefix( $contentPrefix ) { $this->data['contentPrefix'] = $contentPrefix; }

	/**
	 * The text that prefixes the target object in the activity stream.
	 * The activity stream has the following format:
	 * User [contentPrefix] content-object [targetPrefix] target-object
	 * For example: John Doe [has posted] an article [to their] wall
	 * See the behaviours page in administration panel for more information.
	 * @return
	 */
	public function getTargetPrefix() { return $this->data['targetPrefix']; }
	public function setTargetPrefix( $targetPrefix ) { $this->data['targetPrefix'] = $targetPrefix; }

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
