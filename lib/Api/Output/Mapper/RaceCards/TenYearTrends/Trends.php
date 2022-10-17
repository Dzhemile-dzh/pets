<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 7/6/2016
 * Time: 4:59 PM
 */

namespace Api\Output\Mapper\RaceCards\TenYearTrends;

class Trends extends \Api\Output\Mapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'weight_lowest' => 'weight_lowest',
            'weight_highest' => 'weight_highest',
            'weight_median' => 'weight_median',
            'or_lowest' => 'rating_lowest',
            'or_highest' => 'rating_highest',
            'or_median' => 'rating_median',
            'handicap_rating_flag' => 'handicap_rating',
            'age_lowest' => 'age_lowest',
            'age_highest' => 'age_highest',
            'age_median' => 'age_median',
            'starting_price_lowest' => 'starting_price_lowest',
            'starting_price_highest' => 'starting_price_highest',
            'starting_price_median' => 'starting_price_median',
            'market_position_lowest' => 'market_position_lowest',
            'market_position_highest' => 'market_position_highest',
            'market_position_median' => 'market_position_median',
            'total_runners_lowest' => 'total_runners_lowest',
            'total_runners_highest' => 'total_runners_highest',
            'total_runners_median' => 'total_runners_median',
        ];
    }
}
