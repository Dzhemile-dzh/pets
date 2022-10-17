<?php
/**
 * Created by PhpStorm.
 * User: Igor_Vorobyov
 * Date: 9/5/2016
 * Time: 10:20 AM
 */

namespace Tests\Stubs\Models\Bo\RaceCards;

/**
 * Class SsNatPress
 */
class SsNatPress extends \Tests\Stubs\Models\TipsterSelection
{
    /**
     * @return static
     */
    public function getPressChallenge()
    {
        return [
            \Api\Row\Results\Horse::createFromArray(
                [
                    'horse_name' => 'Wot A Shot',
                    'horse_uid' => 789032,
                    'course_uid' => 41,
                    'course_name' => 'Perth',
                    "rp_abbrev_4" => "Hntg",
                    'owner_uid' => 243784,
                    'rp_owner_choice' => 'b',
                    'bet_return' => 91.569999999999993,
                    'newspaper' => 'DAILY MIRROR',
                    'tipster' => 'Newsboy',
                    'wins' => 1756,
                    'runs' => 6599,
                    'strike_rate' => 26,
                    'favs_tipped' => 47,
                    'nap_time' => ' 3.40',
                    'course' => 'PERT',
                    'nap_wins' => 60,
                    'nap_runs' => 228,
                    'profit_loss' => '-37.25',
                    'curr_seq' => '1W',
                    'month_wins' => 33,
                    'month_runs' => 113,
                    'month_profit_loss' => '+32.83',
                    'bank' => 443.67000000000002,
                ]
            ),
            \Api\Row\Results\Horse::createFromArray(
                [
                    'horse_name' => 'Ocean Ready',
                    'horse_uid' => 891153,
                    'course_uid' => 7,
                    'course_name' => 'Brighton',
                    "rp_abbrev_4" => "Hntg",
                    'owner_uid' => 243784,
                    'rp_owner_choice' => 'b',
                    'bet_return' => 90.909999999999997,
                    'newspaper' => 'THE TIMES',
                    'tipster' => 'Rob Wright',
                    'wins' => 1575,
                    'runs' => 6100,
                    'strike_rate' => 25,
                    'favs_tipped' => 45,
                    'nap_time' => ' 4.00',
                    'course' => 'BRIG',
                    'nap_wins' => 48,
                    'nap_runs' => 234,
                    'profit_loss' => '-�56.40',
                    'curr_seq' => '6L',
                    'month_wins' => 18,
                    'month_runs' => 104,
                    'month_profit_loss' => '-26.30',
                    'bank' => 445.80000000000001,
                ]
            ),
        ];
    }
}
