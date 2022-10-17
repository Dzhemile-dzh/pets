<?php
namespace Api\Output\Mapper\HeadToHead;

/**
 * Class Statistics
 * @package Api\Output\Mapper\HeadToHead
 */
class Statistics extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'starts' => 'starts',
            'wins' => 'wins',
            'seconds' => '2nds',
            'thirds' => '3rds',
            'net_total_prize' => 'net_total_prize',
            'rp_postmark' => 'best_rpr',
            'rp_topspeed' => 'best_ts',
            '(round)stake,2' => 'stake',
            'flat_figures_calculated' => 'flat_figures_calculated',
            'jumps_figures_calculated' => 'jumps_figures_calculated',
        ];
    }
}
