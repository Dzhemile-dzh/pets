<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 3/15/2016
 * Time: 6:20 PM
 */

namespace Api\Output\Mapper\Bloodstock\Stallion;

class NickDescendants extends \Api\Output\Mapper\HorsesMapper
{
    use \RP\Util\Math\GetPercent;
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)style_name,country_origin_code' => 'style_name',
            'runs' => 'runs',
            'wins' => 'wins',
            '(getPercent)wins,runs' => 'wins_percent',
            '(roundNullable)total_money,2' => 'total_money',
            '(roundNullable)win_prize_money,2' => 'win_prize_money',
        ];
    }
}
