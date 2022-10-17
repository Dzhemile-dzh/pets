<?php
/**
 * Created by PhpStorm.
 * User=> myroslav_kosinskyi
 * Date=> 8/5/14
 * Time=> 12=>41 PM
 */

namespace Api\Output\Mapper\Results\ResultsDate;

class Tote extends \Api\Output\Mapper\HorsesMapper
{

    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            'race_status_code' => 'race_status_code',
            '(trim)course_country_code' => 'course_country_code',
            'days_diff' => 'days_diff',
            'race_comments' => 'race_comments',
            '(fixEuroSymbol)tote_deadheat_text' => 'tote_deadheat_text',
            'tote_win_money' => 'tote_win_money',
            'tote_place_1_money' => 'tote_place_1_money',
            'tote_place_2_money' => 'tote_place_2_money',
            'tote_place_3_money' => 'tote_place_3_money',
            'tote_place_4_money' => 'tote_place_4_money',
            'tote_dual_forecast_money' => 'tote_dual_forecast_money',
            'computer_strght_frcst_money' => 'computer_strght_frcst_money',
            'tricast_money' => 'tricast_money',
            'tote_trio_money' => 'tote_trio_money',
            'trio_text' => 'trio_text',
            '(fixEuroSymbol)jackpot_text' => 'jackpot_text',
            '(fixEuroSymbol)placepot_text' => 'placepot_text',
            '(fixEuroSymbol)quadpot_text' => 'quadpot_text',
            'rule4_text' => 'rule4_text',
            'selling_details_text' => 'selling_details_text',
            'scoop6_dividend' => 'scoop6_dividend'
        ];
    }
}
