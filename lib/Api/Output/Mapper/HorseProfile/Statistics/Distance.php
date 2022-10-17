<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\HorseProfile\Statistics;

/**
 * Class Statistics
 *
 * @package Api\Output\Mapper\HorseProfile
 */
class Distance extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Row\Methods\GetDistanceInFurlong;
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'distance_yard' => 'distance_yard',
            '(GetDistanceInFurlong)' => 'distance_furlong_rounded',
            'starts_number' => 'starts_number',
            'place_1st_number' => 'place_1st_number',
            'place_2nd_number' => 'place_2nd_number',
            'place_3rd_number' => 'place_3rd_number',
            'win_prize' => 'win_prize',
            'total_prize' => 'total_prize',
            'euro_win_prize' => 'euro_win_prize',
            'euro_total_prize' => 'euro_total_prize',
            'best_rp_topspeed' => 'best_rp_topspeed',
            'best_rp_postmark' => 'best_rp_postmark',
            'net_total_prize' => 'net_total_prize',
            'net_win_prize' => 'net_win_prize'
        ];
    }
}
