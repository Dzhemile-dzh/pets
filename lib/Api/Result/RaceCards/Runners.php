<?php

namespace Api\Result\RaceCards;

/**
 * Class Runners
 *
 * @package Api\Result\RaceCards
 */
class Runners extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'runners' => 'Api\Output\Mapper\RaceCards\Runners\Runner',
            'runners.figures_calculated' => 'Api\Output\Mapper\RaceCards\Runners\Figures',
            'runners.jockey_last_14_days' => 'Api\Output\Mapper\RaceCards\Runners\JockeyStats',
        ];
    }
}
