<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 8/31/2016
 * Time: 12:08 PM
 */

namespace Tests\Bo\GoingToSuit;

use Api\Input\Request\Horses\GoingToSuit as Request;
use Tests\Stubs\Bo\GoingToSuit as Bo;

class GoingToSuitTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param Request\Index $request
     * @param array $expectedResult
     *
     * @dataProvider providerTestGetGoingToSuitSuccess
     */
    public function testGetGoingToSuitSuccess(Request\Index $request, $expectedResult)
    {
        $bo = new Bo\GoingToSuit($request);
        $actualResult = $bo->getGoingToSuit();

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @param Request\Index $request
     *
     * @expectedException \Api\Exception\NotFound
     * @dataProvider providerTestGetGoingToSuitFailure
     */
    public function testGetGoingToSuitFailure(Request\Index $request)
    {
        $bo = new Bo\GoingToSuit($request);
        $bo->getGoingToSuit();
    }

    /**
     * @param Request\Index $request
     * @param array $expectedResult
     *
     * @dataProvider providerTestGetHorsesUidSuccess
     */
    public function testGetHorsesUidSuccess(Request\Index $request, $expectedResult)
    {
        $bo = new Bo\GoingToSuit($request);
        $bo->getGoingToSuit();

        $actualResult = $bo->getHorsesUid();

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @param Request\Index $request
     *
     * @expectedException \Api\Exception\NotFound
     * @dataProvider providerTestGetGoingToSuitFailure
     */
    public function testGetHorsesUidFailure(Request\Index $request)
    {
        $bo = new Bo\GoingToSuit($request);
        $bo->getHorsesUid();
    }

    /**
     * @param Request\Index $request
     * @param               $expectedResult
     * @dataProvider providerTestCombineHorsesAndGoingFormSuccess
     */
    public function testCombineHorsesAndGoingFormSuccess(Request\Index $request, $expectedResult)
    {
        $bo = new Bo\GoingToSuit($request);
        $actualResult = $bo->getGoingToSuit();
        $horsesUid = $bo->getHorsesUid();

        $boProgenyStatGoingForm = new \Tests\Stubs\Bo\Bloodstock\Stallion\ProgenyStatisticsGoingForm($request);
        $bo->combineHorsesAndGoingForm(
            $bo->prepareRows($bo->getRows()),
            $boProgenyStatGoingForm->getGoingFormByHorses($horsesUid)
        );
        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @param Request\Index $request
     *
     * @expectedException \Api\Exception\NotFound
     * @dataProvider providerTestGetGoingToSuitFailure
     */
    public function testCombineHorsesAndGoingFormFailure(Request\Index $request)
    {
        $bo = new Bo\GoingToSuit($request);
        $bo->combineHorsesAndGoingForm(null, null);
    }

    public function providerTestGetGoingToSuitSuccess()
    {
        return [
            [
                new Request\Index([], ['raceId' => 666102]),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'race_instance_uid' => 666102,
                        'race_instance_title' => 'Racing UK Profits Returned To Racing Maiden Hurdle',
                        'race_datetime' => 'Jan 17 2017  1:45PM',
                        'race_status_code' => 'R',
                        'going_type_code' => 'HY',
                        'going_type_desc' => 'Heavy',
                        'distance_yard' => 5350,
                        'race_type_code' => 'H',
                        'race_group_code' => '0',
                        'race_group_desc' => 'Unknown',
                        'perform_race_uid_atr' => null,
                        'perform_race_uid_ruk' => 1214905,
                        'no_of_runners' => null,
                        'country_code' => 'GB',
                        'course_uid' => 3,
                        'course_name' => 'AYR',
                        'course_style_name' => 'Ayr',
                        'declared_runners' => 8,
                        'horses' => [
                            0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'horse_uid' => 919889,
                                    'horse_style_name' => 'Billy Bronco',
                                    'sire_uid' => 458175,
                                    'sire_style_name' => 'Central Park',
                                    'sire_country' => 'IRE',
                                    'jockey_uid' => 13380,
                                    'jockey_style_name' => 'Paul Moloney',
                                    'trainer_uid' => 13451,
                                    'trainer_style_name' => 'Evan Williams',
                                    'owner_uid' => 153545,
                                    'owner_style_name' => 'Mr & Mrs William Rucker',
                                    'non_runner' => null,
                                    'draw' => 0,
                                    'rp_topspeed' => 94,
                                    'rp_postmark' => 129,
                                    'rp_owner_choice' => 'a',
                                    'start_number' => 1,
                                    'going_form' => null,
                                    'horse_name' => 'BILLY BRONCO'
                                ]
                            ),
                            1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'horse_uid' => 928591,
                                    'horse_style_name' => 'Front At The Last',
                                    'sire_uid' => 522793,
                                    'sire_style_name' => 'Golan',
                                    'sire_country' => 'IRE',
                                    'jockey_uid' => 76669,
                                    'jockey_style_name' => 'Will Kennedy',
                                    'trainer_uid' => 15674,
                                    'trainer_style_name' => 'Donald McCain',
                                    'owner_uid' => 63055,
                                    'owner_style_name' => 'Aykroyd And Sons Ltd',
                                    'non_runner' => null,
                                    'draw' => 0,
                                    'rp_topspeed' => 85,
                                    'rp_postmark' => 123,
                                    'rp_owner_choice' => 'a',
                                    'start_number' => 2,
                                    'going_form' => null,
                                    'horse_name' => 'FRONT AT THE LAST'
                                ]
                            ),
                            2 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'horse_uid' => 803906,
                                    'horse_style_name' => 'One Cool Clarkson',
                                    'sire_uid' => 106681,
                                    'sire_style_name' => 'Clerkenwell',
                                    'sire_country' => 'USA',
                                    'jockey_uid' => 87671,
                                    'jockey_style_name' => 'Graham Watters',
                                    'trainer_uid' => 19400,
                                    'trainer_style_name' => 'Neil McKnight',
                                    'owner_uid' => 218450,
                                    'owner_style_name' => 'Neil McKnight',
                                    'non_runner' => null,
                                    'draw' => 0,
                                    'rp_topspeed' => null,
                                    'rp_postmark' => 0,
                                    'rp_owner_choice' => 'a',
                                    'start_number' => 3,
                                    'going_form' => null,
                                    'horse_name' => 'ONE COOL CLARKSON'
                                ]
                            ),
                            3 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'horse_uid' => 902730,
                                    'horse_style_name' => 'Orioninverness',
                                    'sire_uid' => 565327,
                                    'sire_style_name' => 'Brian Boru',
                                    'sire_country' => 'GB',
                                    'jockey_uid' => 88471,
                                    'jockey_style_name' => 'Derek Fox',
                                    'trainer_uid' => 6990,
                                    'trainer_style_name' => 'Lucinda Russell',
                                    'owner_uid' => 158167,
                                    'owner_style_name' => 'Tay Valley Chasers Racing Club',
                                    'non_runner' => null,
                                    'draw' => 0,
                                    'rp_topspeed' => null,
                                    'rp_postmark' => 109,
                                    'rp_owner_choice' => 'a',
                                    'start_number' => 4,
                                    'going_form' => null,
                                    'horse_name' => 'ORIONINVERNESS'
                                ]
                            ),
                            4 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'horse_uid' => 934021,
                                    'horse_style_name' => 'Sideways',
                                    'sire_uid' => 539937,
                                    'sire_style_name' => 'Gamut',
                                    'sire_country' => 'IRE',
                                    'jockey_uid' => 81409,
                                    'jockey_style_name' => 'Brian Hughes',
                                    'trainer_uid' => 28412,
                                    'trainer_style_name' => 'David Dennis',
                                    'owner_uid' => 226415,
                                    'owner_style_name' => 'Favourites Racing Ltd',
                                    'non_runner' => null,
                                    'draw' => 0,
                                    'rp_topspeed' => 76,
                                    'rp_postmark' => 117,
                                    'rp_owner_choice' => 'a',
                                    'start_number' => 5,
                                    'going_form' => null,
                                    'horse_name' => 'SIDEWAYS'
                                ]
                            ),
                            5 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'horse_uid' => 883895,
                                    'horse_style_name' => 'Elusive Theatre',
                                    'sire_uid' => 84432,
                                    'sire_style_name' => 'King\'s Theatre',
                                    'sire_country' => 'IRE',
                                    'jockey_uid' => 92084,
                                    'jockey_style_name' => 'Craig Nichol',
                                    'trainer_uid' => 16596,
                                    'trainer_style_name' => 'S R B Crawford',
                                    'owner_uid' => 203960,
                                    'owner_style_name' => 'David Gordon Roberts',
                                    'non_runner' => null,
                                    'draw' => 0,
                                    'rp_topspeed' => 92,
                                    'rp_postmark' => 118,
                                    'rp_owner_choice' => 'a',
                                    'start_number' => 6,
                                    'going_form' => null,
                                    'horse_name' => 'ELUSIVE THEATRE'
                                ]
                            ),
                            6 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'horse_uid' => 1284539,
                                    'horse_style_name' => 'Lady Of The Clyde',
                                    'sire_uid' => 21792,
                                    'sire_style_name' => 'Lord Americo',
                                    'sire_country' => 'GB',
                                    'jockey_uid' => 92580,
                                    'jockey_style_name' => 'Ross Chapman',
                                    'trainer_uid' => 21516,
                                    'trainer_style_name' => 'Iain Jardine',
                                    'owner_uid' => 11205,
                                    'owner_style_name' => 'Robert H Goldie',
                                    'non_runner' => null,
                                    'draw' => 0,
                                    'rp_topspeed' => null,
                                    'rp_postmark' => 0,
                                    'rp_owner_choice' => 'a',
                                    'start_number' => 7,
                                    'going_form' => null,
                                    'horse_name' => 'LADY OF THE CLYDE'
                                ]
                            ),
                        ],
                    ]
                ),
            ]
        ];
    }

    public function providerTestGetGoingToSuitFailure()
    {
        return [
            [
                new Request\Index([], ['raceId' => 777777])
            ]
        ];
    }

    public function providerTestGetHorsesUidSuccess()
    {
        return [
            [
                new Request\Index([], ['raceId' => 666102]),
                [
                    0 => 919889,
                    1 => 928591,
                    2 => 803906,
                    3 => 902730,
                    4 => 934021,
                    5 => 883895,
                    6 => 1284539,
                ]
            ]
        ];
    }

    public function providerTestCombineHorsesAndGoingFormSuccess()
    {
        return [
            [
                new Request\Index([], ['raceId' => 666102]),
                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                    'race_instance_uid' => 666102,
                    'race_instance_title' => 'Racing UK Profits Returned To Racing Maiden Hurdle',
                    'race_datetime' => 'Jan 17 2017  1:45PM',
                    'race_status_code' => 'R',
                    'going_type_code' => 'HY',
                    'going_type_desc' => 'Heavy',
                    'distance_yard' => 5350,
                    'race_type_code' => 'H',
                    'race_group_code' => '0',
                    'race_group_desc' => 'Unknown',
                    'perform_race_uid_atr' => null,
                    'perform_race_uid_ruk' => 1214905,
                    'no_of_runners' => null,
                    'country_code' => 'GB',
                    'course_uid' => 3,
                    'course_name' => 'AYR',
                    'course_style_name' => 'Ayr',
                    'declared_runners' => 8,
                    'horses' =>
                        array(
                            0 =>
                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                    'horse_uid' => 919889,
                                    'horse_style_name' => 'Billy Bronco',
                                    'horse_name' => 'BILLY BRONCO',
                                    'sire_uid' => 458175,
                                    'sire_style_name' => 'Central Park',
                                    'sire_country' => 'IRE',
                                    'jockey_uid' => 13380,
                                    'jockey_style_name' => 'Paul Moloney',
                                    'trainer_uid' => 13451,
                                    'trainer_style_name' => 'Evan Williams',
                                    'owner_uid' => 153545,
                                    'owner_style_name' => 'Mr & Mrs William Rucker',
                                    'non_runner' => null,
                                    'draw' => 0,
                                    'rp_topspeed' => 94,
                                    'rp_postmark' => 129,
                                    'rp_owner_choice' => 'a',
                                    'start_number' => 1,
                                    'going_form' =>
                                        array(
                                            0 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'horse_uid' => 919889,
                                                    'runs' => 2,
                                                    'wins' => 2,
                                                    'going_group' => 'heavy',
                                                    'going_form' =>
                                                        array(
                                                            0 => 1,
                                                            1 => 1,
                                                        ),
                                                    'sire_going_form' => null,
                                                    'top_rpr_flat' => null,
                                                    'top_rpr_jumps' =>
                                                        \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                            'horse_uid' => 919889,
                                                            'runs' => 2,
                                                            'wins' => 2,
                                                            'going_group' => 'heavy',
                                                            'race_outcome_position' => 1,
                                                            'race_outcome_form_char' => 'U',
                                                            'rp_postmark' => 121,
                                                            'rp_topspeed' => 24,
                                                            'race_type_code' => 'H',
                                                            'race_instance_uid' => 666102,
                                                            'race_datetime' => 'Jan 17 2017  1:45PM',
                                                            'course_uid' => 3,
                                                            'course_name' => 'AYR',
                                                            'rp_abbrev_3' => 'AYR',
                                                            'distance_yard' => 5350,
                                                            'weight_carried_lbs' => 160,
                                                            'no_of_runners' => null,
                                                        )),
                                                    'topspeed_rating' => true,
                                                    'topspeed_flat_race' => null,
                                                    'topspeed_jumps_race' =>
                                                        \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                            'horse_uid' => 919889,
                                                            'runs' => 2,
                                                            'wins' => 2,
                                                            'going_group' => 'heavy',
                                                            'race_outcome_position' => 1,
                                                            'race_outcome_form_char' => 'U',
                                                            'rp_postmark' => 115,
                                                            'rp_topspeed' => 90,
                                                            'race_type_code' => 'B',
                                                            'race_instance_uid' => 666102,
                                                            'race_datetime' => 'Dec 21 2016  12:50PM',
                                                            'course_uid' => 1212,
                                                            'course_name' => 'FFOS LAS',
                                                            'rp_abbrev_3' => 'Ffo',
                                                            'distance_yard' => 4812,
                                                            'weight_carried_lbs' => 160,
                                                            'no_of_runners' => null,
                                                        )),
                                                    'wins_flag' => true,
                                                    'sire_flag' => false,
                                                )),
                                            1 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'horse_uid' => 919889,
                                                    'runs' => 2,
                                                    'wins' => 0,
                                                    'going_group' => 'soft',
                                                    'going_form' =>
                                                        array(
                                                            0 => 3,
                                                            1 => 2,
                                                        ),
                                                    'sire_going_form' => null,
                                                    'top_rpr_flat' => null,
                                                    'top_rpr_jumps' =>
                                                        \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                            'horse_uid' => 919889,
                                                            'runs' => 2,
                                                            'wins' => 0,
                                                            'going_group' => 'soft',
                                                            'race_outcome_position' => 2,
                                                            'race_outcome_form_char' => 'U',
                                                            'rp_postmark' => 126,
                                                            'rp_topspeed' => 75,
                                                            'race_type_code' => 'H',
                                                            'race_instance_uid' => 666102,
                                                            'race_datetime' => 'Dec 21 2016  12:50PM',
                                                            'course_uid' => 1212,
                                                            'course_name' => 'FFOS LAS',
                                                            'rp_abbrev_3' => 'Ffo',
                                                            'distance_yard' => 4812,
                                                            'weight_carried_lbs' => 160,
                                                            'no_of_runners' => null,
                                                        )),
                                                    'topspeed_rating' => false,
                                                    'topspeed_flat_race' => null,
                                                    'topspeed_jumps_race' =>
                                                        \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                            'horse_uid' => 919889,
                                                            'runs' => 2,
                                                            'wins' => 0,
                                                            'going_group' => 'soft',
                                                            'race_outcome_position' => 3,
                                                            'race_outcome_form_char' => 'U',
                                                            'rp_postmark' => 117,
                                                            'rp_topspeed' => 86,
                                                            'race_type_code' => 'H',
                                                            'race_instance_uid' => 666102,
                                                            'race_datetime' => 'Dec 21 2016  12:50PM',
                                                            'course_uid' => 1212,
                                                            'course_name' => 'FFOS LAS',
                                                            'rp_abbrev_3' => 'Ffo',
                                                            'distance_yard' => 4812,
                                                            'weight_carried_lbs' => 160,
                                                            'no_of_runners' => null,
                                                        )),
                                                    'wins_flag' => false,
                                                    'sire_flag' => false,
                                                )),
                                        ),
                                    'sire_going_runs' => 228,
                                    'sire_going_wins' => 23,
                                    'sire_going_form' =>
                                        array(
                                            0 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'going_group' => 'heavy',
                                                    'sire_wins' => 10,
                                                    'sire_runs' => 86,
                                                    'sire_impact_value' => 0.98999999999999999,
                                                )),
                                            1 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'going_group' => 'soft',
                                                    'sire_wins' => 13,
                                                    'sire_runs' => 142,
                                                    'sire_impact_value' => 0.45000000000000001,
                                                )),
                                            2 => \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                'going_group' => 'good_to_soft',
                                                        'sire_wins' => 7,
                                                        'sire_runs' => 137,
                                                        'sire_impact_value' => 0.2600000000000000088817841970012523233890533447265625,
                                                )),
                                            3 => \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'going_group' => 'good',
                                                    'sire_wins' => 25,
                                                    'sire_runs' => 228,
                                                    'sire_impact_value' => 0.340000000000000024424906541753443889319896697998046875
                                                )),
                                            4 => \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'going_group' => 'good_to_firm',
                                                    'sire_wins' => 17,
                                                    'sire_runs' => 101,
                                                    'sire_impact_value' => 1.189999999999999946709294817992486059665679931640625
                                                )),
                                            5 => \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'going_group' => 'firm',
                                                    'sire_wins' => 0,
                                                    'sire_runs' => 13,
                                                    'sire_impact_value' => 0.0
                                                )),
                                        ),
                                )),
                            1 =>
                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                    'horse_uid' => 928591,
                                    'horse_style_name' => 'Front At The Last',
                                    'horse_name' => 'FRONT AT THE LAST',
                                    'sire_uid' => 522793,
                                    'sire_style_name' => 'Golan',
                                    'sire_country' => 'IRE',
                                    'jockey_uid' => 76669,
                                    'jockey_style_name' => 'Will Kennedy',
                                    'trainer_uid' => 15674,
                                    'trainer_style_name' => 'Donald McCain',
                                    'owner_uid' => 63055,
                                    'owner_style_name' => 'Aykroyd And Sons Ltd',
                                    'non_runner' => null,
                                    'draw' => 0,
                                    'rp_topspeed' => 85,
                                    'rp_postmark' => 123,
                                    'rp_owner_choice' => 'a',
                                    'start_number' => 2,
                                    'going_form' =>
                                        array(
                                            0 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'horse_uid' => 928591,
                                                    'runs' => 2,
                                                    'wins' => 1,
                                                    'going_group' => 'heavy',
                                                    'going_form' =>
                                                        array(
                                                            0 => 3,
                                                            1 => 1,
                                                        ),
                                                    'sire_going_form' => null,
                                                    'top_rpr_flat' => null,
                                                    'top_rpr_jumps' => null,
                                                    'topspeed_rating' => false,
                                                    'topspeed_flat_race' => null,
                                                    'topspeed_jumps_race' => null,
                                                    'wins_flag' => true,
                                                    'sire_flag' => false,
                                                )),
                                            1 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'horse_uid' => 928591,
                                                    'runs' => 1,
                                                    'wins' => 0,
                                                    'going_group' => 'soft',
                                                    'going_form' =>
                                                        array(
                                                            0 => 3,
                                                        ),
                                                    'sire_going_form' => null,
                                                    'top_rpr_flat' => null,
                                                    'top_rpr_jumps' => null,
                                                    'topspeed_rating' => true,
                                                    'topspeed_flat_race' => null,
                                                    'topspeed_jumps_race' =>
                                                        \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                            'horse_uid' => 928591,
                                                            'runs' => 1,
                                                            'wins' => 0,
                                                            'going_group' => 'soft',
                                                            'race_outcome_position' => 3,
                                                            'race_outcome_form_char' => 'U',
                                                            'rp_postmark' => 92,
                                                            'rp_topspeed' => 77,
                                                            'race_type_code' => 'H',
                                                            'race_instance_uid' => 660160,
                                                            'race_datetime' => 'Oct 30 2016  1:00PM',
                                                            'course_uid' => 8,
                                                            'course_name' => 'CARLISLE',
                                                            'rp_abbrev_3' => 'CRL',
                                                            'distance_yard' => 4408,
                                                            'weight_carried_lbs' => 152,
                                                            'no_of_runners' => null,
                                                        )),
                                                    'wins_flag' => false,
                                                    'sire_flag' => false,
                                                )),
                                            2 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'horse_uid' => 928591,
                                                    'runs' => 1,
                                                    'wins' => 0,
                                                    'going_group' => 'good_to_soft',
                                                    'going_form' =>
                                                        array(
                                                            0 => 2,
                                                        ),
                                                    'sire_going_form' => null,
                                                    'top_rpr_flat' => null,
                                                    'top_rpr_jumps' =>
                                                        \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                            'horse_uid' => 928591,
                                                            'runs' => 1,
                                                            'wins' => 0,
                                                            'going_group' => 'good_to_soft',
                                                            'race_outcome_position' => 2,
                                                            'race_outcome_form_char' => 'U',
                                                            'rp_postmark' => 115,
                                                            'rp_topspeed' => 61,
                                                            'race_type_code' => 'H',
                                                            'race_instance_uid' => 660160,
                                                            'race_datetime' => 'Oct 30 2016  1:00PM',
                                                            'course_uid' => 8,
                                                            'course_name' => 'CARLISLE',
                                                            'rp_abbrev_3' => 'CRL',
                                                            'distance_yard' => 4408,
                                                            'weight_carried_lbs' => 152,
                                                            'no_of_runners' => null,
                                                        )),
                                                    'topspeed_rating' => false,
                                                    'topspeed_flat_race' => null,
                                                    'topspeed_jumps_race' =>
                                                        \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                            'horse_uid' => 928591,
                                                            'runs' => 1,
                                                            'wins' => 0,
                                                            'going_group' => 'good_to_soft',
                                                            'race_outcome_position' => 2,
                                                            'race_outcome_form_char' => 'U',
                                                            'rp_postmark' => 115,
                                                            'rp_topspeed' => 61,
                                                            'race_type_code' => 'H',
                                                            'race_instance_uid' => 660160,
                                                            'race_datetime' => 'Oct 30 2016  1:00PM',
                                                            'course_uid' => 8,
                                                            'course_name' => 'CARLISLE',
                                                            'rp_abbrev_3' => 'CRL',
                                                            'distance_yard' => 4408,
                                                            'weight_carried_lbs' => 152,
                                                            'no_of_runners' => null,
                                                        )),
                                                    'wins_flag' => false,
                                                    'sire_flag' => false,
                                                )),
                                        ),
                                    'sire_going_runs' => 1576,
                                    'sire_going_wins' => 143,
                                    'sire_going_form' =>
                                        array(
                                            0 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'going_group' => 'heavy',
                                                    'sire_wins' => 34,
                                                    'sire_runs' => 452,
                                                    'sire_impact_value' => 0.51000000000000001,
                                                )),
                                            1 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'going_group' => 'soft',
                                                    'sire_wins' => 75,
                                                    'sire_runs' => 687,
                                                    'sire_impact_value' => 0.46000000000000002,
                                                )),
                                            2 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'going_group' => 'good_to_soft',
                                                    'sire_wins' => 34,
                                                    'sire_runs' => 437,
                                                    'sire_impact_value' => 0.53000000000000003,
                                                )),
                                            3 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'going_group' => 'good',
                                                    'sire_wins' => 91,
                                                    'sire_runs' => 937,
                                                    'sire_impact_value' => 0.309999999999999997779553950749686919152736663818359375
                                                )),
                                            4 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'going_group' => 'good_to_firm',
                                                    'sire_wins' => 28,
                                                    'sire_runs' => 332,
                                                    'sire_impact_value' => 0.689999999999999946709294817992486059665679931640625
                                                )),
                                            5 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'going_group' => 'firm',
                                                    'sire_wins' => 1,
                                                    'sire_runs' => 25,
                                                    'sire_impact_value' => 4.589999999999999857891452847979962825775146484375
                                                )),
                                        ),
                                )),
                            2 =>
                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                    'horse_uid' => 803906,
                                    'horse_style_name' => 'One Cool Clarkson',
                                    'horse_name' => 'ONE COOL CLARKSON',
                                    'sire_uid' => 106681,
                                    'sire_style_name' => 'Clerkenwell',
                                    'sire_country' => 'USA',
                                    'jockey_uid' => 87671,
                                    'jockey_style_name' => 'Graham Watters',
                                    'trainer_uid' => 19400,
                                    'trainer_style_name' => 'Neil McKnight',
                                    'owner_uid' => 218450,
                                    'owner_style_name' => 'Neil McKnight',
                                    'non_runner' => null,
                                    'draw' => 0,
                                    'rp_topspeed' => null,
                                    'rp_postmark' => 0,
                                    'rp_owner_choice' => 'a',
                                    'start_number' => 3,
                                    'going_form' =>
                                        array(
                                            0 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'horse_uid' => 803906,
                                                    'runs' => 9,
                                                    'wins' => 1,
                                                    'going_group' => 'heavy',
                                                    'going_form' =>
                                                        array(
                                                            0 => 5,
                                                            1 => 6,
                                                            2 => 5,
                                                            3 => 2,
                                                            4 => 1,
                                                            5 => 2,
                                                            6 => 2,
                                                            7 => 2,
                                                            8 => 3,
                                                        ),
                                                    'sire_going_form' => null,
                                                    'top_rpr_flat' => null,
                                                    'top_rpr_jumps' => null,
                                                    'topspeed_rating' => false,
                                                    'topspeed_flat_race' => null,
                                                    'topspeed_jumps_race' => null,
                                                    'wins_flag' => true,
                                                    'sire_flag' => false,
                                                )),
                                            1 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'horse_uid' => 803906,
                                                    'runs' => 11,
                                                    'wins' => 1,
                                                    'going_group' => 'soft',
                                                    'going_form' =>
                                                        array(
                                                            0 => 4,
                                                            1 => 3,
                                                            2 => 2,
                                                            3 => 5,
                                                            4 => 1,
                                                            5 => 9,
                                                            6 => 3,
                                                            7 => 8,
                                                            8 => 6,
                                                            9 => 3,
                                                            10 => 5,
                                                        ),
                                                    'sire_going_form' => null,
                                                    'top_rpr_flat' => null,
                                                    'top_rpr_jumps' =>
                                                        \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                            'horse_uid' => 803906,
                                                            'runs' => 11,
                                                            'wins' => 1,
                                                            'going_group' => 'soft',
                                                            'race_outcome_position' => 3,
                                                            'race_outcome_form_char' => 'U',
                                                            'rp_postmark' => 96,
                                                            'rp_topspeed' => 44,
                                                            'race_type_code' => 'C',
                                                            'race_instance_uid' => 616599,
                                                            'race_datetime' => 'Dec 26 2014  1:00PM',
                                                            'course_uid' => 180,
                                                            'course_name' => 'DOWN ROYAL',
                                                            'rp_abbrev_3' => 'DRO',
                                                            'distance_yard' => 4400,
                                                            'weight_carried_lbs' => 152,
                                                            'no_of_runners' => null,
                                                        )),
                                                    'topspeed_rating' => true,
                                                    'topspeed_flat_race' => null,
                                                    'topspeed_jumps_race' =>
                                                        \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                            'horse_uid' => 803906,
                                                            'runs' => 11,
                                                            'wins' => 1,
                                                            'going_group' => 'soft',
                                                            'race_outcome_position' => 3,
                                                            'race_outcome_form_char' => 'U',
                                                            'rp_postmark' => 95,
                                                            'rp_topspeed' => 85,
                                                            'race_type_code' => 'C',
                                                            'race_instance_uid' => 616599,
                                                            'race_datetime' => 'Dec 26 2014  1:00PM',
                                                            'course_uid' => 180,
                                                            'course_name' => 'DOWN ROYAL',
                                                            'rp_abbrev_3' => 'DRO',
                                                            'distance_yard' => 4400,
                                                            'weight_carried_lbs' => 152,
                                                            'no_of_runners' => null,
                                                        )),
                                                    'wins_flag' => true,
                                                    'sire_flag' => false,
                                                )),
                                            2 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'horse_uid' => 803906,
                                                    'runs' => 1,
                                                    'wins' => 0,
                                                    'going_group' => 'good_to_soft',
                                                    'going_form' =>
                                                        array(
                                                            0 => 2,
                                                        ),
                                                    'sire_going_form' => null,
                                                    'top_rpr_flat' => null,
                                                    'top_rpr_jumps' => null,
                                                    'topspeed_rating' => false,
                                                    'topspeed_flat_race' => null,
                                                    'topspeed_jumps_race' => null,
                                                    'wins_flag' => false,
                                                    'sire_flag' => false,
                                                )),
                                        ),
                                    'sire_going_runs' => 372,
                                    'sire_going_wins' => 20,
                                    'sire_going_form' =>
                                        array(
                                            0 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'going_group' => 'heavy',
                                                    'sire_wins' => 7,
                                                    'sire_runs' => 87,
                                                    'sire_impact_value' => 0.63,
                                                )),
                                            1 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'going_group' => 'soft',
                                                    'sire_wins' => 5,
                                                    'sire_runs' => 141,
                                                    'sire_impact_value' => 0.19,
                                                )),
                                            2 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'going_group' => 'good_to_soft',
                                                    'sire_wins' => 8,
                                                    'sire_runs' => 144,
                                                    'sire_impact_value' => 0.28000000000000003,
                                                )),
                                            3 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'going_group' => 'good',
                                                    'sire_wins' => 18,
                                                    'sire_runs' => 208,
                                                    'sire_impact_value' => 0.289999999999999980015985556747182272374629974365234375
                                                )),
                                            4 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'going_group' => 'good_to_firm',
                                                    'sire_wins' => 10,
                                                    'sire_runs' => 80,
                                                    'sire_impact_value' => 1.1100000000000000976996261670137755572795867919921875
                                                )),
                                            5 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'going_group' => 'firm',
                                                    'sire_wins' => 2,
                                                    'sire_runs' => 21,
                                                    'sire_impact_value' => 3.2400000000000002131628207280300557613372802734375
                                                )),
                                        ),
                                )),
                            3 =>
                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                    'horse_uid' => 902730,
                                    'horse_style_name' => 'Orioninverness',
                                    'horse_name' => 'ORIONINVERNESS',
                                    'sire_uid' => 565327,
                                    'sire_style_name' => 'Brian Boru',
                                    'sire_country' => 'GB',
                                    'jockey_uid' => 88471,
                                    'jockey_style_name' => 'Derek Fox',
                                    'trainer_uid' => 6990,
                                    'trainer_style_name' => 'Lucinda Russell',
                                    'owner_uid' => 158167,
                                    'owner_style_name' => 'Tay Valley Chasers Racing Club',
                                    'non_runner' => null,
                                    'draw' => 0,
                                    'rp_topspeed' => null,
                                    'rp_postmark' => 109,
                                    'rp_owner_choice' => 'a',
                                    'start_number' => 4,
                                    'going_form' =>
                                        array(
                                            0 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'horse_uid' => 902730,
                                                    'runs' => 4,
                                                    'wins' => 0,
                                                    'going_group' => 'heavy',
                                                    'going_form' =>
                                                        array(
                                                            0 => 7,
                                                            1 => 4,
                                                            2 => 6,
                                                            3 => 4,
                                                        ),
                                                    'sire_going_form' => null,
                                                    'top_rpr_flat' => null,
                                                    'top_rpr_jumps' =>
                                                        \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                            'horse_uid' => 902730,
                                                            'runs' => 4,
                                                            'wins' => 0,
                                                            'going_group' => 'heavy',
                                                            'race_outcome_position' => 4,
                                                            'race_outcome_form_char' => 'U',
                                                            'rp_postmark' => 101,
                                                            'rp_topspeed' => 32,
                                                            'race_type_code' => 'H',
                                                            'race_instance_uid' => 641662,
                                                            'race_datetime' => 'Jan 19 2016  1:25PM',
                                                            'course_uid' => 3,
                                                            'course_name' => 'AYR',
                                                            'rp_abbrev_3' => 'AYR',
                                                            'distance_yard' => 4500,
                                                            'weight_carried_lbs' => 154,
                                                            'no_of_runners' => null,
                                                        )),
                                                    'topspeed_rating' => false,
                                                    'topspeed_flat_race' => null,
                                                    'topspeed_jumps_race' =>
                                                        \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                            'horse_uid' => 902730,
                                                            'runs' => 4,
                                                            'wins' => 0,
                                                            'going_group' => 'heavy',
                                                            'race_outcome_position' => 4,
                                                            'race_outcome_form_char' => 'U',
                                                            'rp_postmark' => 101,
                                                            'rp_topspeed' => 32,
                                                            'race_type_code' => 'H',
                                                            'race_instance_uid' => 641662,
                                                            'race_datetime' => 'Jan 19 2016  1:25PM',
                                                            'course_uid' => 3,
                                                            'course_name' => 'AYR',
                                                            'rp_abbrev_3' => 'AYR',
                                                            'distance_yard' => 4500,
                                                            'weight_carried_lbs' => 154,
                                                            'no_of_runners' => null,
                                                        )),
                                                    'wins_flag' => false,
                                                    'sire_flag' => false,
                                                )),
                                            1 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'horse_uid' => 902730,
                                                    'runs' => 1,
                                                    'wins' => 0,
                                                    'going_group' => 'soft',
                                                    'going_form' =>
                                                        array(
                                                            0 => 3,
                                                        ),
                                                    'sire_going_form' => null,
                                                    'top_rpr_flat' => null,
                                                    'top_rpr_jumps' => null,
                                                    'topspeed_rating' => true,
                                                    'topspeed_flat_race' => null,
                                                    'topspeed_jumps_race' =>
                                                        \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                            'horse_uid' => 902730,
                                                            'runs' => 1,
                                                            'wins' => 0,
                                                            'going_group' => 'soft',
                                                            'race_outcome_position' => 3,
                                                            'race_outcome_form_char' => 'U',
                                                            'rp_postmark' => 65,
                                                            'rp_topspeed' => 33,
                                                            'race_type_code' => 'H',
                                                            'race_instance_uid' => 641662,
                                                            'race_datetime' => 'Jan 19 2016  1:25PM',
                                                            'course_uid' => 3,
                                                            'course_name' => 'AYR',
                                                            'rp_abbrev_3' => 'AYR',
                                                            'distance_yard' => 4500,
                                                            'weight_carried_lbs' => 154,
                                                            'no_of_runners' => null,
                                                        )),
                                                    'wins_flag' => false,
                                                    'sire_flag' => false,
                                                )),
                                            2 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'horse_uid' => 902730,
                                                    'runs' => 1,
                                                    'wins' => 0,
                                                    'going_group' => 'good_to_soft',
                                                    'going_form' =>
                                                        array(
                                                            0 => 6,
                                                        ),
                                                    'sire_going_form' => null,
                                                    'top_rpr_flat' => null,
                                                    'top_rpr_jumps' => null,
                                                    'topspeed_rating' => false,
                                                    'topspeed_flat_race' => null,
                                                    'topspeed_jumps_race' => null,
                                                    'wins_flag' => false,
                                                    'sire_flag' => false,
                                                )),
                                        ),
                                    'sire_going_runs' => 1723,
                                    'sire_going_wins' => 200,
                                    'sire_going_form' =>
                                        array(
                                            0 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'going_group' => 'heavy',
                                                    'sire_wins' => 65,
                                                    'sire_runs' => 498,
                                                    'sire_impact_value' => 0.73999999999999999,
                                                )),
                                            1 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'going_group' => 'soft',
                                                    'sire_wins' => 79,
                                                    'sire_runs' => 754,
                                                    'sire_impact_value' => 0.38,
                                                )),
                                            2 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'going_group' => 'good_to_soft',
                                                    'sire_wins' => 56,
                                                    'sire_runs' => 471,
                                                    'sire_impact_value' => 0.72999999999999998,
                                                )),
                                            3 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'going_group' => 'good',
                                                    'sire_wins' => 113,
                                                    'sire_runs' => 929,
                                                    'sire_impact_value' => 0.36999999999999999555910790149937383830547332763671875
                                                )),
                                            4 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'going_group' => 'good_to_firm',
                                                    'sire_wins' => 18,
                                                    'sire_runs' => 188,
                                                    'sire_impact_value' => 1.5100000000000000088817841970012523233890533447265625
                                                )),
                                            5 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'going_group' => 'firm',
                                                    'sire_wins' => 1,
                                                    'sire_runs' => 8,
                                                    'sire_impact_value' => 46.280000000000001136868377216160297393798828125
                                                )),
                                        ),
                                )),
                            4 =>
                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                    'horse_uid' => 934021,
                                    'horse_style_name' => 'Sideways',
                                    'horse_name' => 'SIDEWAYS',
                                    'sire_uid' => 539937,
                                    'sire_style_name' => 'Gamut',
                                    'sire_country' => 'IRE',
                                    'jockey_uid' => 81409,
                                    'jockey_style_name' => 'Brian Hughes',
                                    'trainer_uid' => 28412,
                                    'trainer_style_name' => 'David Dennis',
                                    'owner_uid' => 226415,
                                    'owner_style_name' => 'Favourites Racing Ltd',
                                    'non_runner' => null,
                                    'draw' => 0,
                                    'rp_topspeed' => 76,
                                    'rp_postmark' => 117,
                                    'rp_owner_choice' => 'a',
                                    'start_number' => 5,
                                    'going_form' =>
                                        array(
                                            0 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'horse_uid' => 934021,
                                                    'runs' => 3,
                                                    'wins' => 1,
                                                    'going_group' => 'heavy',
                                                    'going_form' =>
                                                        array(
                                                            0 => 4,
                                                            1 => 4,
                                                            2 => 2,
                                                        ),
                                                    'sire_going_form' => null,
                                                    'top_rpr_flat' => null,
                                                    'top_rpr_jumps' =>
                                                        \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                            'horse_uid' => 934021,
                                                            'runs' => 3,
                                                            'wins' => 1,
                                                            'going_group' => 'heavy',
                                                            'race_outcome_position' => 2,
                                                            'race_outcome_form_char' => 'U',
                                                            'rp_postmark' => 109,
                                                            'rp_topspeed' => 18,
                                                            'race_type_code' => 'H',
                                                            'race_instance_uid' => 666102,
                                                            'race_datetime' => 'Jan 17 2017  1:45PM',
                                                            'course_uid' => 3,
                                                            'course_name' => 'AYR',
                                                            'rp_abbrev_3' => 'AYR',
                                                            'distance_yard' => 5350,
                                                            'weight_carried_lbs' => 160,
                                                            'no_of_runners' => null,
                                                        )),
                                                    'topspeed_rating' => false,
                                                    'topspeed_flat_race' => null,
                                                    'topspeed_jumps_race' =>
                                                        \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                            'horse_uid' => 934021,
                                                            'runs' => 3,
                                                            'wins' => 1,
                                                            'going_group' => 'heavy',
                                                            'race_outcome_position' => 2,
                                                            'race_outcome_form_char' => 'U',
                                                            'rp_postmark' => 109,
                                                            'rp_topspeed' => 18,
                                                            'race_type_code' => 'H',
                                                            'race_instance_uid' => 666102,
                                                            'race_datetime' => 'Jan 17 2017  1:45PM',
                                                            'course_uid' => 3,
                                                            'course_name' => 'AYR',
                                                            'rp_abbrev_3' => 'AYR',
                                                            'distance_yard' => 5350,
                                                            'weight_carried_lbs' => 160,
                                                            'no_of_runners' => null,
                                                        )),
                                                    'wins_flag' => true,
                                                    'sire_flag' => false,
                                                )),
                                            1 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'horse_uid' => 934021,
                                                    'runs' => 1,
                                                    'wins' => 0,
                                                    'going_group' => 'soft',
                                                    'going_form' =>
                                                        array(
                                                            0 => 4,
                                                        ),
                                                    'sire_going_form' => null,
                                                    'top_rpr_flat' => null,
                                                    'top_rpr_jumps' =>
                                                        \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                            'horse_uid' => 934021,
                                                            'runs' => 1,
                                                            'wins' => 0,
                                                            'going_group' => 'soft',
                                                            'race_outcome_position' => 4,
                                                            'race_outcome_form_char' => 'U',
                                                            'rp_postmark' => 108,
                                                            'rp_topspeed' => 68,
                                                            'race_type_code' => 'H',
                                                            'race_instance_uid' => 666102,
                                                            'race_datetime' => 'Dec 15 2016  3:10PM',
                                                            'course_uid' => 14,
                                                            'course_name' => 'EXETER',
                                                            'rp_abbrev_3' => 'EXE',
                                                            'distance_yard' => 5085,
                                                            'weight_carried_lbs' => 154,
                                                            'no_of_runners' => null,
                                                        )),
                                                    'topspeed_rating' => true,
                                                    'topspeed_flat_race' => null,
                                                    'topspeed_jumps_race' =>
                                                        \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                            'horse_uid' => 934021,
                                                            'runs' => 1,
                                                            'wins' => 0,
                                                            'going_group' => 'soft',
                                                            'race_outcome_position' => 4,
                                                            'race_outcome_form_char' => 'U',
                                                            'rp_postmark' => 108,
                                                            'rp_topspeed' => 68,
                                                            'race_type_code' => 'H',
                                                            'race_instance_uid' => 666102,
                                                            'race_datetime' => 'Dec 15 2016  3:10PM',
                                                            'course_uid' => 14,
                                                            'course_name' => 'EXETER',
                                                            'rp_abbrev_3' => 'EXE',
                                                            'distance_yard' => 5085,
                                                            'weight_carried_lbs' => 154,
                                                            'no_of_runners' => null,
                                                        )),
                                                    'wins_flag' => false,
                                                    'sire_flag' => false,
                                                )),
                                            2 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'horse_uid' => 934021,
                                                    'runs' => 1,
                                                    'wins' => 0,
                                                    'going_group' => 'good',
                                                    'going_form' =>
                                                        array(
                                                            0 => 4,
                                                        ),
                                                    'sire_going_form' => null,
                                                    'top_rpr_flat' => null,
                                                    'top_rpr_jumps' =>
                                                        \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                            'horse_uid' => 934021,
                                                            'runs' => 1,
                                                            'wins' => 0,
                                                            'going_group' => 'good',
                                                            'race_outcome_position' => 4,
                                                            'race_outcome_form_char' => 'U',
                                                            'rp_postmark' => 106,
                                                            'rp_topspeed' => 26,
                                                            'race_type_code' => 'H',
                                                            'race_instance_uid' => 648378,
                                                            'race_datetime' => 'May 06 2017  1:50PM',
                                                            'course_uid' => 3,
                                                            'course_name' => 'MARKET RASEN',
                                                            'rp_abbrev_3' => 'MAR',
                                                            'distance_yard' => 4539,
                                                            'weight_carried_lbs' => 152,
                                                            'no_of_runners' => null,
                                                        )),
                                                    'topspeed_rating' => false,
                                                    'topspeed_flat_race' => null,
                                                    'topspeed_jumps_race' =>
                                                        \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                            'horse_uid' => 934021,
                                                            'runs' => 1,
                                                            'wins' => 0,
                                                            'going_group' => 'good',
                                                            'race_outcome_position' => 4,
                                                            'race_outcome_form_char' => 'U',
                                                            'rp_postmark' => 106,
                                                            'rp_topspeed' => 26,
                                                            'race_type_code' => 'H',
                                                            'race_instance_uid' => 648378,
                                                            'race_datetime' => 'May 06 2017  1:50PM',
                                                            'course_uid' => 3,
                                                            'course_name' => 'MARKET RASEN',
                                                            'rp_abbrev_3' => 'MAR',
                                                            'distance_yard' => 4539,
                                                            'weight_carried_lbs' => 152,
                                                            'no_of_runners' => null,
                                                        )),
                                                    'wins_flag' => false,
                                                    'sire_flag' => false,
                                                )),
                                        ),
                                    'sire_going_runs' => 953,
                                    'sire_going_wins' => 80,
                                    'sire_going_form' =>
                                        array(
                                            0 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'going_group' => 'heavy',
                                                    'sire_wins' => 18,
                                                    'sire_runs' => 229,
                                                    'sire_impact_value' => 0.41999999999999998,
                                                )),
                                            1 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'going_group' => 'soft',
                                                    'sire_wins' => 28,
                                                    'sire_runs' => 358,
                                                    'sire_impact_value' => 0.27000000000000002,
                                                )),
                                            2 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'going_group' => 'good_to_soft',
                                                    'sire_wins' => 18,
                                                    'sire_runs' => 172,
                                                    'sire_impact_value' => 0.689999999999999946709294817992486059665679931640625
                                                )),
                                            3 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'going_group' => 'good',
                                                    'sire_wins' => 34,
                                                    'sire_runs' => 366,
                                                    'sire_impact_value' => 0.289999999999999980015985556747182272374629974365234375
                                                )),

                                            4 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'going_group' => 'good_to_firm',
                                                    'sire_wins' => 3,
                                                    'sire_runs' => 64,
                                                    'sire_impact_value' => 0.93000000000000004884981308350688777863979339599609375
                                                )),
                                            5 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'going_group' => 'firm',
                                                    'sire_wins' => 0,
                                                    'sire_runs' => 4,
                                                    'sire_impact_value' => 0.0
                                                )),
                                        ),
                                )),
                            5 =>
                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                    'horse_uid' => 883895,
                                    'horse_style_name' => 'Elusive Theatre',
                                    'horse_name' => 'ELUSIVE THEATRE',
                                    'sire_uid' => 84432,
                                    'sire_style_name' => 'King\'s Theatre',
                                    'sire_country' => 'IRE',
                                    'jockey_uid' => 92084,
                                    'jockey_style_name' => 'Craig Nichol',
                                    'trainer_uid' => 16596,
                                    'trainer_style_name' => 'S R B Crawford',
                                    'owner_uid' => 203960,
                                    'owner_style_name' => 'David Gordon Roberts',
                                    'non_runner' => null,
                                    'draw' => 0,
                                    'rp_topspeed' => 92,
                                    'rp_postmark' => 118,
                                    'rp_owner_choice' => 'a',
                                    'start_number' => 6,
                                    'going_form' =>
                                        array(
                                            0 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'horse_uid' => 883895,
                                                    'runs' => 1,
                                                    'wins' => 1,
                                                    'going_group' => 'heavy',
                                                    'going_form' =>
                                                        array(
                                                            0 => 1,
                                                        ),
                                                    'sire_going_form' => null,
                                                    'top_rpr_flat' => null,
                                                    'top_rpr_jumps' =>
                                                        \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                            'horse_uid' => 883895,
                                                            'runs' => 1,
                                                            'wins' => 1,
                                                            'going_group' => 'heavy',
                                                            'race_outcome_position' => 1,
                                                            'race_outcome_form_char' => 'U',
                                                            'rp_postmark' => 112,
                                                            'rp_topspeed' => 27,
                                                            'race_type_code' => 'B',
                                                            'race_instance_uid' => 668097,
                                                            'race_datetime' => 'Feb 25 2017  3:55PM',
                                                            'course_uid' => 37,
                                                            'course_name' => 'NEWCASTLE',
                                                            'rp_abbrev_3' => 'NCS',
                                                            'distance_yard' => 5350,
                                                            'weight_carried_lbs' => 159,
                                                            'no_of_runners' => null,
                                                        )),
                                                    'topspeed_rating' => false,
                                                    'topspeed_flat_race' => null,
                                                    'topspeed_jumps_race' =>
                                                        \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                            'horse_uid' => 883895,
                                                            'runs' => 1,
                                                            'wins' => 1,
                                                            'going_group' => 'heavy',
                                                            'race_outcome_position' => 1,
                                                            'race_outcome_form_char' => 'U',
                                                            'rp_postmark' => 112,
                                                            'rp_topspeed' => 27,
                                                            'race_type_code' => 'B',
                                                            'race_instance_uid' => 668097,
                                                            'race_datetime' => 'Feb 25 2017  3:55PM',
                                                            'course_uid' => 37,
                                                            'course_name' => 'NEWCASTLE',
                                                            'rp_abbrev_3' => 'NCS',
                                                            'distance_yard' => 5350,
                                                            'weight_carried_lbs' => 159,
                                                            'no_of_runners' => null,
                                                        )),
                                                    'wins_flag' => true,
                                                    'sire_flag' => true,
                                                )),
                                            1 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'horse_uid' => 883895,
                                                    'runs' => 3,
                                                    'wins' => 0,
                                                    'going_group' => 'soft',
                                                    'going_form' =>
                                                        array(
                                                            0 => 4,
                                                            1 => 3,
                                                            2 => 3,
                                                        ),
                                                    'sire_going_form' => null,
                                                    'top_rpr_flat' => null,
                                                    'top_rpr_jumps' => null,
                                                    'topspeed_rating' => false,
                                                    'topspeed_flat_race' => null,
                                                    'topspeed_jumps_race' =>
                                                        \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                            'horse_uid' => 883895,
                                                            'runs' => 3,
                                                            'wins' => 0,
                                                            'going_group' => 'soft',
                                                            'race_outcome_position' => 3,
                                                            'race_outcome_form_char' => 'U',
                                                            'rp_postmark' => 98,
                                                            'rp_topspeed' => 65,
                                                            'race_type_code' => 'H',
                                                            'race_instance_uid' => 668097,
                                                            'race_datetime' => 'Feb 25 2017  3:55PM',
                                                            'course_uid' => 37,
                                                            'course_name' => 'NEWCASTLE',
                                                            'rp_abbrev_3' => 'NCS',
                                                            'distance_yard' => 5350,
                                                            'weight_carried_lbs' => 159,
                                                            'no_of_runners' => null,
                                                        )),
                                                    'wins_flag' => false,
                                                    'sire_flag' => false,
                                                )),
                                            2 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'horse_uid' => 883895,
                                                    'runs' => 1,
                                                    'wins' => 1,
                                                    'going_group' => 'good_to_soft',
                                                    'going_form' =>
                                                        array(
                                                            0 => 1,
                                                        ),
                                                    'sire_going_form' => null,
                                                    'top_rpr_flat' => null,
                                                    'top_rpr_jumps' => null,
                                                    'topspeed_rating' => false,
                                                    'topspeed_flat_race' => null,
                                                    'topspeed_jumps_race' => null,
                                                    'wins_flag' => true,
                                                    'sire_flag' => false,
                                                )),
                                            3 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'horse_uid' => 883895,
                                                    'runs' => 2,
                                                    'wins' => 0,
                                                    'going_group' => 'good',
                                                    'going_form' =>
                                                        array(
                                                            0 => 3,
                                                            1 => 4,
                                                        ),
                                                    'sire_going_form' => null,
                                                    'top_rpr_flat' => null,
                                                    'top_rpr_jumps' => null,
                                                    'topspeed_rating' => true,
                                                    'topspeed_flat_race' => null,
                                                    'topspeed_jumps_race' =>
                                                        \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                            'horse_uid' => 883895,
                                                            'runs' => 2,
                                                            'wins' => 0,
                                                            'going_group' => 'good',
                                                            'race_outcome_position' => 4,
                                                            'race_outcome_form_char' => 'U',
                                                            'rp_postmark' => 92,
                                                            'rp_topspeed' => 70,
                                                            'race_type_code' => 'H',
                                                            'race_instance_uid' => 668097,
                                                            'race_datetime' => 'Feb 25 2017  3:55PM',
                                                            'course_uid' => 37,
                                                            'course_name' => 'NEWCASTLE',
                                                            'rp_abbrev_3' => 'NCS',
                                                            'distance_yard' => 5350,
                                                            'weight_carried_lbs' => 159,
                                                            'no_of_runners' => null,
                                                        )),
                                                    'wins_flag' => false,
                                                    'sire_flag' => false,
                                                )),
                                        ),
                                    'sire_going_runs' => 10839,
                                    'sire_going_wins' => 1584,
                                    'sire_going_form' =>
                                        array(
                                            0 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'going_group' => 'heavy',
                                                    'sire_wins' => 233,
                                                    'sire_runs' => 1671,
                                                    'sire_impact_value' => 1.04,
                                                )),
                                            1 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'going_group' => 'soft',
                                                    'sire_wins' => 438,
                                                    'sire_runs' => 3052,
                                                    'sire_impact_value' => 0.56999999999999995,
                                                )),
                                            3 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'going_group' => 'good',
                                                    'sire_wins' => 552,
                                                    'sire_runs' => 3942,
                                                    'sire_impact_value' => 0.440000000000000002220446049250313080847263336181640625
                                                )),

                                            2 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'going_group' => 'good_to_soft',
                                                    'sire_wins' => 361,
                                                    'sire_runs' => 2174,
                                                    'sire_impact_value' => 0.96999999999999997,
                                                )),
                                            4 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'going_group' => 'good_to_firm',
                                                    'sire_wins' => 198,
                                                    'sire_runs' => 1378,
                                                    'sire_impact_value' => 1.2600000000000000088817841970012523233890533447265625
                                                )),
                                            5 =>
                                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                    'going_group' => 'firm',
                                                    'sire_wins' => 21,
                                                    'sire_runs' => 191,
                                                    'sire_impact_value' => 7.1500000000000003552713678800500929355621337890625
                                                )),
                                        ),
                                )),
                            6 =>
                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                    'horse_uid' => 1284539,
                                    'horse_style_name' => 'Lady Of The Clyde',
                                    'horse_name' => 'LADY OF THE CLYDE',
                                    'sire_uid' => 21792,
                                    'sire_style_name' => 'Lord Americo',
                                    'sire_country' => 'GB',
                                    'jockey_uid' => 92580,
                                    'jockey_style_name' => 'Ross Chapman',
                                    'trainer_uid' => 21516,
                                    'trainer_style_name' => 'Iain Jardine',
                                    'owner_uid' => 11205,
                                    'owner_style_name' => 'Robert H Goldie',
                                    'non_runner' => null,
                                    'draw' => 0,
                                    'rp_topspeed' => null,
                                    'rp_postmark' => 0,
                                    'rp_owner_choice' => 'a',
                                    'start_number' => 7,
                                    'going_form' => null,
                                    'sire_going_runs' => 0,
                                    'sire_going_wins' => 0,
                                    'sire_going_form' => array(
                                        0 => \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                'going_group' => 'heavy',
                                                'sire_wins' => 137,
                                                'sire_runs' => 1581,
                                                'sire_impact_value' => 0.59999999999999997779553950749686919152736663818359375,
                                            )),
                                        1 => \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                'going_group' => 'soft',
                                                'sire_wins' => 211,
                                                'sire_runs' => 2638,
                                                'sire_impact_value' => 0.320000000000000006661338147750939242541790008544921875
                                            )),
                                        2 => \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                'going_group' => 'good_to_soft',
                                                'sire_wins' => 150,
                                                'sire_runs' => 1662,
                                                'sire_impact_value' => 0.57999999999999996003197111349436454474925994873046875
                                            )),
                                        3 => \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                'going_group' => 'good',
                                                'sire_wins' => 313,
                                                'sire_runs' => 3087,
                                                'sire_impact_value' => 0.340000000000000024424906541753443889319896697998046875
                                            )),
                                        4 => \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                'going_group' => 'good_to_firm',
                                                'sire_wins' => 138,
                                                'sire_runs' => 1372,
                                                'sire_impact_value' => 0.770000000000000017763568394002504646778106689453125
                                            )),
                                        5 => \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                                'going_group' => 'firm',
                                                'sire_wins' => 36,
                                                'sire_runs' => 283,
                                                'sire_impact_value' => 4.87999999999999989341858963598497211933135986328125
                                            ))
                                    ),
                                )),
                        ),
                ))
            ]
        ];
    }
}
