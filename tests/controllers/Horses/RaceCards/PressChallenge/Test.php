<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\RaceCards\PressChallenge;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * @package Tests\Controllers\Horses\RaceCards\PressChallenge
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/racecards/press-challenge';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\RaceCards\SsNatPress:82 ->getPressChallenge()
            'e5869d939952b735e168f73c9ffe8b21' => [
                [
                    'computed' => 'a',
                    'horse_name' => 'Merry Banter',
                    'country_origin_code' => 'GB',
                    'horse_uid' => 976879,
                    'course_uid' => 47,
                    'rp_abbrev_4' => 'Rdcr',
                    'course_name' => 'Redcar',
                    'owner_uid' => 252688,
                    'bet_return' => 87.85,
                    'newspaper' => 'DAILY MAIL',
                    'tipster' => 'Robin Goodfellow',
                    'wins' => 994,
                    'runs' => 3620,
                    'strike_rate' => 27,
                    'favs_tipped' => 50,
                    'nap_time' => ' 4.00',
                    'course' => 'REDC',
                    'nap_wins' => 39,
                    'nap_runs' => 134,
                    'profit_loss' => '+£36.83',
                    'curr_seq' => '6L',
                    'month_wins' => 241,
                    'month_runs' => 963,
                    'month_profit_loss' => '-£143.62',
                    'bank' => 560.098,
                ],
                [
                    'computed' => null,
                    'horse_name' => null,
                    'country_origin_code' => null,
                    'horse_uid' => null,
                    'course_uid' => null,
                    'rp_abbrev_4' => null,
                    'course_name' => null,
                    'owner_uid' => null,
                    'bet_return' => 86.09,
                    'newspaper' => '<font=helvitalic>Top course trainer<font=helvbold>',
                    'tipster' => null,
                    'wins' => 666,
                    'runs' => 3578,
                    'strike_rate' => 18,
                    'favs_tipped' => 23,
                    'nap_time' => null,
                    'course' => null,
                    'nap_wins' => 0,
                    'nap_runs' => null,
                    'profit_loss' => null,
                    'curr_seq' => null,
                    'month_wins' => 167,
                    'month_runs' => 949,
                    'month_profit_loss' => '-£130.03',
                    'bank' => 502.365,
                ],
                [
                    'computed' => 'a',
                    'horse_name' => 'Worth Waiting',
                    'country_origin_code' => 'GB',
                    'horse_uid' => 1592898,
                    'course_uid' => 47,
                    'rp_abbrev_4' => 'Rdcr',
                    'course_name' => 'Redcar',
                    'owner_uid' => 42055,
                    'bet_return' => 88.47,
                    'newspaper' => 'THE STAR',
                    'tipster' => 'Patrick Weaver',
                    'wins' => 928,
                    'runs' => 3622,
                    'strike_rate' => 25,
                    'favs_tipped' => 43,
                    'nap_time' => ' 3.30',
                    'course' => 'REDC',
                    'nap_wins' => 56,
                    'nap_runs' => 143,
                    'profit_loss' => '+£22.70',
                    'curr_seq' => '2W',
                    'month_wins' => 219,
                    'month_runs' => 952,
                    'month_profit_loss' => '-£204.43',
                    'bank' => 582.284,
                ],
                [
                    'computed' => 'a',
                    'horse_name' => 'She\'s Different',
                    'country_origin_code' => 'IRE',
                    'horse_uid' => 1529247,
                    'course_uid' => 30,
                    'rp_abbrev_4' => 'Leic',
                    'course_name' => 'Leicester',
                    'owner_uid' => 46153,
                    'bet_return' => 91.48,
                    'newspaper' => 'THE TIMES',
                    'tipster' => 'Rob Wright',
                    'wins' => 869,
                    'runs' => 3348,
                    'strike_rate' => 25,
                    'favs_tipped' => 40,
                    'nap_time' => ' 4.50',
                    'course' => 'LEIC',
                    'nap_wins' => 27,
                    'nap_runs' => 129,
                    'profit_loss' => '+£5.34',
                    'curr_seq' => '5L',
                    'month_wins' => 224,
                    'month_runs' => 888,
                    'month_profit_loss' => '-£19.96',
                    'bank' => 714.625,
                ],
                [
                    'computed' => null,
                    'horse_name' => null,
                    'country_origin_code' => null,
                    'horse_uid' => 0,
                    'course_uid' => null,
                    'rp_abbrev_4' => null,
                    'course_name' => null,
                    'owner_uid' => null,
                    'bet_return' => 92.77,
                    'newspaper' => '<font=helvitalic>The Favourite<font=helvbold>',
                    'tipster' => ' ',
                    'wins' => 1379,
                    'runs' => 3778,
                    'strike_rate' => 37,
                    'favs_tipped' => 100,
                    'nap_time' => ' ',
                    'course' => ' ',
                    'nap_wins' => 0,
                    'nap_runs' => 0,
                    'profit_loss' => ' ',
                    'curr_seq' => ' ',
                    'month_wins' => 356,
                    'month_runs' => 1004,
                    'month_profit_loss' => '-£52.64',
                    'bank' => 0.0,
                ],
                [
                    'computed' => 'a',
                    'horse_name' => 'Angel\'s Glory',
                    'country_origin_code' => 'GB',
                    'horse_uid' => 1640269,
                    'course_uid' => 30,
                    'rp_abbrev_4' => 'Leic',
                    'course_name' => 'Leicester',
                    'owner_uid' => 55336,
                    'bet_return' => 89.14,
                    'newspaper' => 'TELEGRAPH',
                    'tipster' => 'Marlborough',
                    'wins' => 886,
                    'runs' => 3343,
                    'strike_rate' => 26,
                    'favs_tipped' => 43,
                    'nap_time' => ' 3.20',
                    'course' => 'LEIC',
                    'nap_wins' => 44,
                    'nap_runs' => 133,
                    'profit_loss' => '+£23.18',
                    'curr_seq' => '2L',
                    'month_wins' => 217,
                    'month_runs' => 877,
                    'month_profit_loss' => '-£107.95',
                    'bank' => 637.079,
                ],
                [
                    'computed' => 'a',
                    'horse_name' => 'Deebaj',
                    'country_origin_code' => 'IRE',
                    'horse_uid' => 869384,
                    'course_uid' => 393,
                    'rp_abbrev_4' => 'Ling',
                    'course_name' => 'Lingfield (A.W)',
                    'owner_uid' => 122954,
                    'bet_return' => 90.86,
                    'newspaper' => 'DAILY EXPRESS',
                    'tipster' => 'The Scout',
                    'wins' => 920,
                    'runs' => 3610,
                    'strike_rate' => 25,
                    'favs_tipped' => 43,
                    'nap_time' => ' 4.40',
                    'course' => 'LING',
                    'nap_wins' => 50,
                    'nap_runs' => 140,
                    'profit_loss' => '-£11.81',
                    'curr_seq' => '1L',
                    'month_wins' => 213,
                    'month_runs' => 954,
                    'month_profit_loss' => '-£173.07',
                    'bank' => 670.064,
                ],
                [
                    'computed' => 'a',
                    'horse_name' => 'Red Striker',
                    'country_origin_code' => 'IRE',
                    'horse_uid' => 1655038,
                    'course_uid' => 393,
                    'rp_abbrev_4' => 'Ling',
                    'course_name' => 'Lingfield (A.W)',
                    'owner_uid' => 246402,
                    'bet_return' => 82.72,
                    'newspaper' => 'DAILY MIRROR',
                    'tipster' => 'Newsboy',
                    'wins' => 916,
                    'runs' => 3619,
                    'strike_rate' => 25,
                    'favs_tipped' => 44,
                    'nap_time' => ' 3.40',
                    'course' => 'LING',
                    'nap_wins' => 31,
                    'nap_runs' => 138,
                    'profit_loss' => '-£25.35',
                    'curr_seq' => '1L',
                    'month_wins' => 240,
                    'month_runs' => 946,
                    'month_profit_loss' => '-£109.77',
                    'bank' => 374.815,
                ],
                [
                    'computed' => 'a',
                    'horse_name' => 'Abushamah',
                    'country_origin_code' => 'IRE',
                    'horse_uid' => 838620,
                    'course_uid' => 47,
                    'rp_abbrev_4' => 'Rdcr',
                    'course_name' => 'Redcar',
                    'owner_uid' => 241160,
                    'bet_return' => 86.71,
                    'newspaper' => 'POSTDATA',
                    'tipster' => ' ',
                    'wins' => 907,
                    'runs' => 3632,
                    'strike_rate' => 24,
                    'favs_tipped' => 40,
                    'nap_time' => ' 3.00',
                    'course' => 'REDC',
                    'nap_wins' => 14,
                    'nap_runs' => 122,
                    'profit_loss' => '-£25.00',
                    'curr_seq' => '6L',
                    'month_wins' => 211,
                    'month_runs' => 955,
                    'month_profit_loss' => '-£246.32',
                    'bank' => 517.455,
                ],
                [
                    'computed' => 'a',
                    'horse_name' => 'General Ginger',
                    'country_origin_code' => 'GB',
                    'horse_uid' => 860373,
                    'course_uid' => 393,
                    'rp_abbrev_4' => 'Ling',
                    'course_name' => 'Lingfield (A.W)',
                    'owner_uid' => 208099,
                    'bet_return' => 87.95,
                    'newspaper' => 'RP RATINGS',
                    'tipster' => ' ',
                    'wins' => 954,
                    'runs' => 3481,
                    'strike_rate' => 27,
                    'favs_tipped' => 47,
                    'nap_time' => ' 4.40',
                    'course' => 'LING',
                    'nap_wins' => 34,
                    'nap_runs' => 135,
                    'profit_loss' => '-£24.94',
                    'curr_seq' => '2L',
                    'month_wins' => 237,
                    'month_runs' => 898,
                    'month_profit_loss' => '-£51.18',
                    'bank' => 580.387,
                ],
                [
                    'computed' => 'a',
                    'horse_name' => 'Dragstone Rock',
                    'country_origin_code' => 'IRE',
                    'horse_uid' => 1031287,
                    'course_uid' => 393,
                    'rp_abbrev_4' => 'Ling',
                    'course_name' => 'Lingfield (A.W)',
                    'owner_uid' => 255943,
                    'bet_return' => 84.25,
                    'newspaper' => 'THE GUARDIAN',
                    'tipster' => ' ',
                    'wins' => 850,
                    'runs' => 3354,
                    'strike_rate' => 25,
                    'favs_tipped' => 44,
                    'nap_time' => ' 4.10',
                    'course' => 'LING',
                    'nap_wins' => 28,
                    'nap_runs' => 138,
                    'profit_loss' => '-£35.60',
                    'curr_seq' => '3L',
                    'month_wins' => 216,
                    'month_runs' => 900,
                    'month_profit_loss' => '-£152.82',
                    'bank' => 471.776,
                ],
                [
                    'computed' => 'a',
                    'horse_name' => 'Kazawi',
                    'country_origin_code' => 'GB',
                    'horse_uid' => 1433452,
                    'course_uid' => 513,
                    'rp_abbrev_4' => 'Wolv',
                    'course_name' => 'Wolverhampton (A.W)',
                    'owner_uid' => 9896,
                    'bet_return' => 86.77,
                    'newspaper' => 'THE SUN',
                    'tipster' => 'Templegate',
                    'wins' => 942,
                    'runs' => 3638,
                    'strike_rate' => 25,
                    'favs_tipped' => 45,
                    'nap_time' => ' 7.10',
                    'course' => 'WOLV',
                    'nap_wins' => 37,
                    'nap_runs' => 137,
                    'profit_loss' => '+£36.03',
                    'curr_seq' => '1L',
                    'month_wins' => 235,
                    'month_runs' => 950,
                    'month_profit_loss' => '-£139.55',
                    'bank' => 518.759,
                ],
                [
                    'computed' => 'a',
                    'horse_name' => 'Angel\'s Glory',
                    'country_origin_code' => 'GB',
                    'horse_uid' => 1640269,
                    'course_uid' => 30,
                    'rp_abbrev_4' => 'Leic',
                    'course_name' => 'Leicester',
                    'owner_uid' => 55336,
                    'bet_return' => 87.15,
                    'newspaper' => 'DAILY RECORD',
                    'tipster' => 'Garry Owen',
                    'wins' => 1012,
                    'runs' => 3612,
                    'strike_rate' => 28,
                    'favs_tipped' => 53,
                    'nap_time' => ' 3.20',
                    'course' => 'LEIC',
                    'nap_wins' => 26,
                    'nap_runs' => 137,
                    'profit_loss' => '-£36.75',
                    'curr_seq' => '20L',
                    'month_wins' => 256,
                    'month_runs' => 951,
                    'month_profit_loss' => '-£164.06',
                    'bank' => 535.895,
                ],
            ],

        ];
    }
}
