<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\RaceCards\Trainerspot\RaceTrace\General;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

class Test extends ApiRouteTestPrototype
{

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/racecards/trainerspot/race-trace';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\RaceCards\Trainerspot\RaceTrace:187 ->populatePrevRacesTmpTable()
            '9ef5d25162096bd009cc0c18b0777b9b' => [
            ],
            //Api\DataProvider\Bo\RaceCards\Trainerspot\RaceTrace:156 ->getTodayRaces()
            '56d3cadfab679d9753fce738d6c4028e' => [
                [
                    'race_instance_uid' => 701465,
                ],
                [
                    'race_instance_uid' => 701343,
                ],
                [
                    'race_instance_uid' => 701462,
                ],
                [
                    'race_instance_uid' => 703523,
                ],
                [
                    'race_instance_uid' => 701346,
                ],
                [
                    'race_instance_uid' => 703550,
                ],
                [
                    'race_instance_uid' => 701464,
                ],
                [
                    'race_instance_uid' => 703522,
                ],
                [
                    'race_instance_uid' => 701345,
                ],
                [
                    'race_instance_uid' => 703549,
                ],
                [
                    'race_instance_uid' => 701463,
                ],
                [
                    'race_instance_uid' => 703521,
                ],
                [
                    'race_instance_uid' => 701342,
                ],
                [
                    'race_instance_uid' => 703548,
                ],
                [
                    'race_instance_uid' => 701460,
                ],
                [
                    'race_instance_uid' => 703520,
                ],
                [
                    'race_instance_uid' => 701344,
                ],
                [
                    'race_instance_uid' => 703547,
                ],
                [
                    'race_instance_uid' => 701461,
                ],
                [
                    'race_instance_uid' => 703519,
                ],
                [
                    'race_instance_uid' => 701341,
                ],
                [
                    'race_instance_uid' => 703663,
                ],
                [
                    'race_instance_uid' => 701466,
                ],
                [
                    'race_instance_uid' => 703518,
                ],
                [
                    'race_instance_uid' => 701347,
                ],
                [
                    'race_instance_uid' => 703546,
                ],
                [
                    'race_instance_uid' => 701339,
                ],
                [
                    'race_instance_uid' => 703517,
                ],
                [
                    'race_instance_uid' => 703545,
                ],
                [
                    'race_instance_uid' => 701454,
                ],
                [
                    'race_instance_uid' => 703647,
                ],
                [
                    'race_instance_uid' => 701324,
                ],
                [
                    'race_instance_uid' => 703544,
                ],
                [
                    'race_instance_uid' => 701459,
                ],
                [
                    'race_instance_uid' => 701337,
                ],
                [
                    'race_instance_uid' => 701325,
                ],
                [
                    'race_instance_uid' => 701453,
                ],
                [
                    'race_instance_uid' => 701334,
                ],
                [
                    'race_instance_uid' => 701322,
                ],
                [
                    'race_instance_uid' => 703646,
                ],
                [
                    'race_instance_uid' => 701336,
                ],
                [
                    'race_instance_uid' => 701320,
                ],
                [
                    'race_instance_uid' => 701455,
                ],
                [
                    'race_instance_uid' => 701335,
                ],
                [
                    'race_instance_uid' => 701326,
                ],
                [
                    'race_instance_uid' => 701457,
                ],
                [
                    'race_instance_uid' => 701340,
                ],
                [
                    'race_instance_uid' => 701321,
                ],
                [
                    'race_instance_uid' => 701458,
                ],
                [
                    'race_instance_uid' => 701338,
                ],
                [
                    'race_instance_uid' => 701323,
                ],
                [
                    'race_instance_uid' => 701456,
                ],
            ],
            //Api\DataProvider\Bo\RaceCards\Trainerspot\RaceTrace:199 ->populatePrevRacesTmpTable()
            '946f9bad7f576bb810977e008a704e0d' => [
            ],
            //Api\DataProvider\Bo\RaceCards\Trainerspot\RaceTrace:302 ->getCourseTrainerRaces()
            '689879a03b1a5d3b758e231689013e90' => [
            ],
            //Api\DataProvider\Bo\RaceCards\Trainerspot\RaceTrace:303 ->getCourseTrainerRaces()
            'eef943ba1cb6cce7c8c9a718375d20ee' => [
                [
                    'trainer_name' => 'Gordon Elliott',
                    'trainer_uid' => 18145,
                    'course_uid' => 175,
                    'course_name' => 'Ballinrobe',
                    'race_datetime' => '2018-05-29 19:30:00',
                    'race_instance_uid' => 703521,
                    'race_type_code' => 'C',
                    'past_season_start_date' => '2008-04-27 00:00:00',
                    'horse_uid' => 980309,
                    'horse_name' => 'Midnight Escape',
                ],
                [
                    'trainer_name' => 'D K Weld',
                    'trainer_uid' => 1010,
                    'course_uid' => 184,
                    'course_name' => 'Gowran Park',
                    'race_datetime' => '2018-05-29 18:45:00',
                    'race_instance_uid' => 703547,
                    'race_type_code' => 'F',
                    'past_season_start_date' => '2008-01-01 00:00:00',
                    'horse_uid' => 1552022,
                    'horse_name' => 'Bella Estrella',
                ],
                [
                    'trainer_name' => 'Gordon Elliott',
                    'trainer_uid' => 18145,
                    'course_uid' => 175,
                    'course_name' => 'Ballinrobe',
                    'race_datetime' => '2018-05-29 18:00:00',
                    'race_instance_uid' => 703518,
                    'race_type_code' => 'H',
                    'past_season_start_date' => '2008-04-27 00:00:00',
                    'horse_uid' => 1506936,
                    'horse_name' => 'Anytime Now',
                ],
                [
                    'trainer_name' => 'Tim Easterby',
                    'trainer_uid' => 10152,
                    'course_uid' => 47,
                    'course_name' => 'Redcar',
                    'race_datetime' => '2018-05-29 14:30:00',
                    'race_instance_uid' => 701340,
                    'race_type_code' => 'F',
                    'past_season_start_date' => '2008-01-01 00:00:00',
                    'horse_uid' => 1467622,
                    'horse_name' => 'Lever Du Soleil',
                ],
                [
                    'trainer_name' => 'Tim Easterby',
                    'trainer_uid' => 10152,
                    'course_uid' => 47,
                    'course_name' => 'Redcar',
                    'race_datetime' => '2018-05-29 14:30:00',
                    'race_instance_uid' => 701340,
                    'race_type_code' => 'F',
                    'past_season_start_date' => '2008-01-01 00:00:00',
                    'horse_uid' => 1518943,
                    'horse_name' => 'Surrender',
                ],
                [
                    'trainer_name' => 'Richard Hannon',
                    'trainer_uid' => 28787,
                    'course_uid' => 393,
                    'course_name' => 'Lingfield (A.W)',
                    'race_datetime' => '2018-05-29 14:10:00',
                    'race_instance_uid' => 701458,
                    'race_type_code' => 'X',
                    'past_season_start_date' => '2008-01-01 00:00:00',
                    'horse_uid' => 1994522,
                    'horse_name' => 'My Babydoll',
                ],
            ],
            //Api\DataProvider\Bo\RaceCards\Trainerspot\RaceTrace:365 ->getTrainerStats()
            'dfbfb2dbab91c0e63a04ea9c6a698592' => [
                [
                    'trainer_uid' => 1010,
                    'race_instance_uid' => 703547,
                    'wins' => 3,
                    'runs' => 10,
                    'stake' => -1.5,
                ],
                [
                    'trainer_uid' => 10152,
                    'race_instance_uid' => 701340,
                    'wins' => 2,
                    'runs' => 14,
                    'stake' => 9.0,
                ],
                [
                    'trainer_uid' => 18145,
                    'race_instance_uid' => 703518,
                    'wins' => 2,
                    'runs' => 4,
                    'stake' => 11.5,
                ],
                [
                    'trainer_uid' => 18145,
                    'race_instance_uid' => 703521,
                    'wins' => 2,
                    'runs' => 7,
                    'stake' => 1.5,
                ],
                [
                    'trainer_uid' => 28787,
                    'race_instance_uid' => 701458,
                    'wins' => 2,
                    'runs' => 2,
                    'stake' => 5.0,
                ],
            ],
            //Api\DataProvider\Bo\RaceCards\Trainerspot\RaceTrace:428 ->getTrainerPastPerformance()
            '56919a168d48b1c1906bb6519fea9e57' => [
                [
                    'trainer_uid' => 1010,
                    'race_instance_uid' => 703547,
                    'race_year' => 2009,
                    'horse_uid' => 683093,
                    'race_position' => '2',
                ],
                [
                    'trainer_uid' => 1010,
                    'race_instance_uid' => 703547,
                    'race_year' => 2010,
                    'horse_uid' => 683093,
                    'race_position' => '1',
                ],
                [
                    'trainer_uid' => 1010,
                    'race_instance_uid' => 703547,
                    'race_year' => 2011,
                    'horse_uid' => 760585,
                    'race_position' => '5',
                ],
                [
                    'trainer_uid' => 1010,
                    'race_instance_uid' => 703547,
                    'race_year' => 2012,
                    'horse_uid' => 762443,
                    'race_position' => '7',
                ],
                [
                    'trainer_uid' => 1010,
                    'race_instance_uid' => 703547,
                    'race_year' => 2012,
                    'horse_uid' => 760516,
                    'race_position' => '4',
                ],
                [
                    'trainer_uid' => 1010,
                    'race_instance_uid' => 703547,
                    'race_year' => 2013,
                    'horse_uid' => 810335,
                    'race_position' => '1',
                ],
                [
                    'trainer_uid' => 1010,
                    'race_instance_uid' => 703547,
                    'race_year' => 2014,
                    'horse_uid' => 844213,
                    'race_position' => '1',
                ],
                [
                    'trainer_uid' => 1010,
                    'race_instance_uid' => 703547,
                    'race_year' => 2015,
                    'horse_uid' => 838527,
                    'race_position' => '4',
                ],
                [
                    'trainer_uid' => 1010,
                    'race_instance_uid' => 703547,
                    'race_year' => 2016,
                    'horse_uid' => 987813,
                    'race_position' => '2',
                ],
                [
                    'trainer_uid' => 1010,
                    'race_instance_uid' => 703547,
                    'race_year' => 2017,
                    'horse_uid' => 895103,
                    'race_position' => '2',
                ],
                [
                    'trainer_uid' => 10152,
                    'race_instance_uid' => 701340,
                    'race_year' => 2010,
                    'horse_uid' => 736783,
                    'race_position' => '0',
                ],
                [
                    'trainer_uid' => 10152,
                    'race_instance_uid' => 701340,
                    'race_year' => 2010,
                    'horse_uid' => 737199,
                    'race_position' => '2',
                ],
                [
                    'trainer_uid' => 10152,
                    'race_instance_uid' => 701340,
                    'race_year' => 2011,
                    'horse_uid' => 757075,
                    'race_position' => '9',
                ],
                [
                    'trainer_uid' => 10152,
                    'race_instance_uid' => 701340,
                    'race_year' => 2011,
                    'horse_uid' => 765310,
                    'race_position' => '1',
                ],
                [
                    'trainer_uid' => 10152,
                    'race_instance_uid' => 701340,
                    'race_year' => 2012,
                    'horse_uid' => 808037,
                    'race_position' => '0',
                ],
                [
                    'trainer_uid' => 10152,
                    'race_instance_uid' => 701340,
                    'race_year' => 2012,
                    'horse_uid' => 787840,
                    'race_position' => '6',
                ],
                [
                    'trainer_uid' => 10152,
                    'race_instance_uid' => 701340,
                    'race_year' => 2013,
                    'horse_uid' => 817412,
                    'race_position' => '9',
                ],
                [
                    'trainer_uid' => 10152,
                    'race_instance_uid' => 701340,
                    'race_year' => 2013,
                    'horse_uid' => 816198,
                    'race_position' => '8',
                ],
                [
                    'trainer_uid' => 10152,
                    'race_instance_uid' => 701340,
                    'race_year' => 2014,
                    'horse_uid' => 838409,
                    'race_position' => '1',
                ],
                [
                    'trainer_uid' => 10152,
                    'race_instance_uid' => 701340,
                    'race_year' => 2014,
                    'horse_uid' => 841392,
                    'race_position' => '2',
                ],
                [
                    'trainer_uid' => 10152,
                    'race_instance_uid' => 701340,
                    'race_year' => 2014,
                    'horse_uid' => 857073,
                    'race_position' => '4',
                ],
                [
                    'trainer_uid' => 10152,
                    'race_instance_uid' => 701340,
                    'race_year' => 2015,
                    'horse_uid' => 865380,
                    'race_position' => 'U',
                ],
                [
                    'trainer_uid' => 10152,
                    'race_instance_uid' => 701340,
                    'race_year' => 2017,
                    'horse_uid' => 1131270,
                    'race_position' => '0',
                ],
                [
                    'trainer_uid' => 10152,
                    'race_instance_uid' => 701340,
                    'race_year' => 2017,
                    'horse_uid' => 1050864,
                    'race_position' => '2',
                ],
                [
                    'trainer_uid' => 18145,
                    'race_instance_uid' => 703518,
                    'race_year' => 2012,
                    'horse_uid' => 764980,
                    'race_position' => '0',
                ],
                [
                    'trainer_uid' => 18145,
                    'race_instance_uid' => 703518,
                    'race_year' => 2013,
                    'horse_uid' => 821651,
                    'race_position' => '1',
                ],
                [
                    'trainer_uid' => 18145,
                    'race_instance_uid' => 703518,
                    'race_year' => 2015,
                    'horse_uid' => 868141,
                    'race_position' => '4',
                ],
                [
                    'trainer_uid' => 18145,
                    'race_instance_uid' => 703518,
                    'race_year' => 2016,
                    'horse_uid' => 902762,
                    'race_position' => '1',
                ],
                [
                    'trainer_uid' => 18145,
                    'race_instance_uid' => 703521,
                    'race_year' => 2009,
                    'horse_uid' => 680388,
                    'race_position' => '7',
                ],
                [
                    'trainer_uid' => 18145,
                    'race_instance_uid' => 703521,
                    'race_year' => 2010,
                    'horse_uid' => 637835,
                    'race_position' => '1',
                ],
                [
                    'trainer_uid' => 18145,
                    'race_instance_uid' => 703521,
                    'race_year' => 2011,
                    'horse_uid' => 685636,
                    'race_position' => '3',
                ],
                [
                    'trainer_uid' => 18145,
                    'race_instance_uid' => 703521,
                    'race_year' => 2012,
                    'horse_uid' => 661057,
                    'race_position' => '5',
                ],
                [
                    'trainer_uid' => 18145,
                    'race_instance_uid' => 703521,
                    'race_year' => 2013,
                    'horse_uid' => 752819,
                    'race_position' => '6',
                ],
                [
                    'trainer_uid' => 18145,
                    'race_instance_uid' => 703521,
                    'race_year' => 2015,
                    'horse_uid' => 832563,
                    'race_position' => '4',
                ],
                [
                    'trainer_uid' => 18145,
                    'race_instance_uid' => 703521,
                    'race_year' => 2016,
                    'horse_uid' => 805259,
                    'race_position' => '1',
                ],
                [
                    'trainer_uid' => 28787,
                    'race_instance_uid' => 701458,
                    'race_year' => 2016,
                    'horse_uid' => 990089,
                    'race_position' => '1',
                ],
                [
                    'trainer_uid' => 28787,
                    'race_instance_uid' => 701458,
                    'race_year' => 2017,
                    'horse_uid' => 1293881,
                    'race_position' => '1',
                ],
            ],
            //Api\Mvc\DataProvider\TemporaryTable:85 ->dropTemporaryTable()
            '18fd6c408f9a3661ad4949b9ac3f6ec2' => [
            ],
            //Api\Mvc\DataProvider\TemporaryTable:85 ->dropTemporaryTable()
            '8c9fb5d1f9e393a27e23222fe5a607f2' => [
            ],
        ];
    }

    /**
     * @return array
     */
    public function getReplacement(): array
    {
        return [
            'dateStart' => '2018-05-29 00:00',
            'dateEnd' => '2018-05-29 23:59'
        ];
    }
}
