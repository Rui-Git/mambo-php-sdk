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
class Prize
{
	private $data = array();


	/**
	 * If this reward has an associated coupon, this should contain
	 * the coupon's ID.
	 * @return
	 */
	public function getCouponId() { return $this->data['couponId']; }
	public function setCouponId( $couponId ) { $this->data['couponId'] = (string) $couponId; }


	/**
	 * If this reward has an associated coupon, this determines if
	 * the coupon information should be displayed in the widgets.
	 * If this is set to false then the coupon model should be null.
	 * @return
	 */
	public function getHideCoupon() { return $this->data['hideCoupon']; }
	public function setHideCoupon( $hideCoupon ) { $this->data['hideCoupon'] = $hideCoupon; }


	/**
	 * The prize points. The points will assigned to a
	 * user who performs a behaviour or unlocks a reward.
	 * @return
	 */
	public function getPoints() { return $this->data['points']; }
	public function setPoints( array $points ) { $this->data['points'] = $points; }
	public function addPoint( ExpiringPoint $point ) {
		if( !isset( $this->data['points'] ) ) {
			$this->data['points'] = array();
		}
		array_push( $this->data['points'], $point );
	}


	/**
	 * Tags to be added to a user when they unlock this prize
	 * @return
	 */
	public function getAddTags() { return $this->data['addTags']; }
	public function setAddTags( PrizeTags $addTags ) { $this->data['addTags'] = $addTags; }


	/**
	 * Tags to be removed from a user when they unlock this prize
	 * @return
	 */
	public function getRemoveTags() { return $this->data['removeTags']; }
	public function setRemoveTags( PrizeTags $removeTags ) { $this->data['removeTags'] = $removeTags; }


	/**
	 * Return the JSON string equivalent of this object
	 */
	public function getJsonArray()
	{
		$json = $this->data;

		if( isset( $json['points'] ) && !is_null( $json['points'] ) ) {
			$pointsArr = array();
			foreach( $json['points'] as $point ) {
				array_push( $pointsArr, $point->getJsonArray() );
			}
			$json['points'] = $pointsArr;
		}

		if( isset( $json['addTags'] ) && !is_null( $json['addTags'] ) ) {
			$json['addTags'] = $json['addTags']->getJsonArray();
		}

		if( isset( $json['removeTags'] ) && !is_null( $json['removeTags'] ) ) {
			$json['removeTags'] = $json['removeTags']->getJsonArray();
		}

		return $json;
	}
}
?>
