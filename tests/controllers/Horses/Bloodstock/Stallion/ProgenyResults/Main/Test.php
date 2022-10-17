<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Bloodstock\Stallion\ProgenyResults\Main;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;
use \Api\DataProvider\Bo\Bloodstock\Stallion\Stallion;

/**
 * @package Tests\Controllers\Horses\Bloodstock\Stallion\ProgenyResults\Main
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/bloodstock/stallion/734508/progeny-results';
    }

    /**
     * @inheritdoc
     */
    public function tearDown()
    {
        Stallion::clear();
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\Bloodstock\Stallion\ProgenySeason:203 ->getLastProgenyRaceDatetime()
            '1b6f3848732a3346938ad772f6947a50' => [
                [
                    'race_datetime' => '2018-05-22 17:40:00',
                ],
            ],
            //Api\DataProvider\Bo\Bloodstock\Stallion\ProgenySeason:73 ->getAppropriateSeasons()
            '5e6f32166ac9c663e6d49450a1adb148' => [
                [
                    'season_start_date' => '2018-01-01 00:00:00',
                    'season_end_date' => '2018-12-31 23:59:00',
                    'season_type_code' => 'F',
                ],
                [
                    'season_start_date' => '2018-04-29 00:00:00',
                    'season_end_date' => '2019-04-27 23:59:00',
                    'season_type_code' => 'I',
                ],
                [
                    'season_start_date' => '2018-04-29 00:00:00',
                    'season_end_date' => '2019-04-27 23:59:00',
                    'season_type_code' => 'J',
                ],
            ],
            //Api\DataProvider\Bo\Bloodstock\Stallion\ProgenySeason:271 ->getResultsBySeasons()
            '9bf4fc0df7a1c99eb4eb7e133280d3bf' => [
                [
                    'raceType' => 'flat',
                    'countryCode' => 'IRE',
                    'seasonDateBegin' => '2018-01-01 00:00:00',
                    'seasonDateEnd' => '2018-12-31 23:59:00',
                    'seasonYearBegin' => 2018,
                    'seasonYearEnd' => 2018,
                    'resultCount' => 6,
                ],
                [
                    'raceType' => 'flat',
                    'countryCode' => 'GB',
                    'seasonDateBegin' => '2018-01-01 00:00:00',
                    'seasonDateEnd' => '2018-12-31 23:59:00',
                    'seasonYearBegin' => 2018,
                    'seasonYearEnd' => 2018,
                    'resultCount' => 1,
                ],
                [
                    'raceType' => 'jumps',
                    'countryCode' => 'GB',
                    'seasonDateBegin' => '2018-04-29 00:00:00',
                    'seasonDateEnd' => '2019-04-27 23:59:00',
                    'seasonYearBegin' => 2018,
                    'seasonYearEnd' => 2019,
                    'resultCount' => 1,
                ],
            ],
            //Api\DataProvider\Bo\Bloodstock\Stallion\ProgenyResults:91 ->getProgenyResults()
            '17119f86f2d54b245b029f4a0b2e7779' => [
            ],
            //Api\DataProvider\Bo\Bloodstock\Stallion\ProgenyResults:131 ->getProgenyResults()
            'ee4c7d62f5c2454f4a876798809732c0' => [
                [
                    'horse_uid' => 1552019,
                    'country_origin_code' => 'FR',
                    'style_name' => 'Our Anniversary',
                    'rp_postmark' => 41,
                    'rp_topspeed' => 14,
                    'official_rating_ran_off' => 67,
                    'race_instance_uid' => 701708,
                    'race_datetime' => '2018-05-11 15:40:00',
                    'race_instance_title' => 'Buy Tickets Online @ Curragh.ie Apprentice Handicap',
                    'distance_yard' => 1540,
                    'race_type_code' => 'F',
                    'going_type_code' => 'HY',
                    'no_of_runners' => 30,
                    'race_group_desc' => 'Handicap',
                    'race_group_code' => 'H',
                    'race_outcome_position' => 18,
                    'race_outcome_code' => '18 ',
                    'country_code' => 'IRE',
                    'course_uid' => 178,
                    'course_name' => 'Curragh',
                    'prize_money' => 5996.4602,
                    'prize_money_euro' => 6776.000026,
                    'actual_race_class' => null,
                    'no_of_runners_calculated' => 30,
                    'rp_ages_allowed_desc' => '4yo+',
                    'course_rp_abbrev_3' => 'CUR',
                    'course_region' => 'GB & IRE'
                ],
                [
                    'horse_uid' => 1552019,
                    'country_origin_code' => 'FR',
                    'style_name' => 'Our Anniversary',
                    'rp_postmark' => 68,
                    'rp_topspeed' => -1,
                    'official_rating_ran_off' => 67,
                    'race_instance_uid' => 699115,
                    'race_datetime' => '2018-04-15 16:45:00',
                    'race_instance_title' => 'Buy Online At Corkracecourse.ie Apprentice Handicap',
                    'distance_yard' => 2200,
                    'race_type_code' => 'F',
                    'going_type_code' => 'HY',
                    'no_of_runners' => 13,
                    'race_group_desc' => 'Handicap',
                    'race_group_code' => 'H',
                    'race_outcome_position' => 4,
                    'race_outcome_code' => '4  ',
                    'country_code' => 'IRE',
                    'course_uid' => 596,
                    'course_name' => 'Cork',
                    'prize_money' => 6541.5929,
                    'prize_money_euro' => 7391.999977,
                    'actual_race_class' => null,
                    'no_of_runners_calculated' => 13,
                    'rp_ages_allowed_desc' => '4yo+',
                    'course_rp_abbrev_3' => 'COR',
                    'course_region' => 'GB & IRE'
                ],
                [
                    'horse_uid' => 1552019,
                    'country_origin_code' => 'FR',
                    'style_name' => 'Our Anniversary',
                    'rp_postmark' => 78,
                    'rp_topspeed' => 49,
                    'official_rating_ran_off' => 60,
                    'race_instance_uid' => 697752,
                    'race_datetime' => '2018-03-31 17:05:00',
                    'race_instance_title' => 'Follow Us On Twitter Apprentice Handicap',
                    'distance_yard' => 1860,
                    'race_type_code' => 'F',
                    'going_type_code' => 'HY',
                    'no_of_runners' => 12,
                    'race_group_desc' => 'Handicap',
                    'race_group_code' => 'H',
                    'race_outcome_position' => 1,
                    'race_outcome_code' => '1  ',
                    'country_code' => 'IRE',
                    'course_uid' => 596,
                    'course_name' => 'Cork',
                    'prize_money' => 6814.1593,
                    'prize_money_euro' => 7700.000009,
                    'actual_race_class' => null,
                    'no_of_runners_calculated' => 12,
                    'rp_ages_allowed_desc' => '4yo+',
                    'course_rp_abbrev_3' => 'COR',
                    'course_region' => 'GB & IRE'
                ],
                [
                    'horse_uid' => 991615,
                    'country_origin_code' => 'FR',
                    'style_name' => 'Rock On Dandy',
                    'rp_postmark' => 78,
                    'rp_topspeed' => 54,
                    'official_rating_ran_off' => 79,
                    'race_instance_uid' => 695972,
                    'race_datetime' => '2018-03-09 20:30:00',
                    'race_instance_title' => '32Red Download The App Handicap',
                    'distance_yard' => 2640,
                    'race_type_code' => 'X',
                    'going_type_code' => 'SD',
                    'no_of_runners' => 12,
                    'race_group_desc' => 'Handicap',
                    'race_group_code' => 'H',
                    'race_outcome_position' => 6,
                    'race_outcome_code' => '6  ',
                    'country_code' => 'IRE',
                    'course_uid' => 1138,
                    'course_name' => 'Dundalk (A.W)',
                    'prize_money' => 5996.4602,
                    'prize_money_euro' => 6776.000026,
                    'actual_race_class' => null,
                    'no_of_runners_calculated' => 12,
                    'rp_ages_allowed_desc' => '4yo+',
                    'course_rp_abbrev_3' => 'DUN',
                    'course_region' => 'GB & IRE'
                ],
                [
                    'horse_uid' => 991615,
                    'country_origin_code' => 'FR',
                    'style_name' => 'Rock On Dandy',
                    'rp_postmark' => 78,
                    'rp_topspeed' => 18,
                    'official_rating_ran_off' => 73,
                    'race_instance_uid' => 693951,
                    'race_datetime' => '2018-02-09 18:00:00',
                    'race_instance_title' => 'ASM Chartered Accountants Race',
                    'distance_yard' => 3520,
                    'race_type_code' => 'X',
                    'going_type_code' => 'SD',
                    'no_of_runners' => 6,
                    'race_group_desc' => 'Unknown',
                    'race_group_code' => '0',
                    'race_outcome_position' => 1,
                    'race_outcome_code' => '1  ',
                    'country_code' => 'IRE',
                    'course_uid' => 1138,
                    'course_name' => 'Dundalk (A.W)',
                    'prize_money' => 10902.6549,
                    'prize_money_euro' => 12320.000037,
                    'actual_race_class' => null,
                    'no_of_runners_calculated' => 6,
                    'rp_ages_allowed_desc' => '4yo+',
                    'course_rp_abbrev_3' => 'DUN',
                    'course_region' => 'GB & IRE'
                ],
                [
                    'horse_uid' => 991615,
                    'country_origin_code' => 'FR',
                    'style_name' => 'Rock On Dandy',
                    'rp_postmark' => 76,
                    'rp_topspeed' => 51,
                    'official_rating_ran_off' => 74,
                    'race_instance_uid' => 692721,
                    'race_datetime' => '2018-01-19 18:30:00',
                    'race_instance_title' => 'Race Displays Handicap',
                    'distance_yard' => 2350,
                    'race_type_code' => 'X',
                    'going_type_code' => 'SD',
                    'no_of_runners' => 14,
                    'race_group_desc' => 'Handicap',
                    'race_group_code' => 'H',
                    'race_outcome_position' => 6,
                    'race_outcome_code' => '6  ',
                    'country_code' => 'IRE',
                    'course_uid' => 1138,
                    'course_name' => 'Dundalk (A.W)',
                    'prize_money' => 6541.5929,
                    'prize_money_euro' => 7391.999977,
                    'actual_race_class' => null,
                    'no_of_runners_calculated' => 14,
                    'rp_ages_allowed_desc' => '4yo+',
                    'course_rp_abbrev_3' => 'DUN',
                    'course_region' => 'GB & IRE'
                ],
            ],
            //Api\Mvc\DataProvider\TemporaryTable:85 ->dropTemporaryTable()
            '52c86dce42960ce6b09e3745c847f1b6' => [
            ],
        ];
    }
}
