<?php

namespace Tests\Bo;

class BetFinderTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param \Api\Input\Request\Horses\BetFinder\Index $request
     * @param array                                     $expectedResult
     *
     * @dataProvider providerTestGetBetFinderFullData
     */
    public function testGetBetFinderFullData(
        \Api\Input\Request\Horses\BetFinder\Index $request,
        array $expectedResult
    ) {
        $courseProfileObject = new \Tests\Stubs\Bo\BetFinder($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($courseProfileObject->getBetFinderFullData())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetBetFinderFullData()
    {
        return [
            [
                new \Api\Input\Request\Horses\BetFinder\Index([]),
                array(
                    'bets' => array(
                        0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'weight_allowance_lbs' => 0,
                                'rp_owner_choice' => 'a',
                                'sire_horse_name' => 'Needle Gun',
                                'max_version' => '00000000000294e1',
                                'uid' => 21801,
                                'race_uid' => 646082,
                                'race_datetime' => 'Apr  7 2016  2:40PM',
                                'race_jump' => 1,
                                'race_8runners' => 1,
                                'race_run_nos' => 12,
                                'race_type' => 'H',
                                'race_going' => 'G ',
                                'owner_uid' => 24748,
                                'owner_choice' => 'a',
                                'ctry_code' => 'GB',
                                'course_uid' => 73,
                                'course_name' => 'TAUNTON',
                                'horse_uid' => 974094,
                                'horse_name' => 'Sticking Point',
                                'horse_name_lc' => 'stickingpoint',
                                'trainer_uid' => 15642,
                                'trainer_name' => 'Martin Keighley',
                                'trainer_name_lc' => 'martinkeighley',
                                'jockey_uid' => 80153,
                                'jockey_name' => 'Andrew Tinkler',
                                'jockey_name_lc' => 'andrewtinkler',
                                'winner' => 0,
                                'placed' => 0,
                                'bfv' => 0,
                                'postmark' => 0,
                                'topspeed' => 0,
                                'silk_red' => 1,
                                'silk_orange' => 0,
                                'silk_yellow' => 0,
                                'silk_green' => 0,
                                'silk_blue' => 0,
                                'silk_purple' => 0,
                                'silk_pink' => 0,
                                'silk_black' => 0,
                                'silk_white' => 0,
                                'silk_brown' => 0,
                                'improver' => 0,
                                'drop_in_class' => 0,
                                'blinkers' => 0,
                                'big_trainer' => 0,
                                'trainer_inform' => 0,
                                'course_trainer' => 0,
                                'trainer_fur_trv' => 0,
                                'big_jockey' => 0,
                                'jockey_inform' => 0,
                                'course_jockey' => 0,
                                'one_tr_jockey' => 0,
                                'suit_going' => 0,
                                'suit_course' => 0,
                                'suit_dist' => 0,
                                'spotlight' => 0,
                                'postdata' => 0,
                                'lambourn' => 0,
                                'north' => 0,
                                'daily_tel' => 0,
                                'times' => 0,
                                'telegraph' => 0,
                                'guardian' => 0,
                                'daily_mail' => 0,
                                'daily_exp' => 0,
                                'daily_mir' => 0,
                                'sun' => 0,
                                'star' => 0,
                                'daily_rec' => 0,
                                'nap' => 0,
                                'fc_odds_uid' => 53,
                                'fc_odds_value' => 66,
                                'fc_odds' => '66/1',
                                'fc_fav' => 0,
                                'fc_long_shot' => 1,
                                'course_style_name' => 'Taunton',
                                'hcap' => 0,
                                'tricast' => 0,
                                'ruk' => 0,
                                'atr' => 0,
                                'saddle_no' => 9,
                                'weight_allow' => 0,
                                'rp_owner_choice1' => 'a',
                                'sire_uid' => 77833,
                                'sire_name' => 'Needle Gun',
                                'version' => '000000000002935c',
                                'deleted' => 0,
                            )
                        ),
                        1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'weight_allowance_lbs' => 5,
                                'rp_owner_choice' => 'a',
                                'sire_horse_name' => 'Sixties Icon',
                                'max_version' => '00000000000294e1',
                                'uid' => 21802,
                                'race_uid' => 646082,
                                'race_datetime' => 'Apr  7 2016  2:40PM',
                                'race_jump' => 1,
                                'race_8runners' => 1,
                                'race_run_nos' => 12,
                                'race_type' => 'H',
                                'race_going' => 'G ',
                                'owner_uid' => 56556,
                                'owner_choice' => 'a',
                                'ctry_code' => 'GB',
                                'course_uid' => 73,
                                'course_name' => 'TAUNTON',
                                'horse_uid' => 871319,
                                'horse_name' => 'Mr Kite',
                                'horse_name_lc' => 'mrkite',
                                'trainer_uid' => 27170,
                                'trainer_name' => 'Harry Fry',
                                'trainer_name_lc' => 'harryfry',
                                'jockey_uid' => 89984,
                                'jockey_name' => 'Mr M Legg',
                                'jockey_name_lc' => 'mrmlegg',
                                'winner' => 0,
                                'placed' => 0,
                                'bfv' => 0,
                                'postmark' => 0,
                                'topspeed' => 0,
                                'silk_red' => 0,
                                'silk_orange' => 0,
                                'silk_yellow' => 0,
                                'silk_green' => 0,
                                'silk_blue' => 0,
                                'silk_purple' => 0,
                                'silk_pink' => 0,
                                'silk_black' => 0,
                                'silk_white' => 1,
                                'silk_brown' => 0,
                                'improver' => 0,
                                'drop_in_class' => 0,
                                'blinkers' => 0,
                                'big_trainer' => 0,
                                'trainer_inform' => 0,
                                'course_trainer' => 1,
                                'trainer_fur_trv' => 0,
                                'big_jockey' => 0,
                                'jockey_inform' => 0,
                                'course_jockey' => 0,
                                'one_tr_jockey' => 0,
                                'suit_going' => 1,
                                'suit_course' => 0,
                                'suit_dist' => 0,
                                'spotlight' => 0,
                                'postdata' => 0,
                                'lambourn' => 0,
                                'north' => 0,
                                'daily_tel' => 0,
                                'times' => 0,
                                'telegraph' => 0,
                                'guardian' => 0,
                                'daily_mail' => 0,
                                'daily_exp' => 0,
                                'daily_mir' => 0,
                                'sun' => 0,
                                'star' => 0,
                                'daily_rec' => 0,
                                'nap' => 0,
                                'fc_odds_uid' => 27,
                                'fc_odds_value' => 4.5,
                                'fc_odds' => '9/2',
                                'fc_fav' => 0,
                                'fc_long_shot' => 0,
                                'course_style_name' => 'Taunton',
                                'hcap' => 0,
                                'tricast' => 0,
                                'ruk' => 0,
                                'atr' => 0,
                                'saddle_no' => 6,
                                'weight_allow' => 5,
                                'rp_owner_choice1' => 'a',
                                'sire_uid' => 642105,
                                'sire_name' => 'Sixties Icon',
                                'version' => '000000000002935d',
                                'deleted' => 0,
                            )
                        ),
                        2 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'weight_allowance_lbs' => 0,
                                'rp_owner_choice' => 'a',
                                'sire_horse_name' => 'Septieme Ciel',
                                'max_version' => '00000000000294e1',
                                'uid' => 21803,
                                'race_uid' => 646082,
                                'race_datetime' => 'Apr  7 2016  2:40PM',
                                'race_jump' => 1,
                                'race_8runners' => 1,
                                'race_run_nos' => 12,
                                'race_type' => 'H',
                                'race_going' => 'G ',
                                'owner_uid' => 144489,
                                'owner_choice' => 'a',
                                'ctry_code' => 'GB',
                                'course_uid' => 73,
                                'course_name' => 'TAUNTON',
                                'horse_uid' => 901454,
                                'horse_name' => 'Galice Du Ciel',
                                'horse_name_lc' => 'galiceduciel',
                                'trainer_uid' => 10792,
                                'trainer_name' => 'Giles Smyly',
                                'trainer_name_lc' => 'gilessmyly',
                                'jockey_uid' => 87503,
                                'jockey_name' => 'Tom Cannon',
                                'jockey_name_lc' => 'tomcannon',
                                'winner' => 0,
                                'placed' => 0,
                                'bfv' => 0,
                                'postmark' => 0,
                                'topspeed' => 0,
                                'silk_red' => 1,
                                'silk_orange' => 0,
                                'silk_yellow' => 0,
                                'silk_green' => 0,
                                'silk_blue' => 0,
                                'silk_purple' => 1,
                                'silk_pink' => 0,
                                'silk_black' => 0,
                                'silk_white' => 0,
                                'silk_brown' => 0,
                                'improver' => 0,
                                'drop_in_class' => 0,
                                'blinkers' => 0,
                                'big_trainer' => 0,
                                'trainer_inform' => 0,
                                'course_trainer' => 0,
                                'trainer_fur_trv' => 0,
                                'big_jockey' => 0,
                                'jockey_inform' => 0,
                                'course_jockey' => 0,
                                'one_tr_jockey' => 0,
                                'suit_going' => 0,
                                'suit_course' => 0,
                                'suit_dist' => 0,
                                'spotlight' => 0,
                                'postdata' => 0,
                                'lambourn' => 0,
                                'north' => 0,
                                'daily_tel' => 0,
                                'times' => 0,
                                'telegraph' => 0,
                                'guardian' => 0,
                                'daily_mail' => 0,
                                'daily_exp' => 0,
                                'daily_mir' => 0,
                                'sun' => 0,
                                'star' => 0,
                                'daily_rec' => 0,
                                'nap' => 0,
                                'fc_odds_uid' => 92,
                                'fc_odds_value' => 200,
                                'fc_odds' => '200/1',
                                'fc_fav' => 0,
                                'fc_long_shot' => 1,
                                'course_style_name' => 'Taunton',
                                'hcap' => 0,
                                'tricast' => 0,
                                'ruk' => 0,
                                'atr' => 0,
                                'saddle_no' => 4,
                                'weight_allow' => 0,
                                'rp_owner_choice1' => 'a',
                                'sire_uid' => 49099,
                                'sire_name' => 'Septieme Ciel',
                                'version' => '000000000002935e',
                                'deleted' => 0,
                            )
                        ),
                    ),
                    'version' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'weight_allowance_lbs' => 0,
                            'rp_owner_choice' => 'a',
                            'sire_horse_name' => 'Needle Gun',
                            'max_version' => '00000000000294e1',
                            'uid' => 21801,
                            'race_uid' => 646082,
                            'race_datetime' => 'Apr  7 2016  2:40PM',
                            'race_jump' => 1,
                            'race_8runners' => 1,
                            'race_run_nos' => 12,
                            'race_type' => 'H',
                            'race_going' => 'G ',
                            'owner_uid' => 24748,
                            'owner_choice' => 'a',
                            'ctry_code' => 'GB',
                            'course_uid' => 73,
                            'course_name' => 'TAUNTON',
                            'horse_uid' => 974094,
                            'horse_name' => 'Sticking Point',
                            'horse_name_lc' => 'stickingpoint',
                            'trainer_uid' => 15642,
                            'trainer_name' => 'Martin Keighley',
                            'trainer_name_lc' => 'martinkeighley',
                            'jockey_uid' => 80153,
                            'jockey_name' => 'Andrew Tinkler',
                            'jockey_name_lc' => 'andrewtinkler',
                            'winner' => 0,
                            'placed' => 0,
                            'bfv' => 0,
                            'postmark' => 0,
                            'topspeed' => 0,
                            'silk_red' => 1,
                            'silk_orange' => 0,
                            'silk_yellow' => 0,
                            'silk_green' => 0,
                            'silk_blue' => 0,
                            'silk_purple' => 0,
                            'silk_pink' => 0,
                            'silk_black' => 0,
                            'silk_white' => 0,
                            'silk_brown' => 0,
                            'improver' => 0,
                            'drop_in_class' => 0,
                            'blinkers' => 0,
                            'big_trainer' => 0,
                            'trainer_inform' => 0,
                            'course_trainer' => 0,
                            'trainer_fur_trv' => 0,
                            'big_jockey' => 0,
                            'jockey_inform' => 0,
                            'course_jockey' => 0,
                            'one_tr_jockey' => 0,
                            'suit_going' => 0,
                            'suit_course' => 0,
                            'suit_dist' => 0,
                            'spotlight' => 0,
                            'postdata' => 0,
                            'lambourn' => 0,
                            'north' => 0,
                            'daily_tel' => 0,
                            'times' => 0,
                            'telegraph' => 0,
                            'guardian' => 0,
                            'daily_mail' => 0,
                            'daily_exp' => 0,
                            'daily_mir' => 0,
                            'sun' => 0,
                            'star' => 0,
                            'daily_rec' => 0,
                            'nap' => 0,
                            'fc_odds_uid' => 53,
                            'fc_odds_value' => 66,
                            'fc_odds' => '66/1',
                            'fc_fav' => 0,
                            'fc_long_shot' => 1,
                            'course_style_name' => 'Taunton',
                            'hcap' => 0,
                            'tricast' => 0,
                            'ruk' => 0,
                            'atr' => 0,
                            'saddle_no' => 9,
                            'weight_allow' => 0,
                            'rp_owner_choice1' => 'a',
                            'sire_uid' => 77833,
                            'sire_name' => 'Needle Gun',
                            'version' => '000000000002935c',
                            'deleted' => 0,
                        )
                    ),
                )
            ]
        ];
    }


    /**
     * @param \Api\Input\Request\Horses\BetFinder\Diff $request
     * @param array                                    $expectedResult
     *
     * @dataProvider providerTestGetBetFinderDiffData
     */
    public function testGetBetFinderDiffData(
        \Api\Input\Request\Horses\BetFinder\Diff $request,
        array $expectedResult
    ) {
        $courseProfileObject = new \Tests\Stubs\Bo\BetFinder($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($courseProfileObject->getBetFinderDiffData())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetBetFinderDiffData()
    {
        return [
            [
                new \Api\Input\Request\Horses\BetFinder\Diff(['0x00000000000142e2']),
                array(
                    'bets' => array(
                        0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'weight_allowance_lbs' => 5,
                                'rp_owner_choice' => 'a',
                                'sire_horse_name' => 'Fusaichi Pegasus',
                                'max_version' => '000000000002950d',
                                'uid' => 18336,
                                'race_uid' => 645469,
                                'race_datetime' => 'Mar 31 2016  2:00PM',
                                'race_jump' => 0,
                                'race_8runners' => 1,
                                'race_run_nos' => 11,
                                'race_type' => 'X',
                                'race_going' => 'SD',
                                'owner_uid' => 163207,
                                'owner_choice' => 'a',
                                'ctry_code' => 'GB',
                                'course_uid' => 513,
                                'course_name' => 'WOLVERHAMPTON (A.W)',
                                'horse_uid' => 434447,
                                'horse_name' => 'Seraphima',
                                'horse_name_lc' => 'seraphima',
                                'trainer_uid' => 9170,
                                'trainer_name' => 'Lisa Williamson',
                                'trainer_name_lc' => 'lisawilliamson',
                                'jockey_uid' => 92801,
                                'jockey_name' => 'Josephine Gordon',
                                'jockey_name_lc' => 'josephinegordon',
                                'winner' => 0,
                                'placed' => 0,
                                'bfv' => 0,
                                'postmark' => 0,
                                'topspeed' => 0,
                                'silk_red' => 0,
                                'silk_orange' => 0,
                                'silk_yellow' => 1,
                                'silk_green' => 0,
                                'silk_blue' => 0,
                                'silk_purple' => 0,
                                'silk_pink' => 0,
                                'silk_black' => 0,
                                'silk_white' => 0,
                                'silk_brown' => 0,
                                'improver' => 0,
                                'drop_in_class' => 0,
                                'blinkers' => 0,
                                'big_trainer' => 0,
                                'trainer_inform' => 0,
                                'course_trainer' => 0,
                                'trainer_fur_trv' => 0,
                                'big_jockey' => 0,
                                'jockey_inform' => 0,
                                'course_jockey' => 0,
                                'one_tr_jockey' => 0,
                                'suit_going' => 1,
                                'suit_course' => 1,
                                'suit_dist' => 0,
                                'spotlight' => 0,
                                'postdata' => 0,
                                'lambourn' => 0,
                                'north' => 0,
                                'daily_tel' => 0,
                                'times' => 0,
                                'telegraph' => 0,
                                'guardian' => 0,
                                'daily_mail' => 0,
                                'daily_exp' => 0,
                                'daily_mir' => 0,
                                'sun' => 0,
                                'star' => 1,
                                'daily_rec' => 0,
                                'nap' => 0,
                                'fc_odds_uid' => 10,
                                'fc_odds_value' => 12,
                                'fc_odds' => '12/1',
                                'fc_fav' => 0,
                                'fc_long_shot' => 0,
                                'course_style_name' => 'Wolverhampton (A.W)',
                                'hcap' => 1,
                                'tricast' => 1,
                                'ruk' => 0,
                                'atr' => 0,
                                'saddle_no' => 8,
                                'weight_allow' => 5,
                                'rp_owner_choice1' => 'a',
                                'sire_uid' => 528538,
                                'sire_name' => 'Fusaichi Pegasus',
                                'version' => '0000000000027e64',
                                'deleted' => 1,
                            )
                        ),
                    ),
                    'version' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'weight_allowance_lbs' => 5,
                            'rp_owner_choice' => 'a',
                            'sire_horse_name' => 'Fusaichi Pegasus',
                            'max_version' => '000000000002950d',
                            'uid' => 18336,
                            'race_uid' => 645469,
                            'race_datetime' => 'Mar 31 2016  2:00PM',
                            'race_jump' => 0,
                            'race_8runners' => 1,
                            'race_run_nos' => 11,
                            'race_type' => 'X',
                            'race_going' => 'SD',
                            'owner_uid' => 163207,
                            'owner_choice' => 'a',
                            'ctry_code' => 'GB',
                            'course_uid' => 513,
                            'course_name' => 'WOLVERHAMPTON (A.W)',
                            'horse_uid' => 434447,
                            'horse_name' => 'Seraphima',
                            'horse_name_lc' => 'seraphima',
                            'trainer_uid' => 9170,
                            'trainer_name' => 'Lisa Williamson',
                            'trainer_name_lc' => 'lisawilliamson',
                            'jockey_uid' => 92801,
                            'jockey_name' => 'Josephine Gordon',
                            'jockey_name_lc' => 'josephinegordon',
                            'winner' => 0,
                            'placed' => 0,
                            'bfv' => 0,
                            'postmark' => 0,
                            'topspeed' => 0,
                            'silk_red' => 0,
                            'silk_orange' => 0,
                            'silk_yellow' => 1,
                            'silk_green' => 0,
                            'silk_blue' => 0,
                            'silk_purple' => 0,
                            'silk_pink' => 0,
                            'silk_black' => 0,
                            'silk_white' => 0,
                            'silk_brown' => 0,
                            'improver' => 0,
                            'drop_in_class' => 0,
                            'blinkers' => 0,
                            'big_trainer' => 0,
                            'trainer_inform' => 0,
                            'course_trainer' => 0,
                            'trainer_fur_trv' => 0,
                            'big_jockey' => 0,
                            'jockey_inform' => 0,
                            'course_jockey' => 0,
                            'one_tr_jockey' => 0,
                            'suit_going' => 1,
                            'suit_course' => 1,
                            'suit_dist' => 0,
                            'spotlight' => 0,
                            'postdata' => 0,
                            'lambourn' => 0,
                            'north' => 0,
                            'daily_tel' => 0,
                            'times' => 0,
                            'telegraph' => 0,
                            'guardian' => 0,
                            'daily_mail' => 0,
                            'daily_exp' => 0,
                            'daily_mir' => 0,
                            'sun' => 0,
                            'star' => 1,
                            'daily_rec' => 0,
                            'nap' => 0,
                            'fc_odds_uid' => 10,
                            'fc_odds_value' => 12,
                            'fc_odds' => '12/1',
                            'fc_fav' => 0,
                            'fc_long_shot' => 0,
                            'course_style_name' => 'Wolverhampton (A.W)',
                            'hcap' => 1,
                            'tricast' => 1,
                            'ruk' => 0,
                            'atr' => 0,
                            'saddle_no' => 8,
                            'weight_allow' => 5,
                            'rp_owner_choice1' => 'a',
                            'sire_uid' => 528538,
                            'sire_name' => 'Fusaichi Pegasus',
                            'version' => '0000000000027e64',
                            'deleted' => 1,
                        )
                    ),
                )
            ]
        ];
    }
}
