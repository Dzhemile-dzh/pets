<?php

namespace Api\Output\Mapper\RaceCards\Runners;

/**
 * Class Figures
 *
 * @package Api\Output\Mapper\RaceCards\Runners
 */
class Figures extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'form_figure' => 'form_figure',
            'race_type_code' => 'race_type_code',
        ];
    }
}
