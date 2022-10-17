<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Races\RunnersIndex;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

class Test extends ApiRouteTestPrototype
{

    public function getRoute() : string
    {
        return '/horses/races/runners-index/2021-07-16';
    }


    public function getPseudoPdoData() : array
    {
        return [
            //\Bo\Races\  =>140 ->getRaceDateRunnersIndex()
            '3b7a1741d508262b8b04a9f28eaf9c7b' => [
                [
                    "race_instance_uid" => "789495",
                    "horse_uid"  => 2207407,
                    "horse_name" =>  "ANDALUSA",
                    "horse_style_name" => "Andalusa",
                    "horse_age" => 6,
                    "saddle_cloth_no" => 7,
                    "country_origin_code" => "FR",
                    "draw" => null,
                    "owner_uid" => 173689,
                    "days_since_last_run" => null,
                    "days_since_last_run_flat" => null,
                    "days_since_last_run_jumps" => null,
                    "days_since_last_run_ptp" => null,
                    "local_meeting_race_datetime" => "2021-07-16 16:00:00",
                    "hours_difference" => null,
                    "course_uid" => 185,
                    "course_style_name" => "Killarney",
                    "course_name" => "KILLARNEY",
                    "race_date" => "2021-07-16 16:00:00",
                    "jockey_uid" => "83964",
                    "jockey_style_name" => "Brian Hayes",
                    "weight_allowance_lbs" => 0,
                    "trainer_uid" => "1475",
                    "trainer_style_name" => "W P Mullins",
                    "expected_weight_carried_lbs" => 0,
                    "weight_carried_lbs" => 147,
                    "rp_postmark" =>131,
                    "race_type_code" => "C",
                    "race_group_uid" => 15,
                    "course_country_code" => 'IRE',
                    "odds_desc" => "22/1",
                    "figures" => null,
                    "figures_calculated" => null,
                    "final_race_outcome_uid" => 4,
                    "race_outcome_code" => "4",
                    "race_outcome_desc" => "4th",
                    "race_outcome_position" => 4,
                    "race_outcome_joint_yn" => "N",
                    "race_output_order" => 4,
                    "race_outcome_uid" => 4,
                    "orig_race_output_order" => 4,
                    "forecast_odds_value" => 22.0,
                    "forecast_odds_desc" => "22/1",
                    "notes" => "She's very sharp over the shortest trip and loves jumping. I'm not sure she's a real winter-type mare, so we'll give her a little break now as she's been busy. You won't see her when there is soft in the going description. 09-11-20"

                ]
            ],
            'b5f16ad82028e3d2bc98eb87fd8d0e92' => [
                [
                    'race_instance_uid' => 789495,
                    'race_attrib_desc' => "2yo",
                    'race_attrib_code' => 'Age',
                    'race_attrib_uid'  => 1,

                ]
            ],
            '071abb0ab1cdc8ede6c132182f493f4f' => [
                []
            ],
            '512bf1863a682733d776fcd73a3e429c' => [
                []
            ],
            'de97c01ad02ed1d4a2bc1e388417fcb0' => [
                []
            ],
            '90d6ccfeacac4aef4b056b95942d5ce4' =>[
                []
            ],
            '238a8625655bdb5b06a3743d1a91aeb3'=> [
                []
            ],
            '9e77eeeb4fdaf0f0271c80bd5678e6c8' => [
                []
            ],
            '2d1671f8a23744545064c1016ce3b154' => [
                []
            ],
            '707c8ca721ae061b0ab8551c7ddf09b2' => [
                []
            ]
        ];
    }
}
