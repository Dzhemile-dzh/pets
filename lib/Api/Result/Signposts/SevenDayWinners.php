<?php

namespace Api\Result\Signposts;

class SevenDayWinners extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'seven_day_winners' => '\Api\Output\Mapper\Signposts\SevenDayWinners'
        ];
    }
}
