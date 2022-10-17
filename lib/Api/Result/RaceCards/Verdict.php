<?php

namespace Api\Result\RaceCards;

/**
 * Class Verdict
 *
 * @package Api\Result\RaceCards
 */
class Verdict extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'verdict' => '\Api\Output\Mapper\RaceCards\Verdict\Verdict',
            'tipster_verdicts' => '\Api\Output\Mapper\RaceCards\Verdict\TipsterVerdict',
            'spotlight_verdict_selection' => '\Api\Output\Mapper\RaceCards\Verdict\SpotlightVerdictSelection',
        ];
    }
}
