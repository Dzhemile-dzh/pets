<?php

namespace Api\Result\RaceCards;

/**
 * Class StandardRunners
 *
 * @package Api\Result\RaceCards
 */
class StandardRunners extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'runners' => 'Api\Output\Mapper\RaceCards\StandardRunners\Runner',
            'runners.figures_calculated' => 'Api\Output\Mapper\RaceCards\StandardRunners\Figures',
        ];
    }
}
