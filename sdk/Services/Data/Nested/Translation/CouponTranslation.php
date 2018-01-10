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
 * This object captures the data required by the Coupon API in
 * order to associate translations to a Coupon.
 */
class CouponTranslation extends AbstractTranslation
{

	/**
	 * The name of the coupon.
	 * @return
	 */
	public function getName() { return $this->data['name']; }
	public function setName( $name ) { $this->data['name'] = $name; }

	/**
	 * In the case of a custom based coupon, thus field should contain information
	 * relating to the nature of the coupon that is being given. For example: buy 1
	 * get 1 free.
	 * @return
	 */
	public function getCustomPrize() { return $this->data['custom']; }
	public function setCustomPrize( $custom ) { $this->data['custom'] = $custom; }

	/**
	 * The message to be displayed in the coupon purchasing screen. This can provide
	 * more information about the coupon, how to redeem it, any exceptions for the
	 * coupon, etc.
	 * @return
	 */
	public function getHelpMessage() { return $this->data['helpMessage']; }
	public function setHelpMessage( $helpMessage ) { $this->data['helpMessage'] = $helpMessage; }


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
