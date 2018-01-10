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
 * Abstract RequestData used by objects which can have
 * translations associated to them
 */
abstract class AbstractTranslation
{
	protected $data = array();


	/**
	 * The language code associated to this specific translation.
	 * See the language page in administration panel for more information.
	 * @return
	 */
	public function getLanguageCode() { return $this->data['languageCode']; }
	public function setLanguageCode( $languageCode ) { $this->data['languageCode'] = $languageCode; }
}
?>
