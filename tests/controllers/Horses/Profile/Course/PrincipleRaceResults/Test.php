<?php

namespace tests\controllers\Horses\Profile\Course\PrincipleRaceResults;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * @package tests\controllers\Horses\Profile\Course\PrincipleRaceResults
 */
class Test extends ApiRouteTestPrototype
{

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/profile/course/272/principle-race-results/2018';
    }

    /**
     * Mocked data
     * Format:
     * 'some_MD5_hash' => [
     *      [row...]
     * ]
     *
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Models\Bo\CourseProfile\Course:501 ->getDefaultValues()
            '0a0b1727bf0eee2f4758f5bbc58eb0e1' => [
                [
                    'course_type_code' => 'F',
                ],
            ],
            //Models\Bo\CourseProfile\RaceInstance:33 ->getLastRaceTypeCode()
            '7cc79d31f4d2e2b7be9a7bf4f9658765' => [
            ],
            //Models\Bo\CourseProfile\Course:51 ->getProfile()
            '3f484bc811a7905b581c15f42fe321be' => [
                [
                    'course_name' => 'GULFSTREAM PARK',
                    'course_style_name' => 'Gulfstream Park',
                    'course_clerk' => null,
                    'course_tel' => null,
                    'course_scales_clerk' => null,
                    'course_judge' => null,
                    'course_stewards' => null,
                    'course_starters' => null,
                    'course_type_code' => 'B',
                    'country_code' => 'USA',
                ],
            ],
            //Models\Bo\Selectors\Database:43 ->getSeasonDateBegin()
            '5c064ba6ac41a126e3814b8332426e02' => [
                [
                    'startDate' => '2018-01-01 00:00:00',
                ],
            ],
            //Models\Bo\Selectors\Database:128 ->getSeasonDateEndByDateBegin()
            'ce9b2bbf2da4bcf30f3829231a27aba3' => [
                [
                    'endDate' => '2018-12-31 23:59:00',
                ],
            ],
            //Models\Bo\CourseProfile\Course:328 ->checkExistenceOfBigRaces()
            '810ba29ebdb658b95dfb335e28708e56' => [
                [
                    'bigRaceExist' => 'Y',
                ],
            ],
            //Models\Bo\CourseProfile\Course:296 ->getPrincipleRaceResults()
            '759d2391d2bcbdb98f1868848be659ae' => [
                [
                    'race_instance_uid' => 693384,
                    'race_instance_title' => 'Pegasus World Cup Invitational Stakes (Grade 1) (4yo+) (Dirt)',
                    'race_group_uid' => 7,
                    'race_datetime' => '2018-01-27 22:35:00',
                    'horse_uid' => 901222,
                    'horse_style_name' => 'Gun Runner',
                    'country_origin_code' => 'USA',
                    'trainer_uid' => 11876,
                    'trainer_style_name' => 'Steven Asmussen',
                    'ptp_type_code' => 'N',
                    'prize_sterling' => 5185185.1852,
                ],
                [
                    'race_instance_uid' => 698227,
                    'race_instance_title' => 'Xpressbet Florida Derby (Grade 1) (3yo) (Dirt)',
                    'race_group_uid' => 7,
                    'race_datetime' => '2018-03-31 23:30:00',
                    'horse_uid' => 1817202,
                    'horse_style_name' => 'Audible',
                    'country_origin_code' => 'USA',
                    'trainer_uid' => 10697,
                    'trainer_style_name' => 'Todd Pletcher',
                    'ptp_type_code' => 'N',
                    'prize_sterling' => 440888.8889,
                ],
                [
                    'race_instance_uid' => 695854,
                    'race_instance_title' => 'Xpressbet Fountain Of Youth Stakes (Grade 2) (3yo) (Dirt)',
                    'race_group_uid' => 8,
                    'race_datetime' => '2018-03-03 23:09:00',
                    'horse_uid' => 1721366,
                    'horse_style_name' => 'Promises Fulfilled',
                    'country_origin_code' => 'USA',
                    'trainer_uid' => 12007,
                    'trainer_style_name' => 'Dale Romans',
                    'ptp_type_code' => 'N',
                    'prize_sterling' => 176355.5556,
                ],
                [
                    'race_instance_uid' => 693824,
                    'race_instance_title' => 'Holy Bull Stakes (Grade 2) (3yo) (Dirt)',
                    'race_group_uid' => 8,
                    'race_datetime' => '2018-02-03 22:49:00',
                    'horse_uid' => 1817202,
                    'horse_style_name' => 'Audible',
                    'country_origin_code' => 'USA',
                    'trainer_uid' => 10697,
                    'trainer_style_name' => 'Todd Pletcher',
                    'ptp_type_code' => 'N',
                    'prize_sterling' => 154311.1111,
                ],
                [
                    'race_instance_uid' => 698285,
                    'race_instance_title' => 'Gulfstream Park Hardacre Mile Stakes (Grade 2) (4yo+) (Dirt)',
                    'race_group_uid' => 8,
                    'race_datetime' => '2018-03-31 20:00:00',
                    'horse_uid' => 901229,
                    'horse_style_name' => 'Conquest Big E',
                    'country_origin_code' => 'USA',
                    'trainer_uid' => 33678,
                    'trainer_style_name' => 'Donna Green Hurtak',
                    'ptp_type_code' => 'N',
                    'prize_sterling' => 136400.0,
                ],
                [
                    'race_instance_uid' => 694281,
                    'race_instance_title' => 'Gulfstream Park Turf Stakes (Grade 1) (4yo+) (Turf)',
                    'race_group_uid' => 7,
                    'race_datetime' => '2018-02-10 21:10:00',
                    'horse_uid' => 842810,
                    'horse_style_name' => 'Heart To Heart',
                    'country_origin_code' => 'CAN',
                    'trainer_uid' => 18403,
                    'trainer_style_name' => 'Brian A Lynch',
                    'ptp_type_code' => 'N',
                    'prize_sterling' => 133644.4444,
                ],
                [
                    'race_instance_uid' => 706464,
                    'race_instance_title' => 'Smile Sprint Stakes (Grade 3) (3yo+) (Dirt)',
                    'race_group_uid' => 9,
                    'race_datetime' => '2018-06-30 23:02:00',
                    'horse_uid' => 876119,
                    'horse_style_name' => 'X Y Jet',
                    'country_origin_code' => 'USA',
                    'trainer_uid' => 21900,
                    'trainer_style_name' => 'Jorge Navarro',
                    'ptp_type_code' => 'N',
                    'prize_sterling' => 124333.3333,
                ],
                [
                    'race_instance_uid' => 706461,
                    'race_instance_title' => 'Princess Rooney Stakes (Grade 2) (3yo+ Fillies & Mares) (Dirt)',
                    'race_group_uid' => 8,
                    'race_datetime' => '2018-06-30 22:30:00',
                    'horse_uid' => 1474256,
                    'horse_style_name' => 'Stormy Embrace',
                    'country_origin_code' => 'USA',
                    'trainer_uid' => 11059,
                    'trainer_style_name' => 'Kathleen O\'Connell',
                    'ptp_type_code' => 'N',
                    'prize_sterling' => 124333.3333,
                ],
                [
                    'race_instance_uid' => 698288,
                    'race_instance_title' => 'Pan American Stakes (Grade 2) (4yo+) (Turf)',
                    'race_group_uid' => 8,
                    'race_datetime' => '2018-03-31 23:00:00',
                    'horse_uid' => 893618,
                    'horse_style_name' => 'Hi Happy',
                    'country_origin_code' => 'ARG',
                    'trainer_uid' => 10697,
                    'trainer_style_name' => 'Todd Pletcher',
                    'ptp_type_code' => 'N',
                    'prize_sterling' => 110222.2222,
                ],
                [
                    'race_instance_uid' => 698286,
                    'race_instance_title' => 'Honey Fox Stakes (Grade 3) (4yo+ Fillies & Mares) (Turf)',
                    'race_group_uid' => 9,
                    'race_datetime' => '2018-03-31 21:49:00',
                    'horse_uid' => 1122596,
                    'horse_style_name' => 'Lull',
                    'country_origin_code' => 'USA',
                    'trainer_uid' => 8179,
                    'trainer_style_name' => 'Christophe Clement',
                    'ptp_type_code' => 'N',
                    'prize_sterling' => 110222.2222,
                ],
                [
                    'race_instance_uid' => 698287,
                    'race_instance_title' => 'Gulfstream Park Oaks (Grade 2) (3yo Fillies) (Dirt)',
                    'race_group_uid' => 8,
                    'race_datetime' => '2018-03-31 22:26:00',
                    'horse_uid' => 1751405,
                    'horse_style_name' => 'Coach Rocks',
                    'country_origin_code' => 'USA',
                    'trainer_uid' => 12007,
                    'trainer_style_name' => 'Dale Romans',
                    'ptp_type_code' => 'N',
                    'prize_sterling' => 107925.9259,
                ],
                [
                    'race_instance_uid' => 693910,
                    'race_instance_title' => 'Swale Stakes (Grade 3) (3yo) (Dirt)',
                    'race_group_uid' => 9,
                    'race_datetime' => '2018-02-03 18:30:00',
                    'horse_uid' => 1821369,
                    'horse_style_name' => 'Strike Power',
                    'country_origin_code' => 'USA',
                    'trainer_uid' => 8077,
                    'trainer_style_name' => 'Mark Hennig',
                    'ptp_type_code' => 'N',
                    'prize_sterling' => 90933.3333,
                ],
                [
                    'race_instance_uid' => 697094,
                    'race_instance_title' => 'Inside Information Stakes (Grade 2) (4yo+ Fillies & Mares) (Dirt)',
                    'race_group_uid' => 8,
                    'race_datetime' => '2018-03-17 21:04:00',
                    'horse_uid' => 1157582,
                    'horse_style_name' => 'Ivy Bell',
                    'country_origin_code' => 'USA',
                    'trainer_uid' => 10697,
                    'trainer_style_name' => 'Todd Pletcher',
                    'ptp_type_code' => 'N',
                    'prize_sterling' => 90014.8148,
                ],
                [
                    'race_instance_uid' => 693461,
                    'race_instance_title' => 'La Prevoyante Handicap (Grade 3) (4yo+ Fillies & Mares) (Turf)',
                    'race_group_uid' => 13,
                    'race_datetime' => '2018-01-27 17:30:00',
                    'horse_uid' => 956917,
                    'horse_style_name' => 'Texting',
                    'country_origin_code' => 'USA',
                    'trainer_uid' => 20681,
                    'trainer_style_name' => 'Chad C Brown',
                    'ptp_type_code' => 'N',
                    'prize_sterling' => 90014.8148,
                ],
                [
                    'race_instance_uid' => 695924,
                    'race_instance_title' => 'Davona Dale Stakes (Grade 2) (3yo Fillies) (Dirt)',
                    'race_group_uid' => 8,
                    'race_datetime' => '2018-03-03 20:00:00',
                    'horse_uid' => 1864810,
                    'horse_style_name' => 'Fly So High',
                    'country_origin_code' => 'USA',
                    'trainer_uid' => 1701,
                    'trainer_style_name' => 'Claude McGaughey III',
                    'ptp_type_code' => 'N',
                    'prize_sterling' => 89096.2963,
                ],
                [
                    'race_instance_uid' => 694899,
                    'race_instance_title' => 'Royal Delta Stakes (Grade 3) (4yo+ Fillies & Mares) (Dirt)',
                    'race_group_uid' => 9,
                    'race_datetime' => '2018-02-19 22:16:00',
                    'horse_uid' => 1383277,
                    'horse_style_name' => 'Martini Glass',
                    'country_origin_code' => 'USA',
                    'trainer_uid' => 26198,
                    'trainer_style_name' => 'Keith Nations',
                    'ptp_type_code' => 'N',
                    'prize_sterling' => 89096.2963,
                ],
                [
                    'race_instance_uid' => 693913,
                    'race_instance_title' => 'Forward Gal Stakes (Grade 3) (3yo Fillies) (Dirt)',
                    'race_group_uid' => 9,
                    'race_datetime' => '2018-02-03 21:43:00',
                    'horse_uid' => 1628595,
                    'horse_style_name' => 'Take Charge Paula',
                    'country_origin_code' => 'USA',
                    'trainer_uid' => 9570,
                    'trainer_style_name' => 'Kiaran McLaughlin',
                    'ptp_type_code' => 'N',
                    'prize_sterling' => 89096.2963,
                ],
                [
                    'race_instance_uid' => 692692,
                    'race_instance_title' => 'Ft. Lauderdale Stakes (Grade 2) (4yo+) (Turf)',
                    'race_group_uid' => 8,
                    'race_datetime' => '2018-01-13 22:00:00',
                    'horse_uid' => 819579,
                    'horse_style_name' => 'Shining Copper',
                    'country_origin_code' => 'USA',
                    'trainer_uid' => 16548,
                    'trainer_style_name' => 'Michael J Maker',
                    'ptp_type_code' => 'N',
                    'prize_sterling' => 89096.2963,
                ],
                [
                    'race_instance_uid' => 693465,
                    'race_instance_title' => 'W.L. McKnight Handicap (Grade 3) (4yo+) (Turf)',
                    'race_group_uid' => 13,
                    'race_datetime' => '2018-01-27 20:04:00',
                    'horse_uid' => 897999,
                    'horse_style_name' => 'Oscar Nominated',
                    'country_origin_code' => 'USA',
                    'trainer_uid' => 16548,
                    'trainer_style_name' => 'Michael J Maker',
                    'ptp_type_code' => 'N',
                    'prize_sterling' => 88177.7778,
                ],
                [
                    'race_instance_uid' => 695828,
                    'race_instance_title' => 'Mac Diarmida Stakes (Grade 2) (4yo+) (Turf)',
                    'race_group_uid' => 8,
                    'race_datetime' => '2018-03-03 22:34:00',
                    'horse_uid' => 1032606,
                    'horse_style_name' => 'Sadler\'s Joy',
                    'country_origin_code' => 'USA',
                    'trainer_uid' => 15962,
                    'trainer_style_name' => 'Thomas Albertrani',
                    'ptp_type_code' => 'N',
                    'prize_sterling' => 85422.2222,
                ],
                [
                    'race_instance_uid' => 692691,
                    'race_instance_title' => 'Marshua\'s River Stakes (Grade 3) (4yo+ Fillies & Mares) (Turf)',
                    'race_group_uid' => 9,
                    'race_datetime' => '2018-01-13 21:00:00',
                    'horse_uid' => 1019917,
                    'horse_style_name' => 'Ultra Brat',
                    'country_origin_code' => 'USA',
                    'trainer_uid' => 12872,
                    'trainer_style_name' => 'H Graham Motion',
                    'ptp_type_code' => 'N',
                    'prize_sterling' => 68200.0,
                ],
                [
                    'race_instance_uid' => 695920,
                    'race_instance_title' => 'The Very One Stakes (Grade 3) (4yo+ Fillies & Mares) (Turf)',
                    'race_group_uid' => 9,
                    'race_datetime' => '2018-03-03 18:00:00',
                    'horse_uid' => 1530664,
                    'horse_style_name' => 'Holy Helena',
                    'country_origin_code' => 'CAN',
                    'trainer_uid' => 14938,
                    'trainer_style_name' => 'James Jerkens',
                    'ptp_type_code' => 'N',
                    'prize_sterling' => 67511.1111,
                ],
                [
                    'race_instance_uid' => 695925,
                    'race_instance_title' => 'Canadian Turf Stakes (Grade 3) (4yo+) (Turf)',
                    'race_group_uid' => 9,
                    'race_datetime' => '2018-03-03 21:00:00',
                    'horse_uid' => 793429,
                    'horse_style_name' => 'Hogy',
                    'country_origin_code' => 'USA',
                    'trainer_uid' => 16548,
                    'trainer_style_name' => 'Michael J Maker',
                    'ptp_type_code' => 'N',
                    'prize_sterling' => 66822.2222,
                ],
                [
                    'race_instance_uid' => 694389,
                    'race_instance_title' => 'Suwannee River Stakes (Grade 3) (4yo+ Fillies & Mares) (Turf)',
                    'race_group_uid' => 9,
                    'race_datetime' => '2018-02-10 21:43:00',
                    'horse_uid' => 892741,
                    'horse_style_name' => 'Elysea\'s World',
                    'country_origin_code' => 'IRE',
                    'trainer_uid' => 20681,
                    'trainer_style_name' => 'Chad C Brown',
                    'ptp_type_code' => 'N',
                    'prize_sterling' => 66133.3333,
                ],
                [
                    'race_instance_uid' => 693463,
                    'race_instance_title' => 'Fred W. Hooper Stakes (Grade 3) (4yo+) (Dirt)',
                    'race_group_uid' => 9,
                    'race_datetime' => '2018-01-27 19:32:00',
                    'horse_uid' => 880221,
                    'horse_style_name' => 'Tommy Macho',
                    'country_origin_code' => 'USA',
                    'trainer_uid' => 10697,
                    'trainer_style_name' => 'Todd Pletcher',
                    'ptp_type_code' => 'N',
                    'prize_sterling' => 55111.1111,
                ],
                [
                    'race_instance_uid' => 693383,
                    'race_instance_title' => 'South Beach Stakes (Listed Race) (4yo+ Fillies & Mares) (Turf)',
                    'race_group_uid' => 4,
                    'race_datetime' => '2018-01-27 21:50:00',
                    'horse_uid' => 864957,
                    'horse_style_name' => 'Stormy Victoria',
                    'country_origin_code' => 'FR',
                    'trainer_uid' => 8179,
                    'trainer_style_name' => 'Christophe Clement',
                    'ptp_type_code' => 'N',
                    'prize_sterling' => 53962.963,
                ],
                [
                    'race_instance_uid' => 693466,
                    'race_instance_title' => 'Hurricane Bertie Stakes (Grade 3) (4yo+ Fillies & Mares) (Dirt)',
                    'race_group_uid' => 9,
                    'race_datetime' => '2018-01-27 20:38:00',
                    'horse_uid' => 1144346,
                    'horse_style_name' => 'Jordan\'s Henny',
                    'country_origin_code' => 'USA',
                    'trainer_uid' => 14487,
                    'trainer_style_name' => 'Michael A Tomlinson',
                    'ptp_type_code' => 'N',
                    'prize_sterling' => 53388.8889,
                ],
                [
                    'race_instance_uid' => 697634,
                    'race_instance_title' => 'Hutcheson Stakes (Grade 3) (3yo) (Dirt)',
                    'race_group_uid' => 9,
                    'race_datetime' => '2018-03-24 21:44:00',
                    'horse_uid' => 1894535,
                    'horse_style_name' => 'Madison\'s Luna',
                    'country_origin_code' => 'USA',
                    'trainer_uid' => 28493,
                    'trainer_style_name' => 'Philip A Bauer',
                    'ptp_type_code' => 'N',
                    'prize_sterling' => 45466.6667,
                ],
                [
                    'race_instance_uid' => 695922,
                    'race_instance_title' => 'Palm Beach Stakes (Grade 3) (3yo) (Turf)',
                    'race_group_uid' => 9,
                    'race_datetime' => '2018-03-03 19:00:00',
                    'horse_uid' => 1648973,
                    'horse_style_name' => 'Maraud',
                    'country_origin_code' => 'USA',
                    'trainer_uid' => 10697,
                    'trainer_style_name' => 'Todd Pletcher',
                    'ptp_type_code' => 'N',
                    'prize_sterling' => 45007.41,
                ],
                [
                    'race_instance_uid' => 695358,
                    'race_instance_title' => 'Hal\'s Hope Stakes (Grade 3) (4yo+) (Dirt)',
                    'race_group_uid' => 9,
                    'race_datetime' => '2018-02-24 22:35:00',
                    'horse_uid' => 898774,
                    'horse_style_name' => 'Economic Model',
                    'country_origin_code' => 'USA',
                    'trainer_uid' => 20681,
                    'trainer_style_name' => 'Chad C Brown',
                    'ptp_type_code' => 'N',
                    'prize_sterling' => 45007.4074,
                ],
                [
                    'race_instance_uid' => 695923,
                    'race_instance_title' => 'Herecomesthebride Stakes (Grade 3) (3yo) (Turf)',
                    'race_group_uid' => 9,
                    'race_datetime' => '2018-03-03 19:30:00',
                    'horse_uid' => 1547583,
                    'horse_style_name' => 'Thewayiam',
                    'country_origin_code' => 'FR',
                    'trainer_uid' => 12872,
                    'trainer_style_name' => 'H Graham Motion',
                    'ptp_type_code' => 'N',
                    'prize_sterling' => 44548.1482,
                ],
                [
                    'race_instance_uid' => 693914,
                    'race_instance_title' => 'Dania Beach Stakes (Grade 3) (3yo) (Turf)',
                    'race_group_uid' => 9,
                    'race_datetime' => '2018-02-03 22:16:00',
                    'horse_uid' => 1821380,
                    'horse_style_name' => 'Speed Franco',
                    'country_origin_code' => 'USA',
                    'trainer_uid' => 30107,
                    'trainer_style_name' => 'Gustavo Delgado',
                    'ptp_type_code' => 'N',
                    'prize_sterling' => 44088.8889,
                ],
                [
                    'race_instance_uid' => 693911,
                    'race_instance_title' => 'Sweetest Chant Stakes (Grade 3) (3yo) (Turf)',
                    'race_group_uid' => 9,
                    'race_datetime' => '2018-02-03 19:30:00',
                    'horse_uid' => 1547583,
                    'horse_style_name' => 'Thewayiam',
                    'country_origin_code' => 'FR',
                    'trainer_uid' => 12872,
                    'trainer_style_name' => 'H Graham Motion',
                    'ptp_type_code' => 'N',
                    'prize_sterling' => 44088.8889,
                ],
                [
                    'race_instance_uid' => 695926,
                    'race_instance_title' => 'Gulfstream Park Sprint Stakes (Grade 3) (4yo+) (Dirt)',
                    'race_group_uid' => 9,
                    'race_datetime' => '2018-03-03 22:02:00',
                    'horse_uid' => 1125099,
                    'horse_style_name' => 'Classic Rock',
                    'country_origin_code' => 'USA',
                    'trainer_uid' => 7183,
                    'trainer_style_name' => 'Kathy Ritvo',
                    'ptp_type_code' => 'N',
                    'prize_sterling' => 43629.6296,
                ],
            ],
            //Api\DataProvider\Bo\VideoProviders:31 ->getDetails() DROP TABLE #tmp_race_ids
            'fabddb1710b03508361534ea456ae438' => [
            ],
            //Api\DataProvider\Bo\VideoProviders:31 ->getDetails() SELECT INTO #tmp_race_ids
            '0fac35694989dbd0a966eee816a75e3b' => [
            ],
            //Api\DataProvider\Bo\VideoProviders:31 ->getDetails() Main statement
            '10beaaaa61612758c43257e79f9dda01' => [
            ],
        ];
    }

    /**
     * @return array
     */
    public function getReplacement(): array
    {
        return [
            'seasonStartDate' => '2018-01-01 00:00:00',
            'seasonBegin' => '2018-01-01 00:00:00',
            'seasonEnd' => '2018-12-31 23:59:00'
        ];
    }
}
