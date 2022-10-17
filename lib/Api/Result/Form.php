<?php

namespace Api\Result;

class Form extends Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'results' => '\Api\Output\Mapper\Form\Index',
            'results.racingHistory' => '\Api\Output\Mapper\Form\RacingHistory',
            'results.racingHistory.replayDetails' => '\Api\Output\Mapper\Form\ReplayDetails',
            'results.racingHistory.runner.position' => '\Api\Output\Mapper\Form\Position',
            'results.racingHistory.runner.otherRunner' => '\Api\Output\Mapper\Form\OtherRunner',
        ];
    }
}
