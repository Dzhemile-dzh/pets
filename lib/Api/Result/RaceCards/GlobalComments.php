<?php

namespace Api\Result\RaceCards;

use Api\Result\Json as Result;

/**
 * @package Api\Result\RaceCards
 */
class GlobalComments extends Result
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'global_comments' => '\Api\Output\Mapper\RaceCards\GlobalComments\Main',
            'global_comments.comments' => '\Api\Output\Mapper\RaceCards\GlobalComments\Comments'
        ];
    }
}
