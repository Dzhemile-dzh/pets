<?php

namespace Tests\Stubs\Data\Horses\Results\PastWinners;

use UnitTestsComponents\Stubs\StubDataInterface;

/**
 * Class StubData
 *
 * @package Tests\Stubs\Data\Horses\Results\PastWinners
 */
class StubData implements StubDataInterface
{
    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\LastYearRaces:114 ->getPastRacesIDs()
            '9a70fbf1529a8cb584da4efbedbc5ca9' => [
                [
                    'root_uid' => 693797,
                    'race_instance_uid' => 476093,
                    'race_datetime' => '2009-03-21 14:35:00',
                ],
                [
                    'root_uid' => 693797,
                    'race_instance_uid' => 500172,
                    'race_datetime' => '2010-03-20 15:00:00',
                ],
                [
                    'root_uid' => 693797,
                    'race_instance_uid' => 525478,
                    'race_datetime' => '2011-03-26 14:35:00',
                ],
                [
                    'root_uid' => 693797,
                    'race_instance_uid' => 549055,
                    'race_datetime' => '2012-03-24 14:25:00',
                ],
                [
                    'root_uid' => 693797,
                    'race_instance_uid' => 573101,
                    'race_datetime' => '2013-03-16 14:55:00',
                ],
                [
                    'root_uid' => 693797,
                    'race_instance_uid' => 596613,
                    'race_datetime' => '2014-03-22 15:15:00',
                ],
                [
                    'root_uid' => 693797,
                    'race_instance_uid' => 619280,
                    'race_datetime' => '2015-03-14 14:30:00',
                ],
                [
                    'root_uid' => 693797,
                    'race_instance_uid' => 643838,
                    'race_datetime' => '2016-03-05 16:15:00',
                ],
                [
                    'root_uid' => 693797,
                    'race_instance_uid' => 668580,
                    'race_datetime' => '2017-03-04 16:20:00',
                ],
                [
                    'root_uid' => 693797,
                    'race_instance_uid' => 693797,
                    'race_datetime' => '2018-03-03 15:30:00',
                ],
            ],
            //Api\DataProvider\Bo\Results\PastWinners:66 ->getPastWinners()
            'bdf00da4e81ceadba44a8177b535f846' => [
                [
                    'race_datetime' => '2017-03-04 16:20:00',
                    'race_instance_uid' => 668580,
                    'lst_yr_race_instance_uid' => 643838,
                    'weight_carried_lbs' => 127,
                    'rp_postmark' => 105,
                    'weight_allowance_lbs' => 0,
                    'draw' => 3,
                    'odds_desc' => '13/8F',
                    'horse_style_name' => 'Second Thought',
                    'country_origin_code' => 'IRE',
                    'horse_uid' => 1021357,
                    'horse_age' => 3,
                    'trainer_style_name' => 'William Haggas',
                    'trainer_uid' => 3415,
                    'jockey_style_name' => 'Robert Winston',
                    'jockey_uid' => 14522,
                    'course_uid' => 393,
                    'course_name' => 'LINGFIELD (A.W)',
                ],
                [
                    'race_datetime' => '2016-03-05 16:15:00',
                    'race_instance_uid' => 643838,
                    'lst_yr_race_instance_uid' => 619280,
                    'weight_carried_lbs' => 127,
                    'rp_postmark' => 103,
                    'weight_allowance_lbs' => 0,
                    'draw' => 3,
                    'odds_desc' => '8/1',
                    'horse_style_name' => 'Haalick',
                    'country_origin_code' => 'IRE',
                    'horse_uid' => 886914,
                    'horse_age' => 3,
                    'trainer_style_name' => 'Roger Varian',
                    'trainer_uid' => 24890,
                    'jockey_style_name' => 'Jack Mitchell',
                    'jockey_uid' => 84416,
                    'course_uid' => 393,
                    'course_name' => 'LINGFIELD (A.W)',
                ],
                [
                    'race_datetime' => '2015-03-14 14:30:00',
                    'race_instance_uid' => 619280,
                    'lst_yr_race_instance_uid' => 596613,
                    'weight_carried_lbs' => 127,
                    'rp_postmark' => 106,
                    'weight_allowance_lbs' => 0,
                    'draw' => 3,
                    'odds_desc' => '10/1',
                    'horse_style_name' => 'Lexington Times',
                    'country_origin_code' => 'IRE',
                    'horse_uid' => 855899,
                    'horse_age' => 3,
                    'trainer_style_name' => 'Richard Hannon',
                    'trainer_uid' => 28787,
                    'jockey_style_name' => 'Richard Hughes',
                    'jockey_uid' => 3793,
                    'course_uid' => 393,
                    'course_name' => 'LINGFIELD (A.W)',
                ],
                [
                    'race_datetime' => '2014-03-22 15:15:00',
                    'race_instance_uid' => 596613,
                    'lst_yr_race_instance_uid' => 573101,
                    'weight_carried_lbs' => 127,
                    'rp_postmark' => 101,
                    'weight_allowance_lbs' => 0,
                    'draw' => 13,
                    'odds_desc' => '5/4F',
                    'horse_style_name' => 'Ertijaal',
                    'country_origin_code' => 'IRE',
                    'horse_uid' => 835481,
                    'horse_age' => 3,
                    'trainer_style_name' => 'William Haggas',
                    'trainer_uid' => 3415,
                    'jockey_style_name' => 'Paul Hanagan',
                    'jockey_uid' => 76957,
                    'course_uid' => 393,
                    'course_name' => 'LINGFIELD (A.W)',
                ],
                [
                    'race_datetime' => '2013-03-16 14:55:00',
                    'race_instance_uid' => 573101,
                    'lst_yr_race_instance_uid' => 549055,
                    'weight_carried_lbs' => 127,
                    'rp_postmark' => 97,
                    'weight_allowance_lbs' => 0,
                    'draw' => 10,
                    'odds_desc' => '10/1',
                    'horse_style_name' => 'Teophilip',
                    'country_origin_code' => 'IRE',
                    'horse_uid' => 802081,
                    'horse_age' => 3,
                    'trainer_style_name' => 'Marco Botti',
                    'trainer_uid' => 9003,
                    'jockey_style_name' => 'Andrea Atzeni',
                    'jockey_uid' => 87349,
                    'course_uid' => 393,
                    'course_name' => 'LINGFIELD (A.W)',
                ],
                [
                    'race_datetime' => '2012-03-24 14:25:00',
                    'race_instance_uid' => 549055,
                    'lst_yr_race_instance_uid' => 525478,
                    'weight_carried_lbs' => 129,
                    'rp_postmark' => 111,
                    'weight_allowance_lbs' => 0,
                    'draw' => 2,
                    'odds_desc' => '9/4F',
                    'horse_style_name' => 'Gusto',
                    'country_origin_code' => 'GB',
                    'horse_uid' => 789757,
                    'horse_age' => 3,
                    'trainer_style_name' => 'Richard Hannon Snr',
                    'trainer_uid' => 282,
                    'jockey_style_name' => 'Ryan Moore',
                    'jockey_uid' => 79202,
                    'course_uid' => 393,
                    'course_name' => 'LINGFIELD (A.W)',
                ],
                [
                    'race_datetime' => '2011-03-26 14:35:00',
                    'race_instance_uid' => 525478,
                    'lst_yr_race_instance_uid' => 500172,
                    'weight_carried_lbs' => 127,
                    'rp_postmark' => 105,
                    'weight_allowance_lbs' => 0,
                    'draw' => 5,
                    'odds_desc' => '7/4F',
                    'horse_style_name' => 'Dubawi Gold',
                    'country_origin_code' => 'GB',
                    'horse_uid' => 759530,
                    'horse_age' => 3,
                    'trainer_style_name' => 'Richard Hannon Snr',
                    'trainer_uid' => 282,
                    'jockey_style_name' => 'Jimmy Fortune',
                    'jockey_uid' => 3659,
                    'course_uid' => 393,
                    'course_name' => 'LINGFIELD (A.W)',
                ],
                [
                    'race_datetime' => '2010-03-20 15:00:00',
                    'race_instance_uid' => 500172,
                    'lst_yr_race_instance_uid' => 476093,
                    'weight_carried_lbs' => 127,
                    'rp_postmark' => 101,
                    'weight_allowance_lbs' => 0,
                    'draw' => 8,
                    'odds_desc' => '7/1',
                    'horse_style_name' => 'Classic Colori',
                    'country_origin_code' => 'IRE',
                    'horse_uid' => 735611,
                    'horse_age' => 3,
                    'trainer_style_name' => 'Tom Dascombe',
                    'trainer_uid' => 17934,
                    'jockey_style_name' => 'Richard Kingscote',
                    'jockey_uid' => 83554,
                    'course_uid' => 393,
                    'course_name' => 'LINGFIELD (A.W)',
                ],
                [
                    'race_datetime' => '2009-03-21 14:35:00',
                    'race_instance_uid' => 476093,
                    'lst_yr_race_instance_uid' => 450490,
                    'weight_carried_lbs' => 122,
                    'rp_postmark' => 105,
                    'weight_allowance_lbs' => 0,
                    'draw' => 12,
                    'odds_desc' => '7/1',
                    'horse_style_name' => 'Nashmiah',
                    'country_origin_code' => 'IRE',
                    'horse_uid' => 711018,
                    'horse_age' => 3,
                    'trainer_style_name' => 'Clive Brittain',
                    'trainer_uid' => 693,
                    'jockey_style_name' => 'Jamie Spencer',
                    'jockey_uid' => 13689,
                    'course_uid' => 393,
                    'course_name' => 'LINGFIELD (A.W)',
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function getExpected(): string
    {
        return file_get_contents(dirname(__FILE__) . '/expected.json');
    }

    /**
     * @return array
     */
    public function getReplacement(): array
    {
        return [];
    }
}
