<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 7/7/2016
 * Time: 6:13 PM
 */

namespace Tests\Bo;

use Api\Input\Request\Horses\HorseTracker as Request;
use Tests\Stubs\Bo\HorseTracker as BoStub;

class HorseTrackerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param Request\Rating $request
     * @param array          $expectedResult
     *
     * @dataProvider providerTestGetEntries
     */
    public function testGetEntries($request, $expectedResult)
    {
        $entries = (new BoStub($request))->getEntries();
        $this->assertEquals($expectedResult, $entries);
    }

    /**
     * @return array
     */
    public function providerTestGetEntries()
    {
        return [
            [
                new Request\Entries([], ['userId' => 1]),
                [
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
                ]
            ]
        ];
    }

    /**
     * @param       $request
     * @param array $expectedResult
     *
     * @dataProvider providerTestGetHorseTracker
     */
    public function testGetHorseTracker(
        $request,
        array $expectedResult
    ) {
        $bo = new \Tests\Stubs\Bo\HorseTracker($request);

        $result = $bo->getHorsesByUser();
        $this->assertEquals($result, $expectedResult);
    }

    /**
     * @return array
     */
    public function providerTestGetHorseTracker()
    {
        return [
            [
                new Request\Index([], ['userId' => 1]),
                [
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
            ],
            [
                new Request\Index([], ['userId' => 1, 'raceType' => 'flat', 'age' => '4yo']),
                [
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
                ]
            ]
        ];
    }
}
