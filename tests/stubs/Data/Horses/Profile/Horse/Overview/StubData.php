<?php

namespace Tests\Stubs\Data\Horses\Profile\Horse\Overview;

use UnitTestsComponents\Stubs\StubDataInterface;

/**
 * Class StubData
 *
 * @package Tests\Stubs\Data\Horses\Profile\Horse\Overview
 */
class StubData implements StubDataInterface
{
    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Models\Bo\HorseProfile\Horse:197 ->getHorseDataForProfile()
            '362ae9d9a46bc44616b9ce1fdcaefd8e' => [
                [
                    'horse_date_of_birth' => '2008-02-10 00:00:00',
                    'horse_date_of_death' => null,
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 604098,
                    'dam_uid' => 468622,
                    'style_name' => 'With Hindsight',
                    'horse_colour_code' => 'B',
                    'horse_sex_code' => 'G',
                    'date_gelded' => '2010-08-19 00:00:00',
                    'sire_horse_name' => 'Ad Valorem',
                    'sire_country_origin_code' => 'USA',
                    'dam_horse_name' => 'Lady From Limerick',
                    'dam_country_origin_code' => 'IRE',
                    'dam_sire_horse_name' => 'Rainbows For Life',
                    'sires_sire_uid' => 300582,
                    'sires_sire_name' => 'Danzig',
                    'avg_flat_win_dist' => null,
                    'sire_avg_flat_win_dist' => 8.3,
                    'dam_sire_avg_flat_win_dist' => 10.6,
                    'owner_name' => 'Northern Bloodstock Racing',
                    'owner_search_name' => 'NORTHERN BLOODSTOCK RACING',
                    'owner_ptp_type_code' => 'N',
                    'owner_uid' => 42771,
                    'trainer_name' => 'Steve Gollings',
                    'trainer_uid' => 7735,
                    'trainer_location' => 'Scamblesby, Lincs',
                    'trainer_search_name' => 'GOLLINGS',
                    'trainer_ptp_type_code' => 'N',
                    'breeder_name' => 'Thomas Doherty',
                    'horse_uid' => 753194,
                    'dam_sire_country_origin_code' => 'CAN',
                    'dam_status' => 0,
                    'dam_sire_uid' => 472146,
                    'sire_status' => 0,
                    'horse_sex' => 'gelding',
                    'horse_colour' => 'b',
                    'sire_comment' => null,
                    'avg_win_distance' => null,
                    'sire_avg_win_distance' => 8.33030303030303,
                    'dam_sire_avg_win_distance' => 10.617862838915471,
                    'avg_earnings_index' => null,
                    'weatherbys_uid' => null,
                    'owner_group_uid' => null,
                ],
            ],
            //Models\Bo\HorseProfile\Horse:224 ->getToFollow()
            '3ea0be320c3c2e585e6a97649ccb6501' => [
            ],
            //Models\Bo\HorseProfile\PreHorseRace:41 ->getTips()
            '86ccfc6579e5919e497b405d2a7908e9' => [
                [
                    'race_instance_uid' => 693335,
                    'newspaper_uid' => 57,
                    'naps_style' => 'The Scout',
                ],
                [
                    'race_instance_uid' => 691108,
                    'newspaper_uid' => 15,
                    'naps_style' => 'Templegate',
                ],
                [
                    'race_instance_uid' => 691108,
                    'newspaper_uid' => 2,
                    'naps_style' => 'RP Ratings',
                ],
                [
                    'race_instance_uid' => 693335,
                    'newspaper_uid' => 69,
                    'naps_style' => 'Andy Morris',
                ],
                [
                    'race_instance_uid' => 691625,
                    'newspaper_uid' => 131,
                    'naps_style' => 'Sweetspots',
                ],
                [
                    'race_instance_uid' => 693335,
                    'newspaper_uid' => 40,
                    'naps_style' => 'Garry Owen',
                ],
                [
                    'race_instance_uid' => 691625,
                    'newspaper_uid' => 57,
                    'naps_style' => 'The Scout',
                ],
            ],
            //Models\Bo\HorseProfile\PreHorseRace:93 ->getComments()
            '24a7df955fbba98d8c2555924c1aa9b7' => [
            ],
            //Models\HorseRace:313 ->getTrainerStatsLast14Days()
            '8d6281d33a7519e7a46d7aa6de5955a1' => [
                [
                    'runs' => 3,
                    'wins' => 0,
                ],
            ],
            //Models\Bo\HorseProfile\HorseRace:202 ->getPreviousTrainers()
            '7f2ace10d745f9efd0517593ba160950' => [
                [
                    'trainer_uid' => 782,
                    'trainer_change_date' => '2015-05-25 13:18:00',
                    'trainer_style_name' => 'John Spearing',
                    'search_name' => 'SPEARING',
                    'ptp_type_code' => 'N',
                ],
                [
                    'trainer_uid' => 14548,
                    'trainer_change_date' => '2014-04-04 12:54:00',
                    'trainer_style_name' => 'Alan Jones',
                    'search_name' => 'JONES',
                    'ptp_type_code' => 'N',
                ],
                [
                    'trainer_uid' => 17701,
                    'trainer_change_date' => '2013-10-11 13:01:00',
                    'trainer_style_name' => 'Peter Grayson',
                    'search_name' => 'GRAYSON',
                    'ptp_type_code' => 'N',
                ],
                [
                    'trainer_uid' => 20450,
                    'trainer_change_date' => '2013-03-06 12:51:00',
                    'trainer_style_name' => 'Michael Scudamore',
                    'search_name' => 'SCUDAMORE',
                    'ptp_type_code' => 'N',
                ],
                [
                    'trainer_uid' => 5863,
                    'trainer_change_date' => '2011-12-06 13:11:00',
                    'trainer_style_name' => 'Clive Cox',
                    'search_name' => 'COX',
                    'ptp_type_code' => 'N',
                ],
            ],
            //Models\Bo\HorseProfile\HorseRace:240 ->getPreviousOwners()
            '0ae657c8e652966c49064c31c1218c7d' => [
                [
                    'owner_uid' => 217070,
                    'owner_change_date' => '2015-05-25 13:18:00',
                    'owner_style_name' => 'G N Barot',
                    'ptp_type_code' => 'N',
                    'search_name' => 'BAROT',
                ],
                [
                    'owner_uid' => 24334,
                    'owner_change_date' => '2014-04-04 12:54:00',
                    'owner_style_name' => 'T S M S Riley-Smith',
                    'ptp_type_code' => 'N',
                    'search_name' => 'RILEYSMITH',
                ],
                [
                    'owner_uid' => 112454,
                    'owner_change_date' => '2013-10-11 13:01:00',
                    'owner_style_name' => 'E Grayson',
                    'ptp_type_code' => 'N',
                    'search_name' => 'GRAYSON',
                ],
                [
                    'owner_uid' => 8413,
                    'owner_change_date' => '2013-03-06 12:51:00',
                    'owner_style_name' => 'M Scudamore',
                    'ptp_type_code' => 'N',
                    'search_name' => 'SCUDAMORE',
                ],
                [
                    'owner_uid' => 161279,
                    'owner_change_date' => '2012-01-11 11:23:00',
                    'owner_style_name' => 'Good Breed Limited',
                    'ptp_type_code' => 'N',
                    'search_name' => 'GOOD BREED LIMITED',
                ],
            ],
            //Models\Bo\HorseProfile\Horse:297 ->getStudFee()
            '21a4d5b3eb0f7e4ab858de3a7afc41ae' => [
            ],
            //Models\Bo\HorseProfile\RaceInstance:101 ->getEntries()
            '497d2149b0b29b84b160a84a07e9b36c' => [
            ],
            //Models\Bo\HorseProfile\RaceInstance:362 ->getQuotes()
            '8987ec6a760f63ff30cdbec3df78f9b8' => [
                [
                    'horse_uid' => 753194,
                    'horse_name' => 'WITH HINDSIGHT',
                    'horse_style_name' => 'With Hindsight',
                    'country_origin_code' => 'IRE',
                    'race_id' => 639514,
                    'race_date' => '2015-12-14 15:05:00',
                    'course_uid' => 513,
                    'course_name' => 'WOLVERHAMPTON (A.W)',
                    'course_type_code' => 'X',
                    'course_style_name' => 'Wolverhampton (A.W)',
                    'distance_yard' => 3054,
                    'race_title' => '32RedSport.com Handicap (Tapeta)',
                    'going_type_code' => 'SD',
                    'rp_postmark' => 74,
                    'notes' => '\\bWith Hindsight\\p is a tough little cookie. He\'s been a different horse since we stepped him up in trip and I think he\'ll get 2m standing on his head. Luke (Morris) gave him a great ride - Steve Gollings, trainer.',
                ],
                [
                    'horse_uid' => 753194,
                    'horse_name' => 'WITH HINDSIGHT',
                    'horse_style_name' => 'With Hindsight',
                    'country_origin_code' => 'IRE',
                    'race_id' => 638661,
                    'race_date' => '2015-11-30 12:55:00',
                    'course_uid' => 513,
                    'course_name' => 'WOLVERHAMPTON (A.W)',
                    'course_type_code' => 'X',
                    'course_style_name' => 'Wolverhampton (A.W)',
                    'distance_yard' => 3054,
                    'race_title' => '32RedSport.com Handicap (For Amateur Riders) (Tapeta)',
                    'going_type_code' => 'SD',
                    'rp_postmark' => 72,
                    'notes' => '\\bWith Hindsight\\p is such a genuine horse. He\'s not very big, but you could see there he doesn\'t like horses going past him. He\'s just big enough to go hurdling, which I might do with him at some point, but he\'s doing well on the Flat at present. He\'ll stay 2m - Steve Gollings, trainer.',
                ],
                [
                    'horse_uid' => 753194,
                    'horse_name' => 'WITH HINDSIGHT',
                    'horse_style_name' => 'With Hindsight',
                    'country_origin_code' => 'IRE',
                    'race_id' => 616355,
                    'race_date' => '2015-01-20 14:00:00',
                    'course_uid' => 394,
                    'course_name' => 'SOUTHWELL (A.W)',
                    'course_type_code' => 'X',
                    'course_style_name' => 'Southwell (A.W)',
                    'distance_yard' => 1773,
                    'race_title' => 'Ladbrokes Handicap',
                    'going_type_code' => 'SD',
                    'rp_postmark' => 61,
                    'notes' => 'I always  thought I was going to get there as With Hindsight was staying on so well up the straight. The fast pace suited him - Shelley Birkett, jockey.',
                ],
            ],
            //Models\Bo\HorseProfile\RaceInstance:396 ->getStableTourQuotes()
            'e6be2d271d36ef640bf86c2693e15355' => [
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
