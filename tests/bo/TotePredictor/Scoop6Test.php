<?php

namespace Tests\Bo\TotePredictor;

use Api\Row\RaceInstance as Row;
use Phalcon\Mvc\Model\Row\General as General;
use Tests\Stubs\Bo\TotePredictor\Meeting\Scoop6;
use Api\Input\Request\Horses\TotePredictor\Meeting\Scoop6 as Request;

/**
 * Class Scoop6Test
 *
 * @package Tests\Bo\TotePredictor
 */
class Scoop6Test extends \PHPUnit\Framework\TestCase
{
    /**
     * @param Request $request
     * @param General $expectedResult
     *
     * @dataProvider providerTestGetData
     */
    public function testGetData(Request $request, $expectedResult)
    {
        $bo = new Scoop6($request);
        $actualResult = $bo->getData();
        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @return array
     */
    public function providerTestGetData()
    {
        return [
            [
                new Request([], ['date' => '2017-11-27',]),
                [
                    General::createFromArray(
                        [
                            'race_instance_uid' => 684597,
                            'race_datetime' => 'Sep 21 2017  5:25PM',
                            'race_instance_title' => 'Adare Manor Opportunity Handicap Chase',
                            'race_type_code' => 'C',
                            'race_status_code' => 'O',
                            'course_uid' => 175,
                            'course_name' => 'Ballinrobe',
                            'declared_runners' => 7,
                            'actual_runners' => 7,
                            'runners' => [
                                Row::createFromArray(
                                    [
                                        'horse_uid' => 904842,
                                        'horse_name' => 'Caniwillyegiveme',
                                        'saddle_cloth_no' => 1,
                                        'non_runner' => 'N',
                                        'score' => 3,
                                        'rp_postmark' => 105,
                                        'form' => 8,
                                        'conditions_score' => 6,
                                        'rpr_score' => 2,
                                        'form_score' => 7,
                                        'bet_prompt_score' => 5,
                                        'trainer_jockey_score' => 7,
                                        'total_score' => 22,
                                        'predicted_position' => 1,
                                    ]
                                ),
                                Row::createFromArray(
                                    [
                                        'horse_uid' => 773796,
                                        'horse_name' => 'Gibbstown',
                                        'saddle_cloth_no' => 5,
                                        'non_runner' => 'N',
                                        'score' => 3,
                                        'rp_postmark' => 126,
                                        'form' => 4,
                                        'conditions_score' => 6,
                                        'rpr_score' => 7,
                                        'form_score' => 6,
                                        'bet_prompt_score' => 0,
                                        'trainer_jockey_score' => 0,
                                        'total_score' => 19,
                                        'predicted_position' => 2,
                                    ]
                                ),
                            ],
                        ]
                    ),
                    General::createFromArray(
                        [
                            'race_instance_uid' => 683560,
                            'race_datetime' => 'Sep 25 2017  4:55PM',
                            'race_instance_title' => 'Members Of Hamilton Park Racecourse Handicap',
                            'race_type_code' => 'F',
                            'race_status_code' => 'A',
                            'course_uid' => 22,
                            'course_name' => 'Hamilton',
                            'declared_runners' => 10,
                            'actual_runners' => 0,
                            'runners' => null,
                        ]
                    ),
                    General::createFromArray(
                        [
                            'race_instance_uid' => 683563,
                            'race_datetime' => 'Sep 25 2017  3:40PM',
                            'race_instance_title' => 'Racing UK Handicap',
                            'race_type_code' => 'F',
                            'race_status_code' => 'O',
                            'course_uid' => 30,
                            'course_name' => 'Leicester',
                            'declared_runners' => 9,
                            'actual_runners' => 7,
                            'runners' => [
                                Row::createFromArray(
                                    [
                                        'horse_uid' => 860268,
                                        'horse_name' => 'Soie D\'Leau',
                                        'saddle_cloth_no' => 3,
                                        'non_runner' => 'N',
                                        'score' => 3,
                                        'rp_postmark' => 115,
                                        'form' => 7,
                                        'conditions_score' => 4,
                                        'rpr_score' => 6,
                                        'form_score' => 7,
                                        'bet_prompt_score' => 0,
                                        'trainer_jockey_score' => 0,
                                        'total_score' => 17,
                                        'predicted_position' => 1,
                                    ]
                                ),
                                Row::createFromArray(
                                    [
                                        'horse_uid' => 1035081,
                                        'horse_name' => 'Smokey Lane',
                                        'saddle_cloth_no' => 2,
                                        'non_runner' => 'N',
                                        'score' => 4,
                                        'rp_postmark' => 110,
                                        'form' => 6,
                                        'conditions_score' => 6,
                                        'rpr_score' => 4,
                                        'form_score' => 6,
                                        'bet_prompt_score' => 0,
                                        'trainer_jockey_score' => 0,
                                        'total_score' => 16,
                                        'predicted_position' => 2,
                                    ]
                                ),
                                Row::createFromArray(
                                    [
                                        'horse_uid' => 832987,
                                        'horse_name' => 'Iseemist',
                                        'saddle_cloth_no' => 5,
                                        'non_runner' => 'N',
                                        'score' => 3,
                                        'rp_postmark' => 111,
                                        'form' => 6,
                                        'conditions_score' => 4,
                                        'rpr_score' => 5,
                                        'form_score' => 6,
                                        'bet_prompt_score' => 0,
                                        'trainer_jockey_score' => 0,
                                        'total_score' => 15,
                                        'predicted_position' => 3,
                                    ]
                                ),
                            ],
                        ]
                    ),
                ],
            ],
        ];
    }
}
