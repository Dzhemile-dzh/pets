<?php

namespace Api\Result\RaceCards;

use Api\Result\Json as Result;

/**
 * Class PostPointerVerdict
 *
 * @package Api\Result\RaceCards
 */
class PostPointerVerdict extends Result
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'post_pointer_verdict' => '\Api\Output\Mapper\RaceCards\PostPointerVerdict',
            'spotlight_verdict_selection' => '\Api\Output\Mapper\RaceCards\Verdict\SpotlightVerdictSelection',
        ];
    }
}
