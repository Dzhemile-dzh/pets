<?php

namespace Api\Result\Results;

/**
 * Class PastWinners
 * @package Api\Result\Results
 */
class PastWinners extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'past_winners' => '\Api\Output\Mapper\Results\PastWinners',
        ];
    }
}
