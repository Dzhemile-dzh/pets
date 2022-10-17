<?php

namespace Api\Output\Mapper\Meetings;

use Api\Output\Mapper\HorsesMapper;
use Api\Output\Mapper\Methods\LegacyDecorators;

/**
 * Class BettingReturns
 * @package Api\Output\Mapper\Meetings
 */
class BettingReturns extends HorsesMapper
{
    use LegacyDecorators;
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'tote_currency_code' => 'currency',
            '(convertToString)tote_win_money' => 'toteWin',
            '(convertToString)tote_place_1_money' => 'place1',
            '(convertToString)tote_place_2_money' => 'place2',
            '(convertToString)tote_place_3_money' => 'place3',
            '(convertToString)tote_place_4_money' => 'place4',
            '(convertToString)computer_strght_frcst_money' => 'straightForecast',
            '(convertToString)tote_dual_forecast_money' => 'exacta',
            '(convertToString)tricast_money' => 'tricast',
            '(convertToString)tote_trio_money' => 'trifecta',
            'jackpot_text' => 'jackpot',
            'placepot_text' => 'placepot',
            'quadpot_text' => 'quadpot',
            '(convertToString)rule4_value' => 'rule4Value',
            'rule4_text' => 'rule4Text',
        ];
    }
}
