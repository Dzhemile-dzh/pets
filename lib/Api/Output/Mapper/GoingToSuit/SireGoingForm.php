<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 4/28/2017
 * Time: 11:17 AM
 */

namespace Api\Output\Mapper\GoingToSuit;

class SireGoingForm extends \Api\Output\Mapper\HorsesMapper
{
    use \RP\Util\Math\GetPercent;
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'going_group' => 'going_group',
            'sire_wins' => 'sire_progeny_wins',
            'sire_runs' => 'sire_progeny_runs',
            '(GetPercent)sire_wins,sire_runs' => 'sire_progeny_percentage',
            'sire_impact_value' => 'sire_impact_value',
        ];
    }
}
