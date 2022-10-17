<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 4/28/2017
 * Time: 11:17 AM
 */

namespace Api\Output\Mapper\GoingToSuit;

class GoingForm extends \Api\Output\Mapper\HorsesMapper
{
    use \RP\Util\Math\GetPercent;
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'going_group' => 'going_group',
            'wins' => 'wins',
            'runs' => 'runs',
            'wins_flag' => 'wins_flag',
            'sire_flag' => 'sire_flag',
            '(GetPercent)wins,runs' => 'percent',
            'going_form' => 'going_form',
            'top_rpr_flat' => 'top_rpr_flat',
            'top_rpr_jumps' => 'top_rpr_jumps',
            'topspeed_rating' => 'topspeed_rating',
            'topspeed_flat_race' => 'topspeed_flat_race',
            'topspeed_jumps_race' => 'topspeed_jumps_race'
        ];
    }
}
