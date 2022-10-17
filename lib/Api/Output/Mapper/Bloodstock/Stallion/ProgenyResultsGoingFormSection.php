<?php
namespace Api\Output\Mapper\Bloodstock\Stallion;

use Api\Output\Mapper\HorsesMapper;
use RP\Util\Math\GetPercent;

class ProgenyResultsGoingFormSection extends HorsesMapper
{
    use GetPercent;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'wins' => 'wins',
            'runs' => 'runs',
            '(getPercent)wins,runs' => 'win_percentage',
            'impact_value' => 'impact_value',
        ];
    }
}
