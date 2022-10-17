<?php

namespace Api\Result\Native;

use Api\HtmlResult as Result;

/**
 * Class VideoList
 *
 * @package Api\Result\Native
 */
class VideoList extends Result
{

    /**
     * @return array
     */
    protected function getMappers(): array
    {
        return [
            'videoData' => '\Api\Output\Mapper\Native\VideoList\VideoList'
        ];
    }
}
