<?php

namespace Api\Result\TotePredictor\Meeting;

/**
 * Class Race
 * @package Api\Result\TotePredictor\Meeting
 */
class Jackpot extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'jackpot' => '\Api\Output\Mapper\TotePredictor\Jackpot',
            'jackpot.races' => '\Api\Output\Mapper\TotePredictor\Race',
            'jackpot.races.runners' => '\Api\Output\Mapper\TotePredictor\Runner',
        ];
    }
}
