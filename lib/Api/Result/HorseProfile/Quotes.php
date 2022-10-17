<?php

namespace Api\Result\HorseProfile;

class Quotes extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'quotes' => '\Api\Output\Mapper\HorseProfile\Quotes',
            'stable_tour_quotes' => '\Api\Output\Mapper\HorseProfile\StableTourQuotes',
        ];
    }
}
