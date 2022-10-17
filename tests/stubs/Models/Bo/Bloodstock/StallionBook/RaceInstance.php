<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 5/18/2016
 * Time: 12:32 AM
 */

namespace Tests\Stubs\Models\Bo\Bloodstock\StallionBook;

class RaceInstance extends \Tests\Stubs\Models\RaceInstance
{
    use \Tests\Stubs\Models\StubDataGetter;
    /**
     * @param \Api\Input\Request\Horses\Bloodstock\StallionBook\Index $request
     * @param null                                                    $selectors
     *
     * @return array
     */
    public function getSearchResult($request, $selectors = null)
    {
        $data = [
            'inactive_Galileo' => [
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 862404,
                        'style_name' => 'Absolute Galileo',
                        'country_origin_code' => 'IRE',
                        'sire_uid' => 531769,
                        'sire_style_name' => 'Galileo',
                        'sire_line_uid' => 463975,
                        'sire_line_style_name' => 'Sadler\'s Wells',
                        'stud_name' => null,
                        'stud_country_code' => null,
                        'stud_fee' => null,
                        'year_to_stud' => null,
                        'stud_fee_condition' => null,
                        'fee_cur_code' => null,
                        'exchange_rate' => null,
                        'weatherbys_uid' => null,
                        'private_flag' => 0,
                    ]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 16975,
                        'style_name' => 'El Galileo',
                        'country_origin_code' => 'GB',
                        'sire_uid' => 300488,
                        'sire_style_name' => 'Comedy Star',
                        'sire_line_uid' => 907129,
                        'sire_line_style_name' => 'Tom Fool',
                        'stud_name' => null,
                        'stud_country_code' => null,
                        'stud_fee' => null,
                        'year_to_stud' => null,
                        'stud_fee_condition' => null,
                        'fee_cur_code' => null,
                        'exchange_rate' => null,
                        'weatherbys_uid' => null,
                        'private_flag' => 0,
                    ]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 873770,
                        'style_name' => 'Energia Galileo',
                        'country_origin_code' => 'BRZ',
                        'sire_uid' => 554106,
                        'sire_style_name' => 'Agnes Gold',
                        'sire_line_uid' => 465637,
                        'sire_line_style_name' => 'Sunday Silence',
                        'stud_name' => null,
                        'stud_country_code' => null,
                        'stud_fee' => null,
                        'year_to_stud' => null,
                        'stud_fee_condition' => null,
                        'fee_cur_code' => null,
                        'exchange_rate' => null,
                        'weatherbys_uid' => null,
                        'private_flag' => 0,
                    ]
                ),
            ],
            'weatherbys_Warning' => [
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 84442,
                        'style_name' => 'Piccolo',
                        'country_origin_code' => 'GB',
                        'sire_uid' => 9284,
                        'sire_style_name' => 'Warning',
                        'sire_line_uid' => 301285,
                        'sire_line_style_name' => 'Known Fact',
                        'stud_name' => null,
                        'stud_country_code' => null,
                        'stud_fee' => 3500,
                        'year_to_stud' => 1996,
                        'stud_fee_condition' => null,
                        'fee_cur_code' => 'GBP',
                        'exchange_rate' => null,
                        'weatherbys_uid' => 2626,
                        'private_flag' => 0,
                    ]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 84442,
                        'style_name' => 'Piccolo',
                        'country_origin_code' => 'GB',
                        'sire_uid' => 9284,
                        'sire_style_name' => 'Warning',
                        'sire_line_uid' => 301285,
                        'sire_line_style_name' => 'Known Fact',
                        'stud_name' => null,
                        'stud_country_code' => null,
                        'stud_fee' => 3500,
                        'year_to_stud' => 1997,
                        'stud_fee_condition' => null,
                        'fee_cur_code' => 'GBP',
                        'exchange_rate' => null,
                        'weatherbys_uid' => 2626,
                        'private_flag' => 0,
                    ]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 84442,
                        'style_name' => 'Piccolo',
                        'country_origin_code' => 'GB',
                        'sire_uid' => 9284,
                        'sire_style_name' => 'Warning',
                        'sire_line_uid' => 301285,
                        'sire_line_style_name' => 'Known Fact',
                        'stud_name' => null,
                        'stud_country_code' => null,
                        'stud_fee' => 3500,
                        'year_to_stud' => 1998,
                        'stud_fee_condition' => null,
                        'fee_cur_code' => 'GBP',
                        'exchange_rate' => null,
                        'weatherbys_uid' => 2626,
                        'private_flag' => 0,
                    ]
                ),
            ],
            'weatherbys_Piccolo_Warning_include_GB_Lavington_2002_1500_5000' => [
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 84442,
                        'style_name' => 'Piccolo',
                        'country_origin_code' => 'GB',
                        'sire_uid' => 9284,
                        'sire_style_name' => 'Warning',
                        'sire_line_uid' => 301285,
                        'sire_line_style_name' => 'Known Fact',
                        'stud_name' => 'Lavington Stud',
                        'stud_country_code' => 'GB',
                        'stud_fee' => 4000,
                        'year_to_stud' => 2002,
                        'stud_fee_condition' => null,
                        'fee_cur_code' => 'GBP',
                        'exchange_rate' => 1,
                        'weatherbys_uid' => 2626,
                        'private_flag' => 0,
                    ]
                ),
            ],
            'weatherbys_Piccolo_secondCrop' => [
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 84442,
                        'style_name' => 'Piccolo',
                        'country_origin_code' => 'GB',
                        'sire_uid' => 9284,
                        'sire_style_name' => 'Warning',
                        'sire_line_uid' => 301285,
                        'sire_line_style_name' => 'Known Fact',
                        'stud_name' => null,
                        'stud_country_code' => null,
                        'stud_fee' => 3500,
                        'year_to_stud' => 1997,
                        'stud_fee_condition' => null,
                        'fee_cur_code' => 'GBP',
                        'exchange_rate' => null,
                        'weatherbys_uid' => 2626,
                        'private_flag' => 0,
                    ]
                ),
            ],
            'weatherbys_farm_1m6f-1m7f' => [
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 503150,
                        'style_name' => 'Lemon Drop Kid',
                        'country_origin_code' => 'USA',
                        'sire_uid' => 79045,
                        'sire_style_name' => 'Kingmambo',
                        'sire_line_uid' => 301599,
                        'sire_line_style_name' => 'Mr Prospector',
                        'stud_name' => 'Lane\'s End Farm, Kentucky',
                        'stud_country_code' => 'USA',
                        'stud_fee' => 75000,
                        'year_to_stud' => 2002,
                        'stud_fee_condition' => null,
                        'fee_cur_code' => 'USD',
                        'exchange_rate' => 1.47,
                        'weatherbys_uid' => 2322,
                        'private_flag' => 0,
                    ]
                ),
            ],
            'weatherbys_1_1_1_1' => [
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 84442,
                        'style_name' => 'Piccolo',
                        'country_origin_code' => 'GB',
                        'sire_uid' => 9284,
                        'sire_style_name' => 'Warning',
                        'sire_line_uid' => 301285,
                        'sire_line_style_name' => 'Known Fact',
                        'stud_name' => null,
                        'stud_country_code' => null,
                        'stud_fee' => 3500,
                        'year_to_stud' => 1996,
                        'stud_fee_condition' => null,
                        'fee_cur_code' => 'GBP',
                        'exchange_rate' => null,
                        'weatherbys_uid' => 2626,
                        'private_flag' => 0,
                    ]
                ),
            ],
            'weatherbys_farm_USA_1_1_1' => [
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 476627,
                        'style_name' => 'Distorted Humor',
                        'country_origin_code' => 'USA',
                        'sire_uid' => 304434,
                        'sire_style_name' => 'Forty Niner',
                        'sire_line_uid' => 301599,
                        'sire_line_style_name' => 'Mr Prospector',
                        'stud_name' => 'WinStar Farm, Kentucky',
                        'stud_country_code' => 'USA',
                        'stud_fee' => 50000,
                        'year_to_stud' => 2004,
                        'stud_fee_condition' => null,
                        'fee_cur_code' => 'USD',
                        'exchange_rate' => 1.47,
                        'weatherbys_uid' => 2312,
                        'private_flag' => 0,
                    ]
                ),
            ],
            'weatherbys_farm_GB_1' => [
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 601396,
                        'style_name' => 'Malinas',
                        'country_origin_code' => 'GER',
                        'sire_uid' => 68106,
                        'sire_style_name' => 'Lomitas',
                        'sire_line_uid' => 301671,
                        'sire_line_style_name' => 'Niniski',
                        'stud_name' => 'Yorton Farm Stud',
                        'stud_country_code' => 'GB',
                        'stud_fee' => 2000,
                        'year_to_stud' => 2012,
                        'stud_fee_condition' => null,
                        'fee_cur_code' => 'GBP',
                        'exchange_rate' => 1,
                        'weatherbys_uid' => 2396,
                        'private_flag' => 0,
                    ]
                ),
            ],
            'weatherbys_IRE_1' => [
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 96595,
                        'style_name' => 'Presenting',
                        'country_origin_code' => 'GB',
                        'sire_uid' => 16491,
                        'sire_style_name' => 'Mtoto',
                        'sire_line_uid' => 300359,
                        'sire_line_style_name' => 'Busted',
                        'stud_name' => 'Rathbarry Stud',
                        'stud_country_code' => 'IRE',
                        'stud_fee' => 0,
                        'year_to_stud' => 2002,
                        'stud_fee_condition' => 'poa',
                        'fee_cur_code' => 'EUR',
                        'exchange_rate' => null,
                        'weatherbys_uid' => 2305,
                        'private_flag' => 1,
                    ]
                ),
            ],
            'active' => [
                0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 712158,
                        'style_name' => 'Milanais',
                        'country_origin_code' => 'FR',
                        'sire_uid' => 449934,
                        'sire_style_name' => 'Dyhim Diamond',
                        'sire_line_uid' => 301663,
                        'sire_line_style_name' => 'Night Shift',
                        'stud_name' => 'Haras de Lonray',
                        'stud_country_code' => 'FR',
                        'stud_fee' => 2500,
                        'year_to_stud' => 2014,
                        'stud_fee_condition' => null,
                        'fee_cur_code' => 'EUR',
                        'exchange_rate' => 1.3600000000000001,
                        'weatherbys_uid' => null,
                        'private_flag' => 0,
                    ]
                ),
                1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 657920,
                        'style_name' => 'Cockney Rebel',
                        'country_origin_code' => 'IRE',
                        'sire_uid' => 504445,
                        'sire_style_name' => 'Val Royal',
                        'sire_line_uid' => 49087,
                        'sire_line_style_name' => 'Royal Academy',
                        'stud_name' => 'Haras Du Thenney',
                        'stud_country_code' => 'FR',
                        'stud_fee' => 3000,
                        'year_to_stud' => 2008,
                        'stud_fee_condition' => null,
                        'fee_cur_code' => 'EUR',
                        'exchange_rate' => 1.3600000000000001,
                        'weatherbys_uid' => 2410,
                        'private_flag' => 0,
                    ]
                ),
                2 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 602597,
                        'style_name' => 'Walk In The Park',
                        'country_origin_code' => 'IRE',
                        'sire_uid' => 503034,
                        'sire_style_name' => 'Montjeu',
                        'sire_line_uid' => 463975,
                        'sire_line_style_name' => 'Sadler\'s Wells',
                        'stud_name' => 'Grange Stud (IRE)',
                        'stud_country_code' => 'IRE',
                        'stud_fee' => 0,
                        'year_to_stud' => 2008,
                        'stud_fee_condition' => 'Private',
                        'fee_cur_code' => 'EUR',
                        'exchange_rate' => 1.3600000000000001,
                        'weatherbys_uid' => null,
                        'private_flag' => 1,
                    ]
                ),
                3 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 541314,
                        'style_name' => 'Acclamation',
                        'country_origin_code' => 'GB',
                        'sire_uid' => 103416,
                        'sire_style_name' => 'Royal Applause',
                        'sire_line_uid' => 3181,
                        'sire_line_style_name' => 'Waajib',
                        'stud_name' => 'Rathbarry Stud',
                        'stud_country_code' => 'IRE',
                        'stud_fee' => 30000,
                        'year_to_stud' => 2004,
                        'stud_fee_condition' => null,
                        'fee_cur_code' => 'EUR',
                        'exchange_rate' => 1.3600000000000001,
                        'weatherbys_uid' => 2331,
                        'private_flag' => 0,
                    ]
                ),
                4 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 723341,
                        'style_name' => 'Air Chief Marshal',
                        'country_origin_code' => 'IRE',
                        'sire_uid' => 104011,
                        'sire_style_name' => 'Danehill Dancer',
                        'sire_line_uid' => 42373,
                        'sire_line_style_name' => 'Danehill',
                        'stud_name' => 'Haras De La Cauviniere',
                        'stud_country_code' => 'FR',
                        'stud_fee' => 5000,
                        'year_to_stud' => 2011,
                        'stud_fee_condition' => null,
                        'fee_cur_code' => 'EUR',
                        'exchange_rate' => 1.3600000000000001,
                        'weatherbys_uid' => 2480,
                        'private_flag' => 0,
                    ]
                ),
            ],
        ];
        $key = self::getRequestKey($request);
        return $data[$key];
    }
}
