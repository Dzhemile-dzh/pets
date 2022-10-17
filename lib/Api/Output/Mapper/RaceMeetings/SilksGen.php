<?php
namespace Api\Output\Mapper\RaceMeetings;

use Api\Output\Mapper\HorsesMapper;

class SilksGen extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'silks_gen' => 'silks_gen',
        ];
    }
}
