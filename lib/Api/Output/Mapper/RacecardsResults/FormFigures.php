<?php

namespace Api\Output\Mapper\RacecardsResults;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class Prize
 * @package Api\Output\Mapper\RacecardsResults
 */
class FormFigures extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'form_figure' => 'formFigure',
            'race_type_code' => 'raceTypeCode',
        ];
    }
}