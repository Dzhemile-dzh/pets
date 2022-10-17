<?php
/**
 * Created by PhpStorm.
 * User: Ievgen_Rebrakov
 * Date: 25.09.2014
 * Time: 14:55
 */

namespace Tests;

class DrawAnalyserTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @test
     * @expectedException \Exception
     */
    public function incorrectInitObject()
    {

        new Stubs\Bo\DrawAnalyser('asd');
    }

    /**
     * @test
     * @dataProvider providerRaces
     */
    public function getRace($raceId, $expectedResult)
    {
        $da = new Stubs\Bo\DrawAnalyser($raceId);

        $race = $da->getRace();
        $this->assertTrue(is_object($race));
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($race)
        );

        //check if result for method getRace is cached if DrawAnalyser object property. If it is cache code coverage is 100%.
        $race = $da->getRace();
        $this->assertTrue(is_object($race));
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($race)
        );
    }

    /**
     * @test
     * @dataProvider providerRunners
     */
    public function getRunners($raceId, $expectedResult)
    {
        $da = new Stubs\Bo\DrawAnalyser($raceId);

        $runners = $da->getRunners();
        $this->assertTrue(is_array($runners));
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($runners)
        );

        //check if result for method getRunners is cached if DrawAnalyser object property.  If it is cache code coverage is 100%.
        $runners = $da->getRunners();
        $this->assertTrue(is_array($runners));
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($runners)
        );
    }

    /**
     * dataProvider for getRace
     *
     * @return array
     */
    public function providerRaces()
    {
        return [
            [
                599203,
                array(
                    'race_instance_uid' => 599203,
                    'race_instance_title' => 'Irish Stallion Farms European Breeders Fund Maiden',
                    'race_datetime' => 'Apr  6 2014  1:55PM',
                    'distance_yard' => 1100,
                    'no_of_runners' => 8,
                    'course_uid' => 596,
                    'course_name' => 'SOME COURSE',
                    'going_type_code' => 'HY',
                    'going_type_desc' => 'Heavy',
                    'significance_text_summary' => 'STRONG LOW',
                    'min_rounded_length' => -2.1000000000000001,
                    'max_rounded_length' => 2.1000000000000001,
                    'min_rounded_lbs' => -4.8300000000000001,
                    'max_rounded_lbs' => 4.8300000000000001,
                    'min_rounded_going' => -3.4860000000000002,
                    'max_rounded_going' => 3.4860000000000002,
                )
            ],
            [
                599206,
                array(
                    'race_instance_uid' => 599206,
                    'race_instance_title' => 'Mallow Handicap',
                    'race_datetime' => 'Apr  6 2014  3:30PM',
                    'distance_yard' => 1540,
                    'no_of_runners' => 8,
                    'course_uid' => 596,
                    'course_name' => 'SOME COURSE',
                    'going_type_code' => 'HY',
                    'going_type_desc' => 'Heavy',
                    'significance_text_summary' => 'STRONG LOW',
                    'min_rounded_length' => -2.3999999999999999,
                    'max_rounded_length' => 2.3999999999999999,
                    'min_rounded_lbs' => -5.5199999999999996,
                    'max_rounded_lbs' => 5.5199999999999996,
                    'min_rounded_going' => -3.984,
                    'max_rounded_going' => 3.984,
                )
            ],
            [
                599210,
                array(
                    'race_instance_uid' => 599210,
                    'race_instance_title' => 'Blackwater Fillies Maiden',
                    'race_datetime' => 'Apr  6 2014  5:40PM',
                    'distance_yard' => 2250,
                    'no_of_runners' => 8,
                    'course_uid' => 596,
                    'course_name' => 'SOME COURSE',
                    'going_type_code' => 'HY',
                    'going_type_desc' => 'Heavy',
                    'significance_text_summary' => 'STRONG LOW',
                    'min_rounded_length' => -1.5,
                    'max_rounded_length' => 1.5,
                    'min_rounded_lbs' => -3.4500000000000002,
                    'max_rounded_lbs' => 3.4500000000000002,
                    'min_rounded_going' => -2.4900000000000002,
                    'max_rounded_going' => 2.4900000000000002,
                )
            ]
        ];
    }

    /**
     * dataProvider for getRunners
     *
     * @return array
     */
    public function providerRunners()
    {
        return [
            [
                599203,
                array(
                    array(
                        'horse_uid' => 857784,
                        'horse_name' => 'Stormfly',
                        'sequence' => 1,
                        'draw' => 1,
                        'y_norm_length' => 2.1000000000000001,
                        'y_norm_pound' => 4.8300000000000001,
                        'y_norm_going' => 3.4860000000000002,
                    ),
                    array(
                        'horse_uid' => 857781,
                        'horse_name' => 'Double Windsor',
                        'sequence' => 2,
                        'draw' => 2,
                        'y_norm_length' => 1.5,
                        'y_norm_pound' => 3.4500000000000002,
                        'y_norm_going' => 2.4900000000000002,
                    ),
                    array(
                        'horse_uid' => 857783,
                        'horse_name' => 'Sors',
                        'sequence' => 3,
                        'draw' => 3,
                        'y_norm_length' => 0.90000000000000002,
                        'y_norm_pound' => 2.0699999999999998,
                        'y_norm_going' => 1.494,
                    ),
                    array(
                        'horse_uid' => 856813,
                        'horse_name' => 'Alainn',
                        'sequence' => 4,
                        'draw' => 4,
                        'y_norm_length' => 0.29999999999999999,
                        'y_norm_pound' => 0.68999999999999995,
                        'y_norm_going' => 0.498,
                    ),
                    array(
                        'horse_uid' => 857780,
                        'horse_name' => 'Alp D\'Huez',
                        'sequence' => 5,
                        'draw' => 5,
                        'y_norm_length' => -0.29999999999999999,
                        'y_norm_pound' => -0.68999999999999995,
                        'y_norm_going' => -0.498,
                    ),
                    array(
                        'horse_uid' => 857702,
                        'horse_name' => 'Ellenvelyn',
                        'sequence' => 6,
                        'draw' => 6,
                        'y_norm_length' => -0.90000000000000002,
                        'y_norm_pound' => -2.0699999999999998,
                        'y_norm_going' => -1.494,
                    ),
                    array(
                        'horse_uid' => 857782,
                        'horse_name' => 'Lastdanceforme',
                        'sequence' => 7,
                        'draw' => 7,
                        'y_norm_length' => -1.5,
                        'y_norm_pound' => -3.4500000000000002,
                        'y_norm_going' => -2.4900000000000002,
                    ),
                    array(
                        'horse_uid' => 856816,
                        'horse_name' => 'Bwana',
                        'sequence' => 8,
                        'draw' => 8,
                        'y_norm_length' => -2.1000000000000001,
                        'y_norm_pound' => -4.8300000000000001,
                        'y_norm_going' => -3.4860000000000002,
                    ),
                )
            ],
            [
                599206,
                array(
                    array(
                        'horse_uid' => 680107,
                        'horse_name' => 'Beacon Lodge',
                        'sequence' => 1,
                        'draw' => 1,
                        'y_norm_length' => 2.3999999999999999,
                        'y_norm_pound' => 5.5199999999999996,
                        'y_norm_going' => 3.984,
                    ),
                    array(
                        'horse_uid' => 832972,
                        'horse_name' => 'Sun On The Run',
                        'sequence' => 2,
                        'draw' => 2,
                        'y_norm_length' => 1.8,
                        'y_norm_pound' => 4.1399999999999997,
                        'y_norm_going' => 2.988,
                    ),
                    array(
                        'horse_uid' => 787316,
                        'horse_name' => 'Srucahan',
                        'sequence' => 3,
                        'draw' => 3,
                        'y_norm_length' => 1.2,
                        'y_norm_pound' => 2.7599999999999998,
                        'y_norm_going' => 1.992,
                    ),
                    array(
                        'horse_uid' => 637281,
                        'horse_name' => 'Maundy Money',
                        'sequence' => 4,
                        'draw' => 4,
                        'y_norm_length' => 0.59999999999999998,
                        'y_norm_pound' => 1.3799999999999999,
                        'y_norm_going' => 0.996,
                    ),
                    array(
                        'horse_uid' => 785217,
                        'horse_name' => 'Caprella',
                        'sequence' => 5,
                        'draw' => 5,
                        'y_norm_length' => 0,
                        'y_norm_pound' => 0,
                        'y_norm_going' => 0,
                    ),
                    array(
                        'horse_uid' => 765704,
                        'horse_name' => 'Cash Or Casualty',
                        'sequence' => 6,
                        'draw' => 6,
                        'y_norm_length' => -0.59999999999999998,
                        'y_norm_pound' => -1.3799999999999999,
                        'y_norm_going' => -0.996,
                    ),
                    array(
                        'horse_uid' => 806737,
                        'horse_name' => 'Canary Row',
                        'sequence' => 7,
                        'draw' => 7,
                        'y_norm_length' => -1.2,
                        'y_norm_pound' => -2.7599999999999998,
                        'y_norm_going' => -1.992,
                    ),
                    array(
                        'horse_uid' => 812052,
                        'horse_name' => 'Ballyorban',
                        'sequence' => 8,
                        'draw' => 8,
                        'y_norm_length' => -1.8,
                        'y_norm_pound' => -4.1399999999999997,
                        'y_norm_going' => -2.988,
                    ),
                    array(
                        'horse_uid' => 753712,
                        'horse_name' => 'Flic Flac',
                        'sequence' => 9,
                        'draw' => 9,
                        'y_norm_length' => -2.3999999999999999,
                        'y_norm_pound' => -5.5199999999999996,
                        'y_norm_going' => -3.984,
                    ),
                )
            ],
            [
                599210,
                array(
                    array(
                        'horse_uid' => 857790,
                        'horse_name' => 'Golden Sky',
                        'sequence' => 1,
                        'draw' => 1,
                        'y_norm_length' => 1.5,
                        'y_norm_pound' => 3.4500000000000002,
                        'y_norm_going' => 2.4900000000000002,
                    ),
                    array(
                        'horse_uid' => 849164,
                        'horse_name' => 'Ebeyina',
                        'sequence' => 2,
                        'draw' => 2,
                        'y_norm_length' => 0.90000000000000002,
                        'y_norm_pound' => 2.0699999999999998,
                        'y_norm_going' => 1.494,
                    ),
                    array(
                        'horse_uid' => 842615,
                        'horse_name' => 'Lovely Dancer',
                        'sequence' => 3,
                        'draw' => 3,
                        'y_norm_length' => 0.29999999999999999,
                        'y_norm_pound' => 0.68999999999999995,
                        'y_norm_going' => 0.498,
                    ),
                    array(
                        'horse_uid' => 838242,
                        'horse_name' => 'Committal',
                        'sequence' => 4,
                        'draw' => 4,
                        'y_norm_length' => -0.29999999999999999,
                        'y_norm_pound' => -0.68999999999999995,
                        'y_norm_going' => -0.498,
                    ),
                    array(
                        'horse_uid' => 840664,
                        'horse_name' => 'Upper Silesian',
                        'sequence' => 5,
                        'draw' => 5,
                        'y_norm_length' => -0.90000000000000002,
                        'y_norm_pound' => -2.0699999999999998,
                        'y_norm_going' => -1.494,
                    ),
                    array(
                        'horse_uid' => 856827,
                        'horse_name' => 'Magic Magnolia',
                        'sequence' => 6,
                        'draw' => 6,
                        'y_norm_length' => -1.5,
                        'y_norm_pound' => -3.4500000000000002,
                        'y_norm_going' => -2.4900000000000002,
                    ),
                )
            ]
        ];
    }
}
