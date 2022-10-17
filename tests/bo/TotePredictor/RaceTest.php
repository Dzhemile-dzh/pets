<?php

namespace Tests\Bo\TotePredictor;

use Api\Row\RaceInstance as Row;
use Phalcon\Mvc\Model\Row\General;
use Tests\Stubs\Bo\TotePredictor\Race as Bo;
use Api\Input\Request\Horses\TotePredictor\Race as Request;

/**
 * Class RaceTest
 *
 * @package Tests\Bo\TotePredictor
 */
class RaceTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param Request      $request
     * @param General|null $expectedResult
     *
     * @dataProvider providerTestGetData
     */
    public function testGetData(Request $request, General $expectedResult = null)
    {
        $bo = new Bo($request);

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
                new Request([], ['raceId' => 684597]),
                General::createFromArray([
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
                        Row::createFromArray([
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
                        ]),
                        Row::createFromArray([
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
                        ]),
                        Row::createFromArray([
                            'horse_uid' => 832051,
                            'horse_name' => 'Off The Charts',
                            'saddle_cloth_no' => 3,
                            'non_runner' => 'N',
                            'score' => 2,
                            'rp_postmark' => 106,
                            'form' => 0,
                            'conditions_score' => 4,
                            'rpr_score' => 3,
                            'form_score' => 0,
                            'bet_prompt_score' => 5,
                            'trainer_jockey_score' => 7,
                            'total_score' => 14,
                            'predicted_position' => 3,
                        ]),
                        Row::createFromArray([
                            'horse_uid' => 839099,
                            'horse_name' => 'Willow Grange',
                            'saddle_cloth_no' => 7,
                            'non_runner' => 'N',
                            'score' => 4,
                            'rp_postmark' => 122,
                            'form' => 0,
                            'conditions_score' => 7,
                            'rpr_score' => 6,
                            'form_score' => 0,
                            'bet_prompt_score' => 0,
                            'trainer_jockey_score' => 0,
                            'total_score' => 13,
                            'predicted_position' => 4,
                        ]),
                        Row::createFromArray([
                            'horse_uid' => 849567,
                            'horse_name' => 'Aranhill Rascal',
                            'saddle_cloth_no' => 2,
                            'non_runner' => 'N',
                            'score' => 1,
                            'rp_postmark' => 110,
                            'form' => 0,
                            'conditions_score' => 1,
                            'rpr_score' => 4,
                            'form_score' => 0,
                            'bet_prompt_score' => 5,
                            'trainer_jockey_score' => 7,
                            'total_score' => 12,
                            'predicted_position' => 5,
                        ]),
                        Row::createFromArray([
                            'horse_uid' => 871909,
                            'horse_name' => 'Shrewdoperator',
                            'saddle_cloth_no' => 4,
                            'non_runner' => 'N',
                            'score' => 2,
                            'rp_postmark' => 114,
                            'form' => 0,
                            'conditions_score' => 4,
                            'rpr_score' => 5,
                            'form_score' => 0,
                            'bet_prompt_score' => 0,
                            'trainer_jockey_score' => 0,
                            'total_score' => 9,
                            'predicted_position' => 6,
                        ]),
                        Row::createFromArray([
                            'horse_uid' => 862568,
                            'horse_name' => 'Ard Cregg',
                            'saddle_cloth_no' => 6,
                            'non_runner' => 'N',
                            'score' => 2,
                            'rp_postmark' => 105,
                            'form' => 0,
                            'conditions_score' => 4,
                            'rpr_score' => 2,
                            'form_score' => 0,
                            'bet_prompt_score' => 0,
                            'trainer_jockey_score' => 0,
                            'total_score' => 6,
                            'predicted_position' => 7,
                        ]),
                    ],
                ]),
            ],
            [
                new Request([], ['raceId' => 683560]),
                General::createFromArray([
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
                ]),
            ],
            [
                new Request([], ['raceId' => 1111111]),
                null,
            ],
        ];
    }
}
