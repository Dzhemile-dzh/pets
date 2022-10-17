<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\RaceCards\Selections;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 * @package Tests\Controllers\Horses\RaceCards\Selections
 */
class Test extends ApiRouteTestPrototype
{
    public function getRoute(): string
    {
        return '/horses/racecards/selections/692047';
    }

    /**
     * Mocked data
     * Format:
     * 'some_MD5_hash' => [
     *      [row...]
     * ]
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Models\Bo\RaceCards\RaceInstance:82 ->getRaceInstance()
            '899b85b50b82b87edc87a0c142525977' => [
                [
                    'race_id' => 692047,
                    'race_type_code' => 'X',
                    'race_datetime' => '2018-01-05 19:00:00',
                    'race_status_code' => 'R',
                    'distance_yard' => null,
                    'race_group_code' => 'H',
                    'course_uid' => 1138,
                    'rp_abbrev_3' => 'DUN',
                    'country_code' => 'IRE',
                    'course_name' => 'DUNDALK (A.W)',
                    'course_style_name' => 'Dundalk (A.W)',
                    'going_type_code' => 'SD',
                    'going_type_desc' => 'Standard',
                    'declared_runners' => null,
                    'no_of_runners' => null,
                    'rp_tv_text' => 'ATR',
                ],
            ]
            ,//Models\Bo\RaceCards\RaceInstance:82 ->getPublishTime()
            '5c8745ec02ca4bd923b0dd46f2b21d2f' => [
                [
                    'race_content_publish_time' => '2018-01-05 19:00:00',
                ],
            ],
            //Models\Bo\RaceCards\RaceInstance:1445 ->getSelections()
            '3ce7a82e671e15d6918145e3ae9815d0' => [
                [
                    'newspaper_name' => 'SPOTLIGHT',
                    'newspaper_uid' => 1,
                    'sort_order' => 1,
                    'horse_name' => 'Johann Bach',
                    'country_origin_code' => 'IRE',
                    'horse_uid' => 823662,
                    'saddle_cloth_no' => null,
                    'rp_owner_choice' => null,
                    'owner_uid' => null,
                    'selection_type' => 'NB',
                    'selection_type_uid' => 3,
                    'selection_cnt' => -1,
                    'nap_today_count' => null,
                    'rpr_nap' => 0,
                    'going_output' => null,
                    'distance_output' => null,
                    'course_output' => null,
                    'draw_output' => null,
                    'ability_output' => null,
                    'recent_form_output' => null,
                    'trainer_form_output' => null,
                    'rp_postmark' => null,
                    'non_runner' => 'N',
                    'tipster_uid' => 1234,
                    'tipster_name' => 'Cathal Gahan',
                ],
                [
                    'newspaper_name' => 'RP Ratings (IRE)',
                    'newspaper_uid' => 78,
                    'sort_order' => 2,
                    'horse_name' => 'Here For The Craic',
                    'country_origin_code' => 'IRE',
                    'horse_uid' => 782511,
                    'saddle_cloth_no' => null,
                    'rp_owner_choice' => null,
                    'owner_uid' => null,
                    'selection_type' => 'NAP',
                    'selection_type_uid' => 2,
                    'selection_cnt' => -1,
                    'nap_today_count' => null,
                    'rpr_nap' => 0,
                    'going_output' => null,
                    'distance_output' => null,
                    'course_output' => null,
                    'draw_output' => null,
                    'ability_output' => null,
                    'recent_form_output' => null,
                    'trainer_form_output' => null,
                    'rp_postmark' => null,
                    'non_runner' => 'N',
                    'tipster_uid' => 1234,
                    'tipster_name' => 'Cathal Gahan',
                ],
                [
                    'newspaper_name' => 'TOPSPEED',
                    'newspaper_uid' => 3,
                    'sort_order' => 3,
                    'horse_name' => 'Sharjah',
                    'country_origin_code' => 'IRE',
                    'horse_uid' => 814695,
                    'saddle_cloth_no' => null,
                    'rp_owner_choice' => null,
                    'owner_uid' => null,
                    'selection_type' => 'TIP',
                    'selection_type_uid' => 1,
                    'selection_cnt' => -1,
                    'nap_today_count' => null,
                    'rpr_nap' => 0,
                    'going_output' => null,
                    'distance_output' => null,
                    'course_output' => null,
                    'draw_output' => null,
                    'ability_output' => null,
                    'recent_form_output' => null,
                    'trainer_form_output' => null,
                    'rp_postmark' => null,
                    'non_runner' => 'N',
                    'tipster_uid' => 1234,
                    'tipster_name' => 'Cathal Gahan',
                ],
                [
                    'newspaper_name' => 'POSTDATA',
                    'newspaper_uid' => 4,
                    'sort_order' => 4,
                    'horse_name' => 'Ringside Humour',
                    'country_origin_code' => 'IRE',
                    'horse_uid' => 865556,
                    'saddle_cloth_no' => null,
                    'rp_owner_choice' => null,
                    'owner_uid' => null,
                    'selection_type' => 'TIP',
                    'selection_type_uid' => 1,
                    'selection_cnt' => -1,
                    'nap_today_count' => null,
                    'rpr_nap' => 0,
                    'going_output' => null,
                    'distance_output' => null,
                    'course_output' => null,
                    'draw_output' => null,
                    'ability_output' => null,
                    'recent_form_output' => null,
                    'trainer_form_output' => null,
                    'rp_postmark' => null,
                    'non_runner' => 'N',
                    'tipster_uid' => 1234,
                    'tipster_name' => 'Cathal Gahan',
                ],
                [
                    'newspaper_name' => 'The Irish Sun',
                    'newspaper_uid' => 100,
                    'sort_order' => 26,
                    'horse_name' => 'Commander Won',
                    'country_origin_code' => 'IRE',
                    'horse_uid' => 868564,
                    'saddle_cloth_no' => null,
                    'rp_owner_choice' => null,
                    'owner_uid' => null,
                    'selection_type' => 'TIP',
                    'selection_type_uid' => 1,
                    'selection_cnt' => -1,
                    'nap_today_count' => null,
                    'rpr_nap' => 0,
                    'going_output' => null,
                    'distance_output' => null,
                    'course_output' => null,
                    'draw_output' => null,
                    'ability_output' => null,
                    'recent_form_output' => null,
                    'trainer_form_output' => null,
                    'rp_postmark' => null,
                    'non_runner' => 'N',
                    'tipster_uid' => 1234,
                    'tipster_name' => 'Cathal Gahan',
                ],
            ],
        ];
    }
}
