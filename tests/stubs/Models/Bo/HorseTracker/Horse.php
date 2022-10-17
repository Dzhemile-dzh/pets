<?php

namespace Tests\Stubs\Models\Bo\HorseTracker;

class Horse extends \Tests\Stubs\Models\Horse
{
    /**
     * @param $request
     *
     * @return static
     */
    public function getHorsesByUser(\Api\Input\Request\Horses\HorseTracker\Index $request)
    {
        $key = md5(serialize($request));
        $result =  [
            'e4820b2f28b9060339d1c134d40b3aa0' => [
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 589690,
                        'horse_name' => 'DUBAWI',
                        'horse_style_name' => 'Dubawi',
                        'country_origin_code' => 'IRE',
                        'horse_date_of_birth' => 'Feb  7 2002 12:00AM',
                        'dam_uid' => 476753,
                        'sire_uid' => 504160,
                        'sire_horse_name' => 'DUBAI MILLENNIUM',
                        'sire_style_name' => 'Dubai Millennium',
                        'dam_horse_name' => 'ZOMARADAH',
                        'dam_style_name' => 'Zomaradah',
                        'owner_uid' => 49845,
                        'owner_name' => 'GODOLPHIN',
                        'owner_style_name' => 'Godolphin',
                        'trainer_uid' => 9546,
                        'trainer_name' => 'SAEED BIN SUROOR',
                        'trainer_style_name' => 'Saeed bin Suroor',
                        'horse_entered' => 0,
                        'horse_declared' => 1,
                        'wins' => 5,
                        'runs' => 10,
                        'stake' => 10.5,
                        'note' => 'asdasd',
                        'horse_age' => 3,
                        'rpr_figure' => 95,
                        'next_race_type_code' => 'F',
                        'last_race_type_code' => 'F',
                    ]
                )
            ],
            '55ebf767f358fbbe909f3c3c39b2b65f' => [
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 589690,
                        'horse_name' => 'DUBAWI',
                        'horse_style_name' => 'Dubawi',
                        'country_origin_code' => 'IRE',
                        'horse_date_of_birth' => 'Feb  7 2002 12:00AM',
                        'dam_uid' => 476753,
                        'sire_uid' => 504160,
                        'sire_horse_name' => 'DUBAI MILLENNIUM',
                        'sire_style_name' => 'Dubai Millennium',
                        'dam_horse_name' => 'ZOMARADAH',
                        'dam_style_name' => 'Zomaradah',
                        'owner_uid' => 49845,
                        'owner_name' => 'GODOLPHIN',
                        'owner_style_name' => 'Godolphin',
                        'trainer_uid' => 9546,
                        'trainer_name' => 'SAEED BIN SUROOR',
                        'trainer_style_name' => 'Saeed bin Suroor',
                        'horse_entered' => 0,
                        'horse_declared' => 1,
                        'wins' => 5,
                        'runs' => 10,
                        'stake' => 10.5,
                        'note' => 'asdasd',
                        'horse_age' => 4,
                        'rpr_figure' => null,
                        'next_race_type_code' => 'F',
                        'last_race_type_code' => 'F',
                    ]
                )
            ]
        ];

        return $result[$key];
    }
}
