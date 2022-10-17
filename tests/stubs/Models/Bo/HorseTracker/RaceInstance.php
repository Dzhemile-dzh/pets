<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 7/7/2016
 * Time: 4:06 PM
 */

namespace Tests\Stubs\Models\Bo\HorseTracker;

use Api\Input\Request\Horses\HorseTracker as Request;

class RaceInstance extends \Models\Bo\HorseTracker\RaceInstance
{
    /**
     * @param Request\Entries $request
     *
     * @return array
     */
    public function getEntries(Request\Entries $request)
    {
        return [
            0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 760774,
                    'horse_name' => 'ASKER',
                    'horse_style_name' => 'Asker',
                    'horse_country_origin_code' => 'IRE',
                    'horse_age' => 8,
                    'sire_uid' => 546212,
                    'sire_horse_name' => 'HIGH CHAPARRAL',
                    'sire_style_name' => 'High Chaparral',
                    'dam_uid' => 52437,
                    'dam_horse_name' => 'PAY THE BANK',
                    'dam_style_name' => 'Pay The Bank',
                    'races' =>
                    [
                        0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'race_instance_uid' => 655195,
                                'race_datetime' => 'Aug  2 2016  5:30PM',
                                'race_status_code' => 'O',
                                'race_instance_title' => 'Bathwick Tyres Salisbury Handicap',
                                'distance_yard' => 3101,
                                'race_group_code' => 'H',
                                'race_group_desc' => 'Handicap',
                                'saddle_cloth_no' => 7,
                                'running_conditions' => null,
                                'rp_postmark' => 0,
                                'rp_owner_choice' => 'b',
                                'course_name' => 'SALISBURY',
                                'course_uid' => 52,
                                'course_style_name' => 'Salisbury',
                                'jockey_uid' => 93237,
                                'jockey_style_name' => 'Kieran Shoemark',
                                'owner_uid' => 185498,
                                'owner_name' => 'THE OUTSIDE CHANCE RACING CLUB',
                                'trainer_uid' => 5641,
                                'trainer_name' => 'NICK LAMPARD',
                                'race_class' => '6',
                                'big_race_entry' => 'N',
                                'declared' => 0
                            ]
                        ),
                    ],
                ]
            ),
        ];
    }
}
