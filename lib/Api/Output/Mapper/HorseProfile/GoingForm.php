<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 8/22/2016
 * Time: 5:23 PM
 */

namespace Api\Output\Mapper\HorseProfile;

class GoingForm extends \Api\Output\Mapper\HorsesMapper
{
    use \RP\Util\Math\GetPercent;
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'wins' => 'wins',
            'runs' => 'runs',
            '(GetPercent)wins,runs' => 'percent',
            'going_form' => 'going_form',
            'top_rpr_flat' => 'top_rpr_flat',
            'top_rpr_jumps' => 'top_rpr_jumps',
            'topspeed_rating' => 'topspeed_rating',
            'topspeed_flat_race' => 'topspeed_flat_race',
            'topspeed_jumps_race' => 'topspeed_jumps_race',
            'sire_wins' => 'sire_wins',
            'sire_runs' => 'sire_runs',
            'sire_impact_value' => 'sire_impact_value',
        ];
    }
}
