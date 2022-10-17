<?php

namespace Api\Result\RaceCards;

use Api\Result\Json as Result;

/**
 * Class PostPointerComments
 *
 * @package Api\Result\RaceCards
 */
class PostPointerComments extends Result
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'post_pointer_comments' => '\Api\Output\Mapper\RaceCards\PostPointerComments',
        ];
    }
}
