<?php

namespace Tests\Stubs\Models\Bo\RaceCards;

class PreHorseRace extends \Tests\Stubs\Models\PreHorseRace
{
    /**
     * @param int $raceId
     *
     * @return array
     */
    public function getTopspeedHorses($raceId)
    {
        $data = [
            617651 => [
                \Api\Row\HorseRace::createFromArray([
                    'horse_style_name' => 'Briar Hill',
                    'weight_carried_lbs' => 164,
                    'race_status_code' => 3,
                    'race_type_code' => 'H',
                    'horse_uid' => 811858,
                    'rp_topspeed_old' => null,
                    'num_topspeed_best_rating' => null,
                    'rp_postmark' => null,
                    'rp_pm_chars' => null,
                    'race_datetime' => date("Y-m-d ").'12:00',
                    'adjustment' => 30,
                    'country_code' => 'IRE',
                    'course_name' => 'GOWRAN PARK',
                    'course_uid' => 184,
                    'rp_going_type_desc' => 'SOFT',
                    'race_group_code' => 'H',
                    'distance_yard' => 5280,
                ]),
                \Api\Row\HorseRace::createFromArray([
                    'horse_style_name' => 'Zaidpour',
                    'weight_carried_lbs' => 164,
                    'race_status_code' => 3,
                    'race_type_code' => 'F',
                    'horse_uid' => 735305,
                    'rp_topspeed_old' => null,
                    'num_topspeed_best_rating' => null,
                    'rp_postmark' => null,
                    'rp_pm_chars' => null,
                    'race_datetime' => date("Y-m-d ").'12:00',
                    'adjustment' => 16,
                    'country_code' => 'IRE',
                    'course_name' => 'GOWRAN PARK',
                    'course_uid' => 184,
                    'rp_going_type_desc' => 'SOFT',
                    'race_group_code' => 'H',
                    'distance_yard' => 5280,
                ])
            ]
        ];

        return $data[$raceId];
    }
}
