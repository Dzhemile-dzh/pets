<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Native\Results\ResultsList;

use UnitTestsComponents\ApiRouteTest\Xml as ApiRouteTestPrototype;

/**
 * @package Tests\Controllers\Horses\Native\Results\ResultsList
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/native/results/2018-06-18/list';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\Native\Results\ResultsList:21 ->getData()
            '8d53d68c528f995841be2bc342e53c24' => [
                [
                    'course_uid' => 4,
                    'course_name' => 'Ascot',
                    'course_country' => 'GB',
                    'race_instance_uid' => 637806,
                    'race_status_code' => 'R',
                    'race_datetime' => '2018-06-18 2:40:00',
                    'pool_prize_sterling' => 5000.00,
                    'card_details_available' => 0,
                    'horse_name' => 'Rock On Ruby',
                    'position' => 1,
                    'race_outcome_code' => 1,
                    'rate' => '15/8',
                    'query_position' => 1,
                    'race_group_uid' => null,
                    'race_class' => null,
                    'rp_tv_text' => null

                ],
                // AD-806 requires specific hard-coding depending on course_uid 31 and 393
                // In order to group them and avoid small differences in the names
                // NB: The login for grouping under the same name doesn't count on IDs but strings.
                //      It is safe to change the IDs if needed.
                [
                    'course_uid' => 393,
                    'course_name' => 'Lingfield (A.W)',
                    'course_country' => 'GB',
                    // The ids are hardcoded in some order for better expectations readability.
                    'race_instance_uid' => 123,
                    'race_status_code' => 'R',
                    // all race times are hardcoded so we can check if the order is correct in the result
                    // They have to be sorted by date
                    'race_datetime' => '2018-06-18 3:41:00',
                    'pool_prize_sterling' => 4500.00,
                    'card_details_available' => 0,
                    'horse_name' => 'Snow King 1',
                    'position' => 1,
                    'race_outcome_code' => 1,
                    'rate' => '16/1',
                    'query_position' => 1,
                    'race_group_uid' => null,
                    'race_class' => null,
                    'rp_tv_text' => null
                ],
                [
                    'course_uid' => 3,
                    'course_name' => 'Aqueduct',
                    'course_country' => 'USA',
                    'race_instance_uid' => 642564,
                    'race_status_code' => 'R',
                    'race_datetime' => '2018-06-18 8:21:00',
                    'pool_prize_sterling' => 7000.00,
                    'card_details_available' => 0,
                    'horse_name' => 'Res Judicata',
                    'position' => 1,
                    'race_outcome_code' => 1,
                    'rate' => '46/1',
                    'query_position' => 2,
                    'race_group_uid' => null,
                    'race_class' => null,
                    'rp_tv_text' => null
                ],
                [
                    'course_uid' => 5,
                    'course_name' => 'Camden (South Carolina)',
                    'course_country' => 'USA',
                    'race_instance_uid' => 639888,
                    'race_status_code' => 'R',
                    'race_datetime' => '2018-06-18 7:00:00',
                    'pool_prize_sterling' => 6000.00,
                    'card_details_available' => 0,
                    'horse_name' => 'Dawalan',
                    'position' => 1,
                    'race_outcome_code' => 1,
                    'rate' => '',
                    'query_position' => 2,
                    'race_group_uid' => null,
                    'race_class' => null,
                    'rp_tv_text' => null
                ],
                // The same course uid will make the DB group the same races under the same uid.
                [
                    'course_uid' => 31,
                    'course_name' => 'Lingfield',
                    'course_country' => 'ARO',
                    'race_instance_uid' => 1234,
                    'race_status_code' => 'R',
                    'race_datetime' => '2018-06-18 3:42:00',
                    'pool_prize_sterling' => 6200.00,
                    'card_details_available' => 0,
                    'horse_name' => 'Snow King 2',
                    'position' => 1,
                    'race_outcome_code' => 1,
                    'rate' => '16/1',
                    'query_position' => 1,
                    'race_group_uid' => null,
                    'race_class' => null,
                    'rp_tv_text' => null
                ],
                // By requirement the course uid with more races should stay in the result
                // and incorporate the other races from the one with similar name (id: 393)
                // So we expect all Lingfield races to be grouped under this one.
                // And I am choosing this one because of the logic behind renaming the (GB) to (ARAB) in the result.
                // so we still have a test for this logic even though we are grouping the rest under this one.
                [
                    'course_uid' => 31,
                    'course_name' => 'Lingfield',
                    'course_country' => 'ARO',
                    'race_instance_uid' => 12345,
                    'race_status_code' => 'R',
                    'race_datetime' => '2018-06-18 3:43:00',
                    'pool_prize_sterling' => 6000.00,
                    'card_details_available' => 0,
                    'horse_name' => 'Snow King 3',
                    'position' => 1,
                    'race_outcome_code' => 1,
                    'rate' => '16/1',
                    'query_position' => 1,
                    'race_group_uid' => null,
                    'race_class' => null,
                    'rp_tv_text' => null
                ],
                [
                    'course_uid' => 5,
                    'course_name' => 'Lingfield (GB)',
                    'course_country' => 'ARO',
                    'race_instance_uid' => 123456,
                    'race_status_code' => 'R',
                    'race_datetime' => '2018-06-18 3:44:00',
                    'pool_prize_sterling' => 7500.00,
                    'card_details_available' => 0,
                    'horse_name' => 'Snow King 4',
                    'position' => 1,
                    'race_outcome_code' => 1,
                    'rate' => '16/1',
                    'query_position' => 1,
                    'race_group_uid' => null,
                    'race_class' => null,
                    'rp_tv_text' => null
                ],
                [
                    'course_uid' => 6,
                    'course_name' => 'Lingfield (A.W) (GB)',
                    'course_country' => 'ARO',
                    'race_instance_uid' => 1234567,
                    'race_status_code' => 'R',
                    'race_datetime' => '2018-06-18 3:45:00',
                    'pool_prize_sterling' => 5000.00,
                    'card_details_available' => 0,
                    'horse_name' => 'Snow King 5',
                    'position' => 1,
                    'race_outcome_code' => 1,
                    'rate' => '16/1',
                    'query_position' => 1,
                    'race_group_uid' => null,
                    'race_class' => null,
                    'rp_tv_text' => null
                ],
                [
                    'course_uid' => 7,
                    'course_name' => 'Wexford (RH)',
                    'course_country' => 'IRE',
                    'race_instance_uid' => 637715,
                    'race_status_code' => 'R',
                    'race_datetime' => '2018-06-18 3:45:00',
                    'pool_prize_sterling' => 4500.00,
                    'card_details_available' => 0,
                    'horse_name' => 'Snow King',
                    'position' => 1,
                    'race_outcome_code' => 1,
                    'rate' => '16/1',
                    'query_position' => 2,
                    'race_group_uid' => null,
                    'race_class' => null,
                    'rp_tv_text' => null
                ],
                [
                    'course_uid' => 7,
                    'course_name' => 'Southwell  (a.w) (gb)',
                    'course_country' => 'ARO',
                    'race_instance_uid' => 637715,
                    'race_status_code' => 'R',
                    'race_datetime' => '2018-06-18 3:45:00',
                    'pool_prize_sterling' => 6500.00,
                    'card_details_available' => 0,
                    'horse_name' => 'Snow King',
                    'position' => 1,
                    'race_outcome_code' => 1,
                    'rate' => '16/1',
                    'query_position' => 2,
                    'race_group_uid' => null,
                    'race_class' => null,
                    'rp_tv_text' => null
                ],
                [
                    'course_uid' => 7,
                    'course_name' => 'Maisons-laffitte',
                    'course_country' => 'FR',
                    'race_instance_uid' => 637715,
                    'race_status_code' => 'R',
                    'race_datetime' => '2018-06-18 3:45:00',
                    'pool_prize_sterling' => 3700.00,
                    'card_details_available' => 0,
                    'horse_name' => 'Snow King',
                    'position' => 1,
                    'race_outcome_code' => 1,
                    'rate' => '16/1',
                    'query_position' => 2,
                    'race_group_uid' => null,
                    'race_class' => null,
                    'rp_tv_text' => null
                ]
            ],
        ];
    }
}
