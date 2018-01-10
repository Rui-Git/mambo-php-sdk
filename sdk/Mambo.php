<?php
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
 * Import all the relevant Mambo PHP SDK files.
 */

// Require all common Mambo classes
require_once(dirname(__FILE__) . '/Common/OAuth.php');
require_once(dirname(__FILE__) . '/Common/Client.php');
require_once(dirname(__FILE__) . '/Common/BaseAbstract.php');
require_once(dirname(__FILE__) . '/Common/APIUrlBuilder.php');

// Require all API related classes
require_once(dirname(__FILE__) . '/Services/ActivitiesService.php');
require_once(dirname(__FILE__) . '/Services/AnalyticsService.php');
require_once(dirname(__FILE__) . '/Services/BehavioursService.php');
require_once(dirname(__FILE__) . '/Services/CouponsService.php');
require_once(dirname(__FILE__) . '/Services/CustomFieldsService.php');
require_once(dirname(__FILE__) . '/Services/LanguagesService.php');
require_once(dirname(__FILE__) . '/Services/LeaderboardsService.php');
require_once(dirname(__FILE__) . '/Services/NotificationsService.php');
require_once(dirname(__FILE__) . '/Services/PointsService.php');
require_once(dirname(__FILE__) . '/Services/PurchasesService.php');
require_once(dirname(__FILE__) . '/Services/RewardsService.php');
require_once(dirname(__FILE__) . '/Services/DataStoresService.php');
require_once(dirname(__FILE__) . '/Services/SitesService.php');
require_once(dirname(__FILE__) . '/Services/TagsService.php');
require_once(dirname(__FILE__) . '/Services/UsersService.php');

// Services data
require_once(dirname(__FILE__) . '/Services/Data/AbstractHasTagRequestData.php');
require_once(dirname(__FILE__) . '/Services/Data/ActivityRequestData.php');
require_once(dirname(__FILE__) . '/Services/Data/BehaviourRequestData.php');
require_once(dirname(__FILE__) . '/Services/Data/ClearNotificationsRequestData.php');
require_once(dirname(__FILE__) . '/Services/Data/CouponRequestData.php');
require_once(dirname(__FILE__) . '/Services/Data/CouponUserRequestData.php');
require_once(dirname(__FILE__) . '/Services/Data/CustomFieldRequestData.php');
require_once(dirname(__FILE__) . '/Services/Data/CustomFieldValueRequestData.php');
require_once(dirname(__FILE__) . '/Services/Data/DeleteRequestData.php');
require_once(dirname(__FILE__) . '/Services/Data/LanguageRequestData.php');
require_once(dirname(__FILE__) . '/Services/Data/LeaderboardRequestData.php');
require_once(dirname(__FILE__) . '/Services/Data/PointRequestData.php');
require_once(dirname(__FILE__) . '/Services/Data/PurchaseRequestData.php');
require_once(dirname(__FILE__) . '/Services/Data/RejectActivityRequestData.php');
require_once(dirname(__FILE__) . '/Services/Data/RewardRequestData.php');
require_once(dirname(__FILE__) . '/Services/Data/DataStoreRequestData.php');
require_once(dirname(__FILE__) . '/Services/Data/SiteRequestData.php');
require_once(dirname(__FILE__) . '/Services/Data/TagRequestData.php');
require_once(dirname(__FILE__) . '/Services/Data/UserRequestData.php');

require_once(dirname(__FILE__) . '/Services/Data/Nested/Metadata/AndMetadataCondition.php');
require_once(dirname(__FILE__) . '/Services/Data/Nested/Metadata/OrMetadataCondition.php');
require_once(dirname(__FILE__) . '/Services/Data/Nested/Metadata/LeafMetadataCondition.php');
require_once(dirname(__FILE__) . '/Services/Data/Nested/Security/ActivitiesJavaScriptSecurity.php');
require_once(dirname(__FILE__) . '/Services/Data/Nested/Security/UsersJavaScriptSecurity.php');
require_once(dirname(__FILE__) . '/Services/Data/Nested/Security/Security.php');
require_once(dirname(__FILE__) . '/Services/Data/Nested/Translation/AbstractTranslation.php');
require_once(dirname(__FILE__) . '/Services/Data/Nested/Translation/BehaviourTranslation.php');
require_once(dirname(__FILE__) . '/Services/Data/Nested/Translation/CouponTranslation.php');
require_once(dirname(__FILE__) . '/Services/Data/Nested/Translation/LeaderboardTranslation.php');
require_once(dirname(__FILE__) . '/Services/Data/Nested/Translation/PointTranslation.php');
require_once(dirname(__FILE__) . '/Services/Data/Nested/Translation/RewardTranslation.php');
require_once(dirname(__FILE__) . '/Services/Data/Nested/Translation/TagTranslation.php');
require_once(dirname(__FILE__) . '/Services/Data/Nested/AchievementBehaviour.php');
require_once(dirname(__FILE__) . '/Services/Data/Nested/ActivityStream.php');
require_once(dirname(__FILE__) . '/Services/Data/Nested/Content.php');
require_once(dirname(__FILE__) . '/Services/Data/Nested/CustomFieldValue.php');
require_once(dirname(__FILE__) . '/Services/Data/Nested/Limit.php');
require_once(dirname(__FILE__) . '/Services/Data/Nested/SimplePoint.php');
require_once(dirname(__FILE__) . '/Services/Data/Nested/ExpiringPoint.php');
require_once(dirname(__FILE__) . '/Services/Data/Nested/FacebookDetails.php');
require_once(dirname(__FILE__) . '/Services/Data/Nested/MonetaryValues.php');
require_once(dirname(__FILE__) . '/Services/Data/Nested/Prize.php');
require_once(dirname(__FILE__) . '/Services/Data/Nested/PrizeTags.php');
require_once(dirname(__FILE__) . '/Services/Data/Nested/Product.php');
require_once(dirname(__FILE__) . '/Services/Data/Nested/Scarcity.php');
require_once(dirname(__FILE__) . '/Services/Data/Nested/TwitterDetails.php');
require_once(dirname(__FILE__) . '/Services/Data/Nested/Units.php');
require_once(dirname(__FILE__) . '/Services/Data/Nested/UserDetails.php');

require_once(dirname(__FILE__) . '/Services/Data/Recurrence/NeverRecurrence.php');
require_once(dirname(__FILE__) . '/Services/Data/Recurrence/FixedDateRecurrence.php');
require_once(dirname(__FILE__) . '/Services/Data/Recurrence/FixedPeriodRecurrence.php');
require_once(dirname(__FILE__) . '/Services/Data/Recurrence/VariablePeriodRecurrence.php');
require_once(dirname(__FILE__) . '/Services/Data/Recurrence/Period/VariablePeriod.php');
require_once(dirname(__FILE__) . '/Services/Data/Recurrence/Period/FixedPeriodHourly.php');
require_once(dirname(__FILE__) . '/Services/Data/Recurrence/Period/FixedPeriodDaily.php');
require_once(dirname(__FILE__) . '/Services/Data/Recurrence/Period/FixedPeriodWeekly.php');
require_once(dirname(__FILE__) . '/Services/Data/Recurrence/Period/FixedPeriodMonthly.php');
require_once(dirname(__FILE__) . '/Services/Data/Recurrence/Period/FixedPeriodYearly.php');
require_once(dirname(__FILE__) . '/Services/Data/Recurrence/Period/Criteria/FixedPeriodCriteriaDaysOfMonth.php');
require_once(dirname(__FILE__) . '/Services/Data/Recurrence/Period/Criteria/FixedPeriodCriteriaWeeksOfMonth.php');
require_once(dirname(__FILE__) . '/Services/Data/Recurrence/Period/Criteria/FixedPeriodCriteriaWeeksOfYear.php');

require_once(dirname(__FILE__) . '/Services/Data/Attributes/ActivityBehaviourAttrs.php');
require_once(dirname(__FILE__) . '/Services/Data/Attributes/ActivityBountyAttrs.php');
require_once(dirname(__FILE__) . '/Services/Data/Attributes/ActivityCouponAttrs.php');
require_once(dirname(__FILE__) . '/Services/Data/Attributes/ActivityGiftedAttrs.php');
require_once(dirname(__FILE__) . '/Services/Data/Attributes/ActivityPointAttrs.php');
require_once(dirname(__FILE__) . '/Services/Data/Attributes/SimpleAttrs.php');
require_once(dirname(__FILE__) . '/Services/Data/Attributes/FlexibleAttrs.php');
require_once(dirname(__FILE__) . '/Services/Data/Attributes/AchievementAttrs.php');
require_once(dirname(__FILE__) . '/Services/Data/Attributes/LevelAttrs.php');
require_once(dirname(__FILE__) . '/Services/Data/Attributes/MissionAttrs.php');
require_once(dirname(__FILE__) . '/Services/Data/Attributes/GiftAttrs.php');
require_once(dirname(__FILE__) . '/Services/Data/Attributes/LeaderboardBehaviourAttrs.php');
require_once(dirname(__FILE__) . '/Services/Data/Attributes/LeaderboardPointAttrs.php');
?>
