<?php
namespace Api\Output\Mapper\Results;

class Dbi extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'low_low_range' => 'low_low_range',
            'low_high_range' => 'low_high_range',
            'low_race' => 'low_race',
            'low_sp' => 'low_sp',

            'mid_low_range' => 'mid_low_range',
            'mid_high_range' => 'mid_high_range',
            'mid_race' => 'mid_race',
            'mid_sp' => 'mid_sp',

            'high_low_range' => 'high_low_range',
            'high_high_range' => 'high_high_range',
            'high_race' => 'high_race',
            'high_sp' => 'high_sp',
        ];
    }
}
