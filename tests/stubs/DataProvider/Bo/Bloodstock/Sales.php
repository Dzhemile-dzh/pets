<?php

namespace Tests\Stubs\DataProvider\Bo\Bloodstock;

use Api\Input\Request\Horses\Bloodstock\Sales as Request;
use Phalcon\Mvc\Model\Row\General;

/**
 * Class Sales
 *
 * @package Tests\Stubs\DataProvider\Bo\Bloodstock
 */
class Sales extends \Api\DataProvider\Bo\Bloodstock\Sales
{
    /**
     * @param Request\UpcomingNames $request
     *
     * @return array
     */
    public function getUpcomingNames(Request\UpcomingNames $request)
    {
        return [
            0 => General::createFromArray(
                [
                    'horse_name' => 'Valley Of Fire',
                    'horse_uid' => 864723,
                    'sire_uid' => 543708,
                    'sire_name' => 'Firebreak',
                    'dam_uid' => 406454,
                    'dam_name' => 'Charlie Girl',
                    'damsire_uid' => 44767,
                    'damsire_name' => 'Puissance',
                    'vendor_name' => 'From Somerville Lodge Ltd. (W. Haggas)',
                ]
            ),
            1 => General::createFromArray(
                [
                    'horse_name' => 'Kummiya',
                    'horse_uid' => 901817,
                    'sire_uid' => 503875,
                    'sire_name' => 'Dansili',
                    'dam_uid' => 480768,
                    'dam_name' => 'Balisada',
                    'damsire_uid' => 301292,
                    'damsire_name' => 'Kris',
                    'vendor_name' => 'From Beckhampton House Stables (R. Charlton)',
                ]
            ),
            2 => General::createFromArray(
                [
                    'horse_name' => 'Al Khan',
                    'horse_uid' => 779044,
                    'sire_uid' => 449518,
                    'sire_name' => 'Elnadim',
                    'dam_uid' => 661134,
                    'dam_name' => 'Popolo',
                    'damsire_uid' => 511443,
                    'damsire_name' => 'Fasliyev',
                    'vendor_name' => 'From Hambleton Lodge Stables (K. Ryan)',
                ]
            ),
            3 => General::createFromArray(
                [
                    'horse_name' => 'Mustaqqil',
                    'horse_uid' => 850934,
                    'sire_uid' => 506927,
                    'sire_name' => 'Invincible Spirit',
                    'dam_uid' => 660449,
                    'dam_name' => 'Cast In Gold',
                    'damsire_uid' => 466191,
                    'damsire_name' => 'Elusive Quality',
                    'vendor_name' => 'From David O\'Meara Racing Ltd.',
                ]
            ),
            4 => General::createFromArray(
                [
                    'horse_name' => 'Sky Ship',
                    'horse_uid' => 898215,
                    'sire_uid' => 682732,
                    'sire_name' => 'Raven\'s Pass',
                    'dam_uid' => 599619,
                    'dam_name' => 'Angara',
                    'damsire_uid' => 300057,
                    'damsire_name' => 'Alzao',
                    'vendor_name' => 'From Freemason Lodge Stables (Sir M. Stoute)',
                ]
            ),
            5 => General::createFromArray(
                [
                    'horse_name' => 'Sukiwarrior',
                    'horse_uid' => 923935,
                    'sire_uid' => 779232,
                    'sire_name' => 'Power',
                    'dam_uid' => 592072,
                    'dam_name' => 'Umniya',
                    'damsire_uid' => 304230,
                    'damsire_name' => 'Bluebird',
                    'vendor_name' => 'From Faringdon Place Stables (C. Hills)',
                ]
            ),
            6 => General::createFromArray(
                [
                    'horse_name' => 'Vive Ma Fille',
                    'horse_uid' => 871829,
                    'sire_uid' => 569100,
                    'sire_name' => 'Doyen',
                    'dam_uid' => 657014,
                    'dam_name' => 'Vive Madame',
                    'damsire_uid' => 22027,
                    'damsire_name' => 'Big Shuffle',
                    'vendor_name' => 'From Kingsley House Stables (M. Johnston)',
                ]
            ),
            7 => General::createFromArray(
                [
                    'horse_name' => 'Iona Island',
                    'horse_uid' => 878545,
                    'sire_uid' => 659772,
                    'sire_name' => 'Dutch Art',
                    'dam_uid' => 802722,
                    'dam_name' => 'Still Small Voice',
                    'damsire_uid' => 47437,
                    'damsire_name' => 'Polish Precedent',
                    'vendor_name' => 'From Faringdon Place Stables (C. Hills)',
                ]
            ),
            8 => General::createFromArray(
                [
                    'horse_name' => 'Trooper\'s Gold',
                    'horse_uid' => 998323,
                    'sire_uid' => 777155,
                    'sire_name' => 'Sepoy',
                    'dam_uid' => 682398,
                    'dam_name' => 'Samira Gold',
                    'damsire_uid' => 472998,
                    'damsire_name' => 'Gold Away',
                    'vendor_name' => 'From Hambleton Lodge Stables (K. Ryan)',
                ]
            ),
            9 => General::createFromArray(
                [
                    'horse_name' => 'Fields Of Song',
                    'horse_uid' => 1043208,
                    'sire_uid' => 784836,
                    'sire_name' => 'Harbour Watch',
                    'dam_uid' => 874862,
                    'dam_name' => 'Singing Field',
                    'damsire_uid' => 97591,
                    'damsire_name' => 'Singspiel',
                    'vendor_name' => 'From Hambleton Lodge Stables (K. Ryan)',
                ]
            ),
            10 => General::createFromArray(
                [
                    'horse_name' => 'Shannah Bint Eric',
                    'horse_uid' => 929321,
                    'sire_uid' => 737744,
                    'sire_name' => 'Poet\'s Voice',
                    'dam_uid' => 844312,
                    'dam_name' => 'Crystal Mountain',
                    'damsire_uid' => 513083,
                    'damsire_name' => 'Monashee Mountain',
                    'vendor_name' => 'From Hambleton Lodge Stables (K. Ryan)',
                ]
            ),
            11 => General::createFromArray(
                [
                    'horse_name' => 'New Signal',
                    'horse_uid' => 1093589,
                    'sire_uid' => 670119,
                    'sire_name' => 'New Approach',
                    'dam_uid' => 569938,
                    'dam_name' => 'Davie\'s Lure',
                    'damsire_uid' => 80836,
                    'damsire_name' => 'Lure',
                    'vendor_name' => 'From David O\'Meara Racing Ltd.',
                ]
            ),
            12 => General::createFromArray(
                [
                    'horse_name' => 'Intisaab',
                    'horse_uid' => 858061,
                    'sire_uid' => 449518,
                    'sire_name' => 'Elnadim',
                    'dam_uid' => 714696,
                    'dam_name' => 'Katoom',
                    'damsire_uid' => 21738,
                    'damsire_name' => 'Soviet Star',
                    'vendor_name' => 'From David O\'Meara Racing Ltd.',
                ]
            ),
            13 => General::createFromArray(
                [
                    'horse_name' => 'That Is The Spirit',
                    'horse_uid' => 857203,
                    'sire_uid' => 506927,
                    'sire_name' => 'Invincible Spirit',
                    'dam_uid' => 550549,
                    'dam_name' => 'Fraulein',
                    'damsire_uid' => 304736,
                    'damsire_name' => 'Acatenango',
                    'vendor_name' => 'From David O\'Meara Racing Ltd.',
                ]
            ),
            14 => General::createFromArray(
                [
                    'horse_name' => 'Taraz',
                    'horse_uid' => 867873,
                    'sire_uid' => 565797,
                    'sire_name' => 'Oasis Dream',
                    'dam_uid' => 709742,
                    'dam_name' => 'Tamarind',
                    'damsire_uid' => 463975,
                    'damsire_name' => 'Sadler\'s Wells',
                    'vendor_name' => 'From David O\'Meara Racing Ltd.',
                ]
            ),
            15 => General::createFromArray(
                [
                    'horse_name' => 'Lawless Louis',
                    'horse_uid' => 997245,
                    'sire_uid' => 692355,
                    'sire_name' => 'Equiano',
                    'dam_uid' => 635408,
                    'dam_name' => 'Peace And Love',
                    'damsire_uid' => 480438,
                    'damsire_name' => 'Fantastic Light',
                    'vendor_name' => 'From David O\'Meara Racing Ltd.',
                ]
            ),
            16 => General::createFromArray(
                [
                    'horse_name' => 'Hoofalong',
                    'horse_uid' => 812037,
                    'sire_uid' => 576872,
                    'sire_name' => 'Pastoral Pursuits',
                    'dam_uid' => 598979,
                    'dam_name' => 'Baymist',
                    'damsire_uid' => 92491,
                    'damsire_name' => 'Mind Games',
                    'vendor_name' => 'to Dissolve a Partnership from Flaxton Stables (M. Easterby)',
                ]
            ),
            17 => General::createFromArray(
                [
                    'horse_name' => 'Slingsby',
                    'horse_uid' => 844388,
                    'sire_uid' => 659772,
                    'sire_name' => 'Dutch Art',
                    'dam_uid' => 553902,
                    'dam_name' => 'Ballet Fame',
                    'damsire_uid' => 54189,
                    'damsire_name' => 'Quest For Fame',
                    'vendor_name' => 'to Dissolve a Partnership from Flaxton Stables (M. Easterby)',
                ]
            ),
            18 => General::createFromArray(
                [
                    'horse_name' => 'Felix De Vega',
                    'horse_uid' => 867276,
                    'sire_uid' => 740981,
                    'sire_name' => 'Lope De Vega',
                    'dam_uid' => 502288,
                    'dam_name' => 'Lafite',
                    'damsire_uid' => 302068,
                    'damsire_name' => 'Robellino',
                    'vendor_name' => 'to Dissolve a Partnership from Flaxton Stables (M. Easterby)',
                ]
            ),
            19 => General::createFromArray(
                [
                    'horse_name' => 'Heart Locket',
                    'horse_uid' => 870013,
                    'sire_uid' => 647498,
                    'sire_name' => 'Champs Elysees',
                    'dam_uid' => 483470,
                    'dam_name' => 'Zante',
                    'damsire_uid' => 75918,
                    'damsire_name' => 'Zafonic',
                    'vendor_name' => 'to Dissolve a Partnership from Flaxton Stables (M. Easterby)',
                ]
            ),
        ];
    }

    /**
     * @param Request\SalesResults $request
     *
     * @return array|mixed
     */
    public function getSalesResults(Request\SalesResults $request)
    {
        $key = $this->getKey($request);

        $data = [
            '2017-12-10_2017-12-12___Euro_Withdrawn________Arc' => [
                0 => General::createFromArray([
                    'horse_uid' => 1536543,
                    'horse_name' => 'SHADOW SEEKER',
                    'horse_style_name' => 'Shadow Seeker',
                    'dam_date_of_birth' => 'Feb 17 2007 12:00AM',
                    'dam_style_name' => 'New Atalanta',
                    'sire_style_name' => 'Arcano',
                    'sire_of_dam_style_name' => 'Xaar',
                    'horse_country_origin_code' => 'IRE',
                    'horse_first_colour_code' => 'B',
                    'horse_sex' => 'F',
                    'horse_age' => 2,
                    'sire_uid' => 733706,
                    'sire_name' => 'ARCANO',
                    'sire_country_origin_code' => 'IRE',
                    'dam_uid' => 744512,
                    'dam_name' => 'NEW ATALANTA',
                    'dam_country_origin_code' => 'IRE',
                    'sire_of_dam_uid' => 469953,
                    'sire_of_dam_name' => 'XAAR',
                    'sire_of_dam_ctry_org_code' => 'GB',
                    'venue_desc' => 'TATTS IRE (ASCOT)',
                    'venue_uid' => 49,
                    'sale_name' => 'Tattersalls Ireland Ascot December Sale 2017',
                    'sale_date' => 'Dec 11 2017 12:00AM',
                    'seller_name' => 'A Partnership from Charnwood Stables (P. D\'Arcy)',
                    'catalogue_pedigree_pdf_url' => 'http://www.tattersalls.com/cat/ADE/2017/26.pdf',
                    'lot_no' => 26,
                    'lot_letter' => ' ',
                    'price' => null,
                    'lot_price' => null,
                    'currency' => 'GBP',
                    'buyer_detail' => 'Withdrawn',
                    'yob' => 2015,
                    'sirecam_video_html' => null,
                    'entered' => 'Y',
                    'entered_races' => null
                ]),
                1 => General::createFromArray([
                    'horse_uid' => 686374,
                    'horse_name' => 'CALL ME KITTY',
                    'horse_style_name' => 'Call Me Kitty',
                    'dam_date_of_birth' => 'Jan  1 1995 12:00AM',
                    'dam_style_name' => 'Fifty Niner',
                    'sire_style_name' => 'Marchand De Sable',
                    'sire_of_dam_style_name' => 'Fijar Tango',
                    'horse_country_origin_code' => 'FR',
                    'horse_first_colour_code' => 'B',
                    'horse_sex' => 'F',
                    'horse_age' => 12,
                    'sire_uid' => 79104,
                    'sire_name' => 'MARCHAND DE SABLE',
                    'sire_country_origin_code' => 'USA',
                    'dam_uid' => 471552,
                    'dam_name' => 'FIFTY NINER',
                    'dam_country_origin_code' => 'FR',
                    'sire_of_dam_uid' => 41809,
                    'sire_of_dam_name' => 'FIJAR TANGO',
                    'sire_of_dam_ctry_org_code' => 'FR',
                    'venue_desc' => 'ARQANA',
                    'venue_uid' => 36,
                    'sale_name' => 'Arqana December Breeding Stock Sale 2017',
                    'sale_date' => 'Dec 11 2017 12:00AM',
                    'seller_name' => 'From Petit Tellier',
                    'catalogue_pedigree_pdf_url' => 'http://www.arqana.com/upload/pedigrees/vente229/fra/781.pdf',
                    'lot_no' => 781,
                    'lot_letter' => ' ',
                    'price' => 3000,
                    'lot_price' => '2564.102564102564102',
                    'currency' => 'EUR',
                    'buyer_detail' => 'COLE Daniel',
                    'yob' => 2005,
                    'sirecam_video_html' => null,
                    'entered' => 'N',
                    'entered_races' => null,
                ]),
                2 => General::createFromArray([
                    'horse_uid' => null,
                    'horse_name' => null,
                    'horse_style_name' => null,
                    'dam_date_of_birth' => null,
                    'dam_style_name' => null,
                    'sire_style_name' => 'Archipenko',
                    'sire_of_dam_style_name' => null,
                    'horse_country_origin_code' => 'FR',
                    'horse_first_colour_code' => 'B',
                    'horse_sex' => 'C',
                    'horse_age' => 0,
                    'sire_uid' => 660521,
                    'sire_name' => 'ARCHIPENKO',
                    'sire_country_origin_code' => 'USA',
                    'dam_uid' => null,
                    'dam_name' => 'SOL Y SOMBRA',
                    'dam_country_origin_code' => 'GB',
                    'sire_of_dam_uid' => null,
                    'sire_of_dam_name' => 'HERNANDO',
                    'sire_of_dam_ctry_org_code' => 'FR',
                    'venue_desc' => 'ARQANA',
                    'venue_uid' => 36,
                    'sale_name' => 'Arqana December Breeding Stock Sale 2017',
                    'sale_date' => 'Dec 11 2017 12:00AM',
                    'seller_name' => 'From Etreham',
                    'catalogue_pedigree_pdf_url' => 'http://www.arqana.com/upload/pedigrees/vente229/fra/656.pdf',
                    'lot_no' => 656,
                    'lot_letter' => ' ',
                    'price' => 7000,
                    'lot_price' => '5982.905982905982905',
                    'currency' => 'EUR',
                    'buyer_detail' => 'FAL STUD',
                    'yob' => 2017,
                    'sirecam_video_html' => null,
                    'entered' => 'N',
                    'entered_races' => null,
                ]),
            ]
        ];

        return $data[$key];
    }

    /**
     * @param $horsesIds
     *
     * @return array
     */
    public function getEnteredRaces($horsesIds)
    {
        $key = implode('_', $horsesIds);
        $data = [
            '1536543' => [
                1536543 => [
                    0 => General::createFromArray([
                        'horse_uid' => 1536543,
                        'race_instance_uid' => 689902,
                    ]),
                ],
            ]

        ];
        return $data[$key];
    }

    /**
     * @param Request\SalesResults $request
     *
     * @return string
     */
    private function getKey(Request\SalesResults $request)
    {
        $key = trim(
            implode(
                '_',
                array_map(
                    function ($param) {
                        return $param->getValue();
                    },
                    $request->getParameters()
                )
            ),
            '_'
        );
        return $key;
    }

    /**
     * @param Request\UpcomingSales $request
     *
     * @return array
     */
    public function getUpcomingSales(Request\UpcomingSales $request)
    {
        return [
            0 => General::createFromArray([
                'horse_uid' => 890346,
                'horse_name' => 'ZIG ZAG',
                'horse_style_name' => 'Zig Zag',
                'dam_date_of_birth' => 'Apr 11 1998 12:00AM',
                'dam_style_name' => 'Le Montrachet',
                'sire_style_name' => 'Zoffany',
                'sire_of_dam_style_name' => 'Nashwan',
                'horse_country_origin_code' => 'IRE',
                'horse_first_colour_code' => 'B',
                'horse_sex' => 'G',
                'horse_age' => 4,
                'sire_uid' => 756093,
                'sire_name' => 'ZOFFANY',
                'sire_country_origin_code' => 'IRE',
                'dam_uid' => 628647,
                'dam_name' => 'LE MONTRACHET',
                'dam_country_origin_code' => 'GB',
                'sire_of_dam_uid' => 43064,
                'sire_of_dam_name' => 'NASHWAN',
                'sire_of_dam_ctry_org_code' => 'USA',
                'venue_desc' => 'GOFFS UK (DONCASTER)',
                'venue_uid' => 44,
                'sale_name' => 'Goffs UK September Sale 2017',
                'sale_date' => 'Sep  6 2017 12:00AM',
                'seller_name' => 'From Carriganog Racing, Ireland (Joseph O\'Brien)',
                'catalogue_pedigree_pdf_url' => 'www.goffsuk.com/GoffsCMS/_Sales/146/194.pdf',
                'lot_no' => 194,
                'lot_no1' => 194,
                'lot_letter' => ' ',
                'price' => 11000,
                'buyer_detail' => 'Philip Kirby',
                'yob' => 2013,
                'sirecam_video_html' => null,
                'currency' => 'GBP',
                'entered' => false,
            ]),
        ];
    }

    /**
     * @return array
     */
    public function getUpcomingSalesEntryRacesUids()
    {
        return [
            890346 => [
                0 => General::createFromArray([
                    'horse_uid' => 890346,
                    'entry_race_uid' => 683418,
                ]),
                1 => General::createFromArray([
                    'horse_uid' => 890346,
                    'entry_race_uid' => 680419,
                ]),
                2 => General::createFromArray([
                    'horse_uid' => 890346,
                    'entry_race_uid' => 681911,
                ]),
                3 => General::createFromArray([
                    'horse_uid' => 890346,
                    'entry_race_uid' => 679704,
                ]),
                4 => General::createFromArray([
                    'horse_uid' => 890346,
                    'entry_race_uid' => 682802,
                ]),
                5 => General::createFromArray([
                    'horse_uid' => 890346,
                    'entry_race_uid' => 680844,
                ]),
                6 => General::createFromArray([
                    'horse_uid' => 890346,
                    'entry_race_uid' => 682318,
                ])
            ]
        ];
    }

    /**
     * @return array
     */
    public function getSalesCompaniesList(Request\CompanyNames $request)
    {
        return [
            0 => General::createFromArray(
                [
                    "sale_co_uid" => 43,
                    "sale_co_name" => "ADENA SPRINGS (OBS)"
                ]
            ),
            1 => General::createFromArray(
                [
                    "sale_co_uid" => 36,
                    "sale_co_name" => "ARQANA"
                ]
            ),
            2 => General::createFromArray(
                [
                    "sale_co_uid" => 25,
                    "sale_co_name" => "BADEN-BADEN"
                ]
            ),
            3 => General::createFromArray(
                [
                    "sale_co_uid" => 31,
                    "sale_co_name" => "BARRETTS"
                ]
            ),
        ];
    }
}
