<?php

namespace Tests\Stubs\Data\Horses\RaceCards\PastWinners;

use UnitTestsComponents\Stubs\StubDataInterface;

/**
 * Class StubData
 *
 * @package Tests\Stubs\Data\Horses\RaceCards\PastWinners
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
            'fbd59a5eccecb7db76bc28b91f459552' => [
                [
                    'root_uid' => 699011,
                    'race_instance_uid' => 454413,
                    'race_datetime' => '2008-04-06 17:05:00',
                ],
                [
                    'root_uid' => 699011,
                    'race_instance_uid' => 479331,
                    'race_datetime' => '2009-04-05 17:05:00',
                ],
                [
                    'root_uid' => 699011,
                    'race_instance_uid' => 503933,
                    'race_datetime' => '2010-04-11 16:55:00',
                ],
                [
                    'root_uid' => 699011,
                    'race_instance_uid' => 527968,
                    'race_datetime' => '2011-04-03 17:15:00',
                ],
                [
                    'root_uid' => 699011,
                    'race_instance_uid' => 551454,
                    'race_datetime' => '2012-04-01 17:20:00',
                ],
                [
                    'root_uid' => 699011,
                    'race_instance_uid' => 576136,
                    'race_datetime' => '2013-04-07 17:35:00',
                ],
                [
                    'root_uid' => 699011,
                    'race_instance_uid' => 598665,
                    'race_datetime' => '2014-03-30 17:35:00',
                ],
                [
                    'root_uid' => 699011,
                    'race_instance_uid' => 622133,
                    'race_datetime' => '2015-03-29 17:40:00',
                ],
                [
                    'root_uid' => 699011,
                    'race_instance_uid' => 647457,
                    'race_datetime' => '2016-04-03 17:20:00',
                ],
                [
                    'root_uid' => 699011,
                    'race_instance_uid' => 672394,
                    'race_datetime' => '2017-04-06 17:30:00',
                ],
                [
                    'root_uid' => 699011,
                    'race_instance_uid' => 699011,
                    'race_datetime' => '2018-04-12 17:30:00',
                ],
            ],
            //Api\DataProvider\Bo\RaceCards\PastWinners:75 ->getPastWinners()
            '4804cb760015d6bf3d79901aeb45d412' => [
                [
                    'race_datetime' => '2018-04-12 17:30:00',
                    'race_instance_uid' => 699011,
                    'lst_yr_race_instance_uid' => 672394,
                    'weight_carried_lbs' => 160,
                    'rp_postmark' => null,
                    'weight_allowance_lbs' => 0,
                    'draw' => null,
                    'odds_desc' => '7/4F',
                    'horse_style_name' => 'Balliniska Band',
                    'country_origin_code' => 'IRE',
                    'horse_id' => 1825555,
                    'age' => 4,
                    'trainer_style_name' => 'C Byrnes',
                    'trainer_uid' => 8910,
                    'jockey_style_name' => 'Mr P W Mullins',
                    'jockey_uid' => 85115,
                    'course_uid' => 188,
                    'course_name' => 'LIMERICK',
                ],
                [
                    'race_datetime' => '2017-04-06 17:30:00',
                    'race_instance_uid' => 672394,
                    'lst_yr_race_instance_uid' => 647457,
                    'weight_carried_lbs' => 160,
                    'rp_postmark' => 125,
                    'weight_allowance_lbs' => 0,
                    'draw' => null,
                    'odds_desc' => '4/5F',
                    'horse_style_name' => 'Debuchet',
                    'country_origin_code' => 'FR',
                    'horse_id' => 1293150,
                    'age' => 4,
                    'trainer_style_name' => 'Ms Margaret Mullins',
                    'trainer_uid' => 15775,
                    'jockey_style_name' => 'Mr P W Mullins',
                    'jockey_uid' => 85115,
                    'course_uid' => 188,
                    'course_name' => 'LIMERICK',
                ],
                [
                    'race_datetime' => '2016-04-03 17:20:00',
                    'race_instance_uid' => 647457,
                    'lst_yr_race_instance_uid' => 622133,
                    'weight_carried_lbs' => 160,
                    'rp_postmark' => 128,
                    'weight_allowance_lbs' => 0,
                    'draw' => null,
                    'odds_desc' => '4/6F',
                    'horse_style_name' => 'Without Limites',
                    'country_origin_code' => 'FR',
                    'horse_id' => 928577,
                    'age' => 4,
                    'trainer_style_name' => 'Miss Elizabeth Doyle',
                    'trainer_uid' => 14075,
                    'jockey_style_name' => 'Mr Finian Maguire',
                    'jockey_uid' => 96848,
                    'course_uid' => 188,
                    'course_name' => 'LIMERICK',
                ],
                [
                    'race_datetime' => '2015-03-29 17:40:00',
                    'race_instance_uid' => 622133,
                    'lst_yr_race_instance_uid' => 598665,
                    'weight_carried_lbs' => 160,
                    'rp_postmark' => 124,
                    'weight_allowance_lbs' => 0,
                    'draw' => null,
                    'odds_desc' => '8/15F',
                    'horse_style_name' => 'Charbel',
                    'country_origin_code' => 'IRE',
                    'horse_id' => 880428,
                    'age' => 4,
                    'trainer_style_name' => 'Thomas Mullins',
                    'trainer_uid' => 16319,
                    'jockey_style_name' => 'Mr P W Mullins',
                    'jockey_uid' => 85115,
                    'course_uid' => 188,
                    'course_name' => 'LIMERICK',
                ],
                [
                    'race_datetime' => '2014-03-30 17:35:00',
                    'race_instance_uid' => 598665,
                    'lst_yr_race_instance_uid' => 576136,
                    'weight_carried_lbs' => 160,
                    'rp_postmark' => 122,
                    'weight_allowance_lbs' => 0,
                    'draw' => null,
                    'odds_desc' => '7/4F',
                    'horse_style_name' => 'Aminabad',
                    'country_origin_code' => 'FR',
                    'horse_id' => 853438,
                    'age' => 4,
                    'trainer_style_name' => 'W P Mullins',
                    'trainer_uid' => 1475,
                    'jockey_style_name' => 'Mr P W Mullins',
                    'jockey_uid' => 85115,
                    'course_uid' => 188,
                    'course_name' => 'LIMERICK',
                ],
                [
                    'race_datetime' => '2013-04-07 17:35:00',
                    'race_instance_uid' => 576136,
                    'lst_yr_race_instance_uid' => 551454,
                    'weight_carried_lbs' => 156,
                    'rp_postmark' => 120,
                    'weight_allowance_lbs' => 0,
                    'draw' => null,
                    'odds_desc' => '5/1',
                    'horse_style_name' => 'Private Treasure',
                    'country_origin_code' => 'IRE',
                    'horse_id' => 773204,
                    'age' => 4,
                    'trainer_style_name' => 'Paul Nolan',
                    'trainer_uid' => 9647,
                    'jockey_style_name' => 'Mr Josh Halley',
                    'jockey_uid' => 88091,
                    'course_uid' => 188,
                    'course_name' => 'LIMERICK',
                ],
                [
                    'race_datetime' => '2012-04-01 17:20:00',
                    'race_instance_uid' => 551454,
                    'lst_yr_race_instance_uid' => 527968,
                    'weight_carried_lbs' => 153,
                    'rp_postmark' => 114,
                    'weight_allowance_lbs' => 0,
                    'draw' => null,
                    'odds_desc' => '5/2F',
                    'horse_style_name' => 'Summer Star',
                    'country_origin_code' => 'IRE',
                    'horse_id' => 804072,
                    'age' => 4,
                    'trainer_style_name' => 'T M Walsh',
                    'trainer_uid' => 5212,
                    'jockey_style_name' => 'Ms K Walsh',
                    'jockey_uid' => 80339,
                    'course_uid' => 188,
                    'course_name' => 'LIMERICK',
                ],
                [
                    'race_datetime' => '2011-04-03 17:15:00',
                    'race_instance_uid' => 527968,
                    'lst_yr_race_instance_uid' => 503933,
                    'weight_carried_lbs' => 163,
                    'rp_postmark' => 127,
                    'weight_allowance_lbs' => 0,
                    'draw' => null,
                    'odds_desc' => '4/7F',
                    'horse_style_name' => 'Waaheb',
                    'country_origin_code' => 'USA',
                    'horse_id' => 774498,
                    'age' => 4,
                    'trainer_style_name' => 'D K Weld',
                    'trainer_uid' => 1010,
                    'jockey_style_name' => 'Robbie McNamara',
                    'jockey_uid' => 83699,
                    'course_uid' => 188,
                    'course_name' => 'LIMERICK',
                ],
                [
                    'race_datetime' => '2010-04-11 16:55:00',
                    'race_instance_uid' => 503933,
                    'lst_yr_race_instance_uid' => 479331,
                    'weight_carried_lbs' => 160,
                    'rp_postmark' => 123,
                    'weight_allowance_lbs' => 0,
                    'draw' => null,
                    'odds_desc' => '4/5F',
                    'horse_style_name' => 'Hidden Universe',
                    'country_origin_code' => 'IRE',
                    'horse_id' => 749250,
                    'age' => 4,
                    'trainer_style_name' => 'D K Weld',
                    'trainer_uid' => 1010,
                    'jockey_style_name' => 'Robbie McNamara',
                    'jockey_uid' => 83699,
                    'course_uid' => 188,
                    'course_name' => 'LIMERICK',
                ],
                [
                    'race_datetime' => '2009-04-05 17:05:00',
                    'race_instance_uid' => 479331,
                    'lst_yr_race_instance_uid' => 454413,
                    'weight_carried_lbs' => 160,
                    'rp_postmark' => 115,
                    'weight_allowance_lbs' => 3,
                    'draw' => null,
                    'odds_desc' => '5/4F',
                    'horse_style_name' => 'Universal Truth',
                    'country_origin_code' => 'IRE',
                    'horse_id' => 704229,
                    'age' => 4,
                    'trainer_style_name' => 'D K Weld',
                    'trainer_uid' => 1010,
                    'jockey_style_name' => 'Robbie McNamara',
                    'jockey_uid' => 83699,
                    'course_uid' => 188,
                    'course_name' => 'LIMERICK',
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
