<?php

namespace Tests\Stubs\DataProvider\Bo;

use Api\Row\RaceInstance as Row;
use Phalcon\Mvc\Model\Row\General as General;
use Api\Input\Request\Horses\TotePredictor\Race as RaceRequest;
use Api\Input\Request\HorsesRequest as Request;

/**
 * Class TotePredictor
 * @package Tests\Stubs\DataProvider\Bo
 */
class TotePredictor extends \Api\DataProvider\Bo\TotePredictor
{
    /**
     * @param RaceRequest $request
     * @return \Api\Row\RaceInstance
     */
    public function getTotePredictorRace($request)
    {
        $raceId = $request->getRaceId();
        $data = [
            684597 => General::createFromArray([
                'race_instance_uid' => 684597,
                'race_datetime' => 'Sep 21 2017  5:25PM',
                'race_instance_title' => 'Adare Manor Opportunity Handicap Chase',
                'race_type_code' => 'C',
                'race_status_code' => 'O',
                'course_uid' => 175,
                'course_name' => 'Ballinrobe',
                'declared_runners' => 7,
                'actual_runners' => 7,
                'runners' => null,
            ]),
            683560 => General::createFromArray([
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
            1111111 => [],
            683563 => General::createFromArray([
                'race_instance_uid' => 683563,
                'race_datetime' => 'Sep 25 2017  3:40PM',
                'race_instance_title' => 'Racing UK Handicap',
                'race_type_code' => 'F',
                'race_status_code' => 'O',
                'course_uid' => 30,
                'course_name' => 'Leicester',
                'declared_runners' => 9,
                'actual_runners' => 7,
                'runners' => null,
            ]),
        ];

        return $data[$raceId];
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public function getTotePredictorRunners($request)
    {
        return [
            684597 => General::createFromArray([
                'runners' => [
                    773796 =>
                        Row::createFromArray([
                            'horse_uid' => 773796,
                            'horse_name' => 'Gibbstown',
                            'saddle_cloth_no' => 5,
                            'non_runner' => 'N',
                            'score' => 3,
                            'rp_postmark' => 126,
                            'form' => 0,
                            'conditions_score' => 0,
                            'rpr_score' => 0,
                            'form_score' => 0,
                        ]),
                    832051 =>
                        Row::createFromArray([
                            'horse_uid' => 832051,
                            'horse_name' => 'Off The Charts',
                            'saddle_cloth_no' => 3,
                            'non_runner' => 'N',
                            'score' => 2,
                            'rp_postmark' => 106,
                            'form' => 0,
                            'conditions_score' => 0,
                            'rpr_score' => 0,
                            'form_score' => 0,
                        ]),
                    839099 =>
                        Row::createFromArray([
                            'horse_uid' => 839099,
                            'horse_name' => 'Willow Grange',
                            'saddle_cloth_no' => 7,
                            'non_runner' => 'N',
                            'score' => 4,
                            'rp_postmark' => 122,
                            'form' => 0,
                            'conditions_score' => 0,
                            'rpr_score' => 0,
                            'form_score' => 0,
                        ]),
                    849567 =>
                        Row::createFromArray([
                            'horse_uid' => 849567,
                            'horse_name' => 'Aranhill Rascal',
                            'saddle_cloth_no' => 2,
                            'non_runner' => 'N',
                            'score' => 1,
                            'rp_postmark' => 110,
                            'form' => 0,
                            'conditions_score' => 0,
                            'rpr_score' => 0,
                            'form_score' => 0,
                        ]),
                    862568 =>
                        Row::createFromArray([
                            'horse_uid' => 862568,
                            'horse_name' => 'Ard Cregg',
                            'saddle_cloth_no' => 6,
                            'non_runner' => 'N',
                            'score' => 2,
                            'rp_postmark' => 105,
                            'form' => 0,
                            'conditions_score' => 0,
                            'rpr_score' => 0,
                            'form_score' => 0,
                        ]),
                    871909 =>
                        Row::createFromArray([
                            'horse_uid' => 871909,
                            'horse_name' => 'Shrewdoperator',
                            'saddle_cloth_no' => 4,
                            'non_runner' => 'N',
                            'score' => 2,
                            'rp_postmark' => 114,
                            'form' => 0,
                            'conditions_score' => 0,
                            'rpr_score' => 0,
                            'form_score' => 0,
                        ]),
                    904842 =>
                        Row::createFromArray([
                            'horse_uid' => 904842,
                            'horse_name' => 'Caniwillyegiveme',
                            'saddle_cloth_no' => 1,
                            'non_runner' => 'N',
                            'score' => 3,
                            'rp_postmark' => 105,
                            'form' => 5,
                            'conditions_score' => 0,
                            'rpr_score' => 0,
                            'form_score' => 0,
                        ]),
                ]
            ]),
            683560 => General::createFromArray([
                'runners' => []
            ]),
            683563 => General::createFromArray([
                'runners' => [
                    832987 =>
                        Row::createFromArray([
                            'horse_uid' => 832987,
                            'horse_name' => 'Iseemist',
                            'saddle_cloth_no' => 5,
                            'non_runner' => 'N',
                            'score' => 3,
                            'rp_postmark' => 111,
                            'form' => 2,
                            'conditions_score' => 0,
                            'rpr_score' => 0,
                            'form_score' => 0,
                        ]),
                    840983 =>
                        Row::createFromArray([
                            'horse_uid' => 840983,
                            'horse_name' => 'Signore Piccolo',
                            'saddle_cloth_no' => 6,
                            'non_runner' => 'N',
                            'score' => 4,
                            'rp_postmark' => 110,
                            'form' => 2,
                            'conditions_score' => 0,
                            'rpr_score' => 0,
                            'form_score' => 0,
                        ]),
                    852782 =>
                        Row::createFromArray([
                            'horse_uid' => 852782,
                            'horse_name' => 'Union Rose',
                            'saddle_cloth_no' => 4,
                            'non_runner' => 'N',
                            'score' => 3,
                            'rp_postmark' => 108,
                            'form' => 0,
                            'conditions_score' => 0,
                            'rpr_score' => 0,
                            'form_score' => 0,
                        ]),
                    860268 =>
                        Row::createFromArray([
                            'horse_uid' => 860268,
                            'horse_name' => 'Soie D\'Leau',
                            'saddle_cloth_no' => 3,
                            'non_runner' => 'N',
                            'score' => 3,
                            'rp_postmark' => 115,
                            'form' => 3,
                            'conditions_score' => 0,
                            'rpr_score' => 0,
                            'form_score' => 0,
                        ]),
                    885009 =>
                        Row::createFromArray([
                            'horse_uid' => 885009,
                            'horse_name' => 'Willytheconqueror',
                            'saddle_cloth_no' => 1,
                            'non_runner' => 'N',
                            'score' => 6,
                            'rp_postmark' => 121,
                            'form' => 0,
                            'conditions_score' => 0,
                            'rpr_score' => 0,
                            'form_score' => 0,
                        ]),
                    886915 =>
                        Row::createFromArray([
                            'horse_uid' => 886915,
                            'horse_name' => 'Lathom',
                            'saddle_cloth_no' => 8,
                            'non_runner' => 'Y',
                            'score' => 3,
                            'rp_postmark' => 107,
                            'form' => 0,
                            'conditions_score' => 0,
                            'rpr_score' => 0,
                            'form_score' => 0,
                        ]),
                    895486 =>
                        Row::createFromArray([
                            'horse_uid' => 895486,
                            'horse_name' => 'Venturous',
                            'saddle_cloth_no' => 7,
                            'non_runner' => 'Y',
                            'score' => 3,
                            'rp_postmark' => 106,
                            'form' => 0,
                            'conditions_score' => 0,
                            'rpr_score' => 0,
                            'form_score' => 0,
                        ]),
                    998420 =>
                        Row::createFromArray([
                            'horse_uid' => 998420,
                            'horse_name' => 'Somewhere Secret',
                            'saddle_cloth_no' => 9,
                            'non_runner' => 'N',
                            'score' => 3,
                            'rp_postmark' => 102,
                            'form' => 0,
                            'conditions_score' => 0,
                            'rpr_score' => 0,
                            'form_score' => 0,
                        ]),
                    1035081 =>
                        Row::createFromArray([
                            'horse_uid' => 1035081,
                            'horse_name' => 'Smokey Lane',
                            'saddle_cloth_no' => 2,
                            'non_runner' => 'N',
                            'score' => 4,
                            'rp_postmark' => 110,
                            'form' => 5,
                            'conditions_score' => 0,
                            'rpr_score' => 0,
                            'form_score' => 0,
                        ]),
                ]])
        ];
    }

    /**
     * @param array $horseIds
     *
     * @return array
     */
    public function getLastRunPositions($horseIds)
    {
        $data = [
            '773796_832051_839099_849567_862568_871909_904842' => array(
                0 =>
                    Row::createFromArray([
                        'horse_uid' => 773796,
                        'last_pos' => 2,
                    ]),
                1 =>
                    Row::createFromArray([
                        'horse_uid' => 832051,
                        'last_pos' => 63,
                    ]),
                2 =>
                    Row::createFromArray([
                        'horse_uid' => 839099,
                        'last_pos' => 12,
                    ]),
                3 =>
                    Row::createFromArray([
                        'horse_uid' => 849567,
                        'last_pos' => 7,
                    ]),
                4 =>
                    Row::createFromArray([
                        'horse_uid' => 862568,
                        'last_pos' => 63,
                    ]),
                5 =>
                    Row::createFromArray([
                        'horse_uid' => 871909,
                        'last_pos' => 13,
                    ]),
                6 =>
                    Row::createFromArray([
                        'horse_uid' => 904842,
                        'last_pos' => 3,
                    ]),
            ),
            '832987_840983_852782_860268_885009_886915_895486_998420_1035081' => array(
                0 =>
                    Row::createFromArray([
                        'horse_uid' => 832987,
                        'last_pos' => 2,
                    ]),
                1 =>
                    Row::createFromArray([
                        'horse_uid' => 840983,
                        'last_pos' => 6,
                    ]),
                2 =>
                    Row::createFromArray([
                        'horse_uid' => 852782,
                        'last_pos' => 4,
                    ]),
                3 =>
                    Row::createFromArray([
                        'horse_uid' => 860268,
                        'last_pos' => 2,
                    ]),
                4 =>
                    Row::createFromArray([
                        'horse_uid' => 885009,
                        'last_pos' => 11,
                    ]),
                5 =>
                    Row::createFromArray([
                        'horse_uid' => 886915,
                        'last_pos' => 7,
                    ]),
                6 =>
                    Row::createFromArray([
                        'horse_uid' => 895486,
                        'last_pos' => 6,
                    ]),
                7 =>
                    Row::createFromArray([
                        'horse_uid' => 998420,
                        'last_pos' => 1,
                    ]),
                8 =>
                    Row::createFromArray([
                        'horse_uid' => 1035081,
                        'last_pos' => 5,
                    ]),
            )
        ];
        return $data[implode('_', $horseIds)];
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public function getTotePredictorRaces($request)
    {
        $data = [
            684597 => General::createFromArray([
                'race_instance_uid' => 684597,
                'race_datetime' => 'Sep 21 2017  5:25PM',
                'race_instance_title' => 'Adare Manor Opportunity Handicap Chase',
                'race_type_code' => 'C',
                'race_status_code' => 'O',
                'course_uid' => 175,
                'course_name' => 'Ballinrobe',
                'declared_runners' => 7,
                'actual_runners' => 7,
                'runners' => null,
            ]),
            683560 => General::createFromArray([
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
            1111111 => General::createFromArray([]),
            683563 => General::createFromArray([
                'race_instance_uid' => 683563,
                'race_datetime' => 'Sep 25 2017  3:40PM',
                'race_instance_title' => 'Racing UK Handicap',
                'race_type_code' => 'F',
                'race_status_code' => 'O',
                'course_uid' => 30,
                'course_name' => 'Leicester',
                'declared_runners' => 9,
                'actual_runners' => 7,
                'runners' => null,
            ]),
        ];

        if ($request->isParameterProvided('raceId')) {
            $raceId =$request->getRaceId();
            return array($raceId => $data[$raceId]);
        } else {
            return $data;
        }
    }
}
