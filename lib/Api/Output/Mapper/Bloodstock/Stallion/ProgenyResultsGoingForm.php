<?php
namespace Api\Output\Mapper\Bloodstock\Stallion;

use Api\Output\Mapper\HorsesMapper;

class ProgenyResultsGoingForm extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'heavy_soft' => 'heavy_soft',
            'good_to_soft' => 'good_to_soft',
            'good' => 'good',
            'good_to_firm' => 'good_to_firm',
            'firm' => 'firm',
        ];
    }
}
